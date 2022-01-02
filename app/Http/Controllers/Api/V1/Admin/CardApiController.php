<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CardResource;
use App\Models\Card;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CardApiController extends Controller
{
    public function index()
    {
        return new CardResource(Card::with(['user'])->get());
    }

    public function store(Request $request)
    {
        $card = Card::create($request->all());

        return (new CardResource($card))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Card $card)
    {
        return new CardResource($card->load(['user']));
    }

    public function update(Request $request, Card $card)
    {
        $card->update($request->all());

        return (new CardResource($card))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Card $card)
    {
        $card->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function cardFilterByUser($user)
    {
        $card = Card::where("user_id", $user)->get();

        return new CardResource($card);
    }

}
