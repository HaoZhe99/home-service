@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%; ">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="price" class="required">{{ trans('cruds.order.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.order.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status" required>
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Order::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="date" class="required">{{ trans('cruds.order.fields.date') }}</label>
                        <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date"
                            name="date" id="date" value="{{ old('date', '') }}" step="0.01" required>
                        @if ($errors->has('date'))
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.date_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.order.fields.time') }}</label>
                        <select class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" name="time"
                            id="time" required>
                            <option value disabled {{ old('time', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Order::TIME_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('time', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('time'))
                            <span class="text-danger">{{ $errors->first('time') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.time_helper') }}</span>
                    </div>
                    {{-- <div class="form-group">
                        <label>{{ trans('cruds.order.fields.payment_method') }}</label>
                        <select class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method"
                            id="payment_method">
                            <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Order::PAYMENT_METHOD as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('payment_method', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('payment_method'))
                            <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.payment_method_helper') }}</span>
                    </div> --}}
                    <div class="form-group">
                        <label for="comment">{{ trans('cruds.order.fields.comment') }}</label>
                        <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text"
                            name="comment" id="comment" value="{{ old('comment', '') }}">
                        @if ($errors->has('comment'))
                            <span class="text-danger">{{ $errors->first('comment') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.comment_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.order.fields.rate') }}</label>
                        <select class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" name="rate"
                            id="rate">
                            <option value disabled {{ old('rate', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Order::RATE_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('rate', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('rate'))
                            <span class="text-danger">{{ $errors->first('rate') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.rate_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="remark">{{ trans('cruds.order.fields.remark') }}</label>
                        <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text"
                            name="remark" id="remark" value="{{ old('remark', '') }}">
                        @if ($errors->has('remark'))
                            <span class="text-danger">{{ $errors->first('remark') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.remark_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="merchant_id" class="required">{{ trans('cruds.order.fields.merchant') }}</label>
                        <select class="form-control select2 {{ $errors->has('merchant') ? 'is-invalid' : '' }}"
                            name="merchant_id" id="merchant_id" required>
                            @foreach ($merchants as $id => $entry)
                                <option value="{{ $id }}" {{ old('merchant_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('merchant'))
                            <span class="text-danger">{{ $errors->first('merchant') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.merchant_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="package_id" class="required">{{ trans('cruds.order.fields.package') }}</label>
                        <select class="form-control select2 {{ $errors->has('package') ? 'is-invalid' : '' }}"
                            name="package_id" id="package_id" required>
                            @foreach ($packages as $id => $entry)
                                <option value="{{ $id }}" {{ old('package_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('package'))
                            <span class="text-danger">{{ $errors->first('package') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.package_helper') }}</span>
                    </div>
                    @if (Auth::user()->roles[0]->id == 1)
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.order.fields.user') }}</label>
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
                            <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
                        </div>
                    {{-- @else
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.order.fields.user') }}</label>
                            <input class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text"
                                name="user_id" id="user_id" value="{{ old('user_id', '') }}">
                            @if ($errors->has('user'))
                                <span class="text-danger">{{ $errors->first('user') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
                        </div> --}}
                    @endif
                    
                    <div class="form-group">
                        <label for="servicer_id">{{ trans('cruds.order.fields.servicer') }}</label>
                        <select class="form-control select2 {{ $errors->has('servicer') ? 'is-invalid' : '' }}"
                            name="servicer_id" id="servicer_id">
                            @foreach ($servicers as $id => $entry)
                                <option value="{{ $id }}" {{ old('servicer_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('servicer'))
                            <span class="text-danger">{{ $errors->first('servicer') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.servicer_helper') }}</span>
                    </div>
                    {{-- <div class="form-group">
                        <label for="qr_code_id">{{ trans('cruds.order.fields.qr_code') }}</label>
                        <select class="form-control select2 {{ $errors->has('qr_code') ? 'is-invalid' : '' }}"
                            name="qr_code_id" id="qr_code_id">
                            @foreach ($qr_codes as $id => $entry)
                                <option value="{{ $id }}" {{ old('qr_code_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('qr_code'))
                            <span class="text-danger">{{ $errors->first('qr_code') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.qr_code_helper') }}</span>
                    </div> --}}
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
