<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEbillingRequest;
use App\Http\Requests\StoreEbillingRequest;
use App\Http\Requests\UpdateEbillingRequest;
use App\Models\Ebilling;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EbillingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ebilling_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ebillings = Ebilling::with(['order', 'user', 'payment_method', 'media'])->get();

        return view('admin.ebillings.index', compact('ebillings'));
    }

    public function create()
    {
        abort_if(Gate::denies('ebilling_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ebillings.create', compact('orders', 'users', 'payment_methods'));
    }

    public function store(StoreEbillingRequest $request)
    {
        $ebilling = Ebilling::create($request->all());

        if ($request->input('receipt', false)) {
            $ebilling->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ebilling->id]);
        }

        return redirect()->route('admin.ebillings.index');
    }

    public function edit(Ebilling $ebilling)
    {
        abort_if(Gate::denies('ebilling_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ebilling->load('order', 'user', 'payment_method');

        return view('admin.ebillings.edit', compact('orders', 'users', 'payment_methods', 'ebilling'));
    }

    public function update(UpdateEbillingRequest $request, Ebilling $ebilling)
    {
        $ebilling->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$ebilling->receipt || $request->input('receipt') !== $ebilling->receipt->file_name) {
                if ($ebilling->receipt) {
                    $ebilling->receipt->delete();
                }
                $ebilling->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
            }
        } elseif ($ebilling->receipt) {
            $ebilling->receipt->delete();
        }

        return redirect()->route('admin.ebillings.index');
    }

    public function show(Ebilling $ebilling)
    {
        abort_if(Gate::denies('ebilling_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ebilling->load('order', 'user', 'payment_method');

        return view('admin.ebillings.show', compact('ebilling'));
    }

    public function destroy(Ebilling $ebilling)
    {
        abort_if(Gate::denies('ebilling_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ebilling->delete();

        return back();
    }

    public function massDestroy(MassDestroyEbillingRequest $request)
    {
        Ebilling::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ebilling_create') && Gate::denies('ebilling_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ebilling();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
