@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.card.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.id') }}
                        </th>
                        <td>
                            {{ $card->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.bank_of_card') }}
                        </th>
                        <td>
                            {{ App\Models\Card::BANK_SELECT[$card->bank_of_card] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.name_of_card') }}
                        </th>
                        <td>
                            {{ $card->name_of_card }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.card_number') }}
                        </th>
                        <td>
                            {{ $card->card_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.expired_date') }}
                        </th>
                        <td>
                            {{ $card->expired_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.cvv') }}
                        </th>
                        <td>
                            {{ $card->cvv ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.card.fields.user') }}
                        </th>
                        <td>
                            {{ $card->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection