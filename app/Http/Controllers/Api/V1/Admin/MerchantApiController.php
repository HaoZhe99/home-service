<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Http\Resources\Admin\MerchantResource;
use App\Models\Merchant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerchantApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('merchant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MerchantResource(Merchant::with(['state', 'categories'])->get());
    }

    public function store(StoreMerchantRequest $request)
    {
        $merchant = Merchant::create($request->all());
        $merchant->categories()->sync($request->input('categories', []));
        if ($request->input('ssm_document', false)) {
            $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_document'))))->toMediaCollection('ssm_document');
        }

        if ($request->input('logo', false)) {
            $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new MerchantResource($merchant))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MerchantResource($merchant->load(['state', 'categories']));
    }

    public function update(UpdateMerchantRequest $request, Merchant $merchant)
    {
        $merchant->update($request->all());
        $merchant->categories()->sync($request->input('categories', []));
        if ($request->input('ssm_document', false)) {
            if (!$merchant->ssm_document || $request->input('ssm_document') !== $merchant->ssm_document->file_name) {
                if ($merchant->ssm_document) {
                    $merchant->ssm_document->delete();
                }
                $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_document'))))->toMediaCollection('ssm_document');
            }
        } elseif ($merchant->ssm_document) {
            $merchant->ssm_document->delete();
        }

        if ($request->input('logo', false)) {
            if (!$merchant->logo || $request->input('logo') !== $merchant->logo->file_name) {
                if ($merchant->logo) {
                    $merchant->logo->delete();
                }
                $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($merchant->logo) {
            $merchant->logo->delete();
        }

        return (new MerchantResource($merchant))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
