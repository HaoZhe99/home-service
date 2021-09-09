@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.qrCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qr-codes.update", [$qrCode->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="code">{{ trans('cruds.qrCode.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $qrCode->code) }}">
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.qrCode.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\QrCode::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $qrCode->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expired_at">{{ trans('cruds.qrCode.fields.expired_at') }}</label>
                <input class="form-control datetime {{ $errors->has('expired_at') ? 'is-invalid' : '' }}" type="text" name="expired_at" id="expired_at" value="{{ old('expired_at', $qrCode->expired_at) }}">
                @if($errors->has('expired_at'))
                    <span class="text-danger">{{ $errors->first('expired_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.expied_at_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection