<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServicerRequest;
use App\Http\Requests\UpdateServicerRequest;
use App\Http\Resources\Admin\ServicerResource;
use App\Models\Servicer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servicer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServicerResource(Servicer::with(['user', 'merchant'])->get());
    }

    public function store(StoreServicerRequest $request)
    {
        $servicer = Servicer::create($request->all());

        return (new ServicerResource($servicer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServicerResource($servicer->load(['user', 'merchant']));
    }

    public function update(UpdateServicerRequest $request, Servicer $servicer)
    {
        $servicer->update($request->all());

        return (new ServicerResource($servicer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
