<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Package;
use App\Models\QrCode;
use App\Models\Servicer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if (Auth::id() == 1) {
            $orders = Order::with(['merchant', 'package', 'user', 'servicer'])->get();
            $a = DB::table('role_user')->where('role_id', 3)->get();
            $b = [];
            for ($i=0; $i < count($a) ; $i++) {  
                array_push($b, $a[$i]->user_id);
            }
            $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } elseif (Auth::user()->roles[0]->id==2) {
            $orders = Order::where('user_id', Auth::id())
                ->with(['merchant', 'package', 'user', 'servicer'])->get();
        } else {
            $orders = Order::where('merchant_id', (Merchant::where('created_by_id', (User::where('id', Auth::id())->first())->id)->first())->id)
                ->with(['merchant', 'package', 'user', 'servicer'])->get();
        }

        if (Auth::id() == 1) {
            return view('admin.orders.index', compact('orders','servicers'));
        } else {
            return view('admin.orders.index', compact('orders'));
        }
        
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::id() == 1) {
            $merchants = Merchant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $merchants = Merchant::where('created_by_id', Auth::id())->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        if (Auth::id() == 1) {
            $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $packages = Package::whereIn('merchant_id', Merchant::select('id')->where('created_by_id', Auth::id()))->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if (Auth::id() == 1) {
            $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $servicers = Servicer::where('merchant_id', (Merchant::where('created_by_id', (User::where('id', Auth::id())->first())->id)->first())->id)
                ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        return view('admin.orders.create', compact('merchants', 'packages', 'users', 'servicers'));
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchants = Merchant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if (Auth::id() == 1) {
            $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $servicers = Servicer::where('merchant_id', (Merchant::where('created_by_id', (User::where('id', Auth::id())->first())->id)->first())->id)
                ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        $order->load('merchant', 'package', 'user', 'servicer');

        return view('admin.orders.edit', compact('merchants', 'packages', 'users', 'servicers', 'order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('merchant', 'package', 'user', 'servicer');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function complete(Order $order)
    {

        $order->update([
            'status' => 'completed'
        ]);

        return redirect()->route('admin.orders.index');
    }

    public function incomplete(Order $order)
    {

        $order->update([
            'status' => 'incomplete'
        ]);

        return redirect()->route('admin.orders.index');
    }

    public function assign(Request $request, Order $order)
    {
        $order->update(['servicer_id' => $request->servicer_id]);

        return redirect()->route('admin.orders.index');
    }
}
