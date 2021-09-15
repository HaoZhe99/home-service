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
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['merchant', 'package', 'user', 'servicer', 'qr_code'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchants = Merchant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qr_codes = QrCode::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('merchants', 'packages', 'users', 'servicers', 'qr_codes'));
    }

    public function store(StoreOrderRequest $request)
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

        $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qr_codes = QrCode::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('merchant', 'package', 'user', 'servicer', 'qr_code');

        return view('admin.orders.edit', compact('merchants', 'packages', 'users', 'servicers', 'qr_codes', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('merchant', 'package', 'user', 'servicer', 'qr_code');

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
}
