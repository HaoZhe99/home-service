@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%; ">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.card.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.cards.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ trans('cruds.card.fields.bank_of_card') }}</label>
                        <select class="form-control {{ $errors->has('bank_of_card') ? 'is-invalid' : '' }}" name="bank_of_card"
                            id="bank_of_card">
                            <option value disabled {{ old('bank_of_card', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Card::BANK_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('bank_of_card', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('bank_of_card'))
                            <span class="text-danger">{{ $errors->first('bank_of_card') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.card.fields.bank_of_card_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name_of_card">{{ trans('cruds.card.fields.name_of_card') }}</label>
                        <input class="form-control {{ $errors->has('name_of_card') ? 'is-invalid' : '' }}" type="text"
                            name="name_of_card" id="name_of_card" value="{{ old('name_of_card', '') }}" >
                        @if ($errors->has('name_of_card'))
                            <span class="text-danger">{{ $errors->first('name_of_card') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.card.fields.name_of_card_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="card_number">{{ trans('cruds.card.fields.card_number') }}</label>
                        <input class="form-control {{ $errors->has('card_number') ? 'is-invalid' : '' }}" type="text"
                            name="card_number" id="card_number" value="{{ old('card_number', '') }}" maxlength="16">
                        @if ($errors->has('card_number'))
                            <span class="text-danger">{{ $errors->first('card_number') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.card.fields.card_number_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="expired_date">{{ trans('cruds.card.fields.expired_date') }}</label>
                        <input class="form-control {{ $errors->has('expired_date') ? 'is-invalid' : '' }}" type="month"
                            name="expired_date" id="expired_date" value="{{ old('expired_date', '2025-12') }}">
                        @if ($errors->has('expired_date'))
                            <span class="text-danger">{{ $errors->first('expired_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.card.fields.expired_date_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="cvv">{{ trans('cruds.card.fields.cvv') }}</label>
                        <input class="form-control {{ $errors->has('cvv') ? 'is-invalid' : '' }}" type="text"
                            name="cvv" id="cvv" value="{{ old('cvv', '') }}" maxlength="3">
                        @if ($errors->has('cvv'))
                            <span class="text-danger">{{ $errors->first('cvv') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.card.fields.cvv_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="user_id">{{ trans('cruds.card.fields.user') }}</label>
                        <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}"
                            name="user_id" id="user_id">
                            @foreach ($users as $id => $entry)
                                <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user'))
                            <span class="text-danger">{{ $errors->first('user') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.card.fields.user_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
