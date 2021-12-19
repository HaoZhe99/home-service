<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEbillingRequest;
use App\Http\Requests\UpdateEbillingRequest;
use App\Http\Resources\Admin\EbillingResource;
use App\Models\Ebilling;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EbillingApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ebilling_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EbillingResource(Ebilling::with(['order', 'user', 'payment_method'])->get());
    }

    public function store(StoreEbillingRequest $request)
    {
        $ebilling = Ebilling::create($request->all());

        // if ($request->input('receipt', false)) {
        //     $ebilling->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        // }

        return (new EbillingResource($ebilling))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ebilling $ebilling)
    {
        abort_if(Gate::denies('ebilling_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EbillingResource($ebilling->load(['order', 'user', 'payment_method']));
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

        return (new EbillingResource($ebilling))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ebilling $ebilling)
    {
        abort_if(Gate::denies('ebilling_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ebilling->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
