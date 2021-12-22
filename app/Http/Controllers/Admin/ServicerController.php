<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServicerRequest;
use App\Http\Requests\StoreServicerRequest;
use App\Http\Requests\UpdateServicerRequest;
use App\Models\Merchant;
use App\Models\Servicer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ServicerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servicer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::id() == 1) {
            $servicers = Servicer::with(['user', 'merchant'])->get();
        } else {
            $servicers = Servicer::where('merchant_id', (Merchant::where('created_by_id', (User::where('id', Auth::id())->first())->id)->first())->id)
                ->with(['user', 'merchant'])->get();
        }

        return view('admin.servicers.index', compact('servicers'));
    }

    public function create()
    {
        abort_if(Gate::denies('servicer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->roles[0]->id == 1) {
            $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $users = User::where('created_by_id', Auth::id())->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        if (Auth::user()->roles[0]->id == 1) {
            $merchants = Merchant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $merchants = Merchant::where('created_by_id', Auth::id())->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        return view('admin.servicers.create', compact('users', 'merchants'));
    }

    public function store(StoreServicerRequest $request)
    {
        $servicer = Servicer::create($request->all());

        return redirect()->route('admin.servicers.index');
    }

    public function edit(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $merchants = Merchant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $servicer->load('user', 'merchant');

        return view('admin.servicers.edit', compact('users', 'merchants', 'servicer'));
    }

    public function update(UpdateServicerRequest $request, Servicer $servicer)
    {
        $servicer->update($request->all());

        return redirect()->route('admin.servicers.index');
    }

    public function show(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicer->load('user', 'merchant');

        return view('admin.servicers.show', compact('servicer'));
    }

    public function destroy(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicer->delete();

        return back();
    }

    public function massDestroy(MassDestroyServicerRequest $request)
    {
        Servicer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
