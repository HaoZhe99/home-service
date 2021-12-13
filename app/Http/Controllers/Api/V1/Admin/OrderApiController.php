<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderApiController extends Controller
{
    public function index()
    {
        return new OrderResource(Order::with(['merchant', 'package', 'user', 'servicer', 'qr_code'])->get());
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load(['merchant', 'package', 'user', 'servicer', 'qr_code','user.addresses']));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function newOrder($id)
    {
        // $order = Order::where('servicer_id', $id)->where('status', 'incomplete')->with(['merchant', 'package', 'user', 'servicer'])->get();
        $order = Order::where('status', 'incomplete')->with(['merchant', 'package', 'user', 'servicer'])->get();
        return new OrderResource($order);
    }

    public function oldOrder($id)
    {
        // $order = Order::where('servicer_id', $id)->where('status', 'completed')->with(['merchant', 'package', 'user', 'servicer'])->get();

        $order = Order::where('status', 'completed')->with(['merchant', 'package', 'user', 'servicer'])->get();
        return new OrderResource($order);
    }

    public function updateOrder(Request $request, Order $order)
    {
        $order->update([
            'status'=>$request->status,
        ]);

        return new OrderResource($order);
    }

    public function commentAndRate(Request $request, Order $order)
    {
        $order->update([
            'comment' => $request->comment,
            'rate' => $request->rate,
        ]);

        return new OrderResource($order);
    }

    public function orderWithComment($merchant)
    {
        // $order = Order::where('servicer_id', $id)->where('status', 'completed')->with(['merchant', 'package', 'user', 'servicer'])->get();

        $order = Order::where('merchant_id', $merchant)->with(['merchant', 'user'])->get();
        return new OrderResource($order);
    }
}
