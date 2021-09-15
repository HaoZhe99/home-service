<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPackageRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Merchant;
use App\Models\Package;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd((User::where('id', Auth::id())->first()));
        if (Auth::id() == 1) {
            $packages = Package::with(['merchant'])->get();
        } else {
            $packages = Package::where('merchant_id', (Merchant::where('created_by_id', (User::where('id', Auth::id())->first())->id)->first())->id)
                ->with(['merchant'])->get();
        }


        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        abort_if(Gate::denies('package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchants = Merchant::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.packages.create', compact('merchants'));
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());

        return redirect()->route('admin.packages.index');
    }

    public function edit(Package $package)
    {
        abort_if(Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchants = Merchant::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $package->load('merchant');

        return view('admin.packages.edit', compact('merchants', 'package'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());

        return redirect()->route('admin.packages.index');
    }

    public function show(Package $package)
    {
        abort_if(Gate::denies('package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->load('merchant');

        return view('admin.packages.show', compact('package'));
    }

    public function destroy(Package $package)
    {
        abort_if(Gate::denies('package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackageRequest $request)
    {
        Package::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
