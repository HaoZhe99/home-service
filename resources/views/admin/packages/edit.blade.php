@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%;">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('cruds.package.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.packages.update', [$package->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('cruds.package.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', $package->name) }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.package.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="price">{{ trans('cruds.package.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', $package->price) }}" step="1">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.package.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.package.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status">
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Package::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('status', $package->status) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.package.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.package.fields.description') }}</label>
                        <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                            name="description" id="description" value="{{ old('description', $package->description) }}">
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.package.fields.description_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="merchant_id">{{ trans('cruds.package.fields.merchant') }}</label>
                        <select class="form-control select2 {{ $errors->has('merchant') ? 'is-invalid' : '' }}"
                            name="merchant_id" id="merchant_id">
                            @foreach ($merchants as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('merchant_id') ? old('merchant_id') : $package->merchant->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('merchant'))
                            <span class="text-danger">{{ $errors->first('merchant') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.package.fields.merchant_helper') }}</span>
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
