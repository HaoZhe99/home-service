<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCardRequest;
use App\Models\Merchant;
use App\Models\Card;
use App\Models\Package;
use App\Models\QrCode;
use App\Models\Servicer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::id() == 1) {
            $cards = Card::with([ 'user'])->get();
            // $a = DB::table('role_user')->where('role_id', 3)->get();
            // $b = [];
            // for ($i=0; $i < count($a) ; $i++) {  
            //     array_push($b, $a[$i]->user_id);
            // }
            // $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $cards = Card::where('user_id', Auth::id())->with(['user'])->get();
        }


        return view('admin.cards.index', compact('cards'));
    }

    public function create()
    {
        abort_if(Gate::denies('card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cards.create', compact('users'));
    }

    public function store(Request $request)
    {

        $card = Card::create($request->all());

        return redirect()->route('admin.cards.index');
    }

    public function edit(Card $card)
    {
        abort_if(Gate::denies('card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $card->load('user');

        return view('admin.cards.edit', compact('users','card'));
    }

    public function update(Request $request, Card $card)
    {
        $card->update($request->all());

        return redirect()->route('admin.cards.index');
    }

    public function show(Card $card)
    {
        abort_if(Gate::denies('card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card->load('user');

        return view('admin.cards.show', compact('card'));
    }

    public function destroy(Card $card)
    {
        abort_if(Gate::denies('card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card->delete();

        return back();
    }

    public function massDestroy(MassDestroyCardRequest $request)
    {
        Card::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
