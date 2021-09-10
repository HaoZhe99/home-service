@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%;">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('cruds.state.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.states.update', [$state->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="state">{{ trans('cruds.state.fields.state') }}</label>
                        <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text"
                            name="state" id="state" value="{{ old('state', $state->state) }}">
                        @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.state.fields.state_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="postcode">{{ trans('cruds.state.fields.postcode') }}</label>
                        <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text"
                            name="postcode" id="postcode" value="{{ old('postcode', $state->postcode) }}">
                        @if ($errors->has('postcode'))
                            <span class="text-danger">{{ $errors->first('postcode') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.state.fields.postcode_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="area">{{ trans('cruds.state.fields.area') }}</label>
                        <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text"
                            name="area" id="area" value="{{ old('area', $state->area) }}">
                        @if ($errors->has('area'))
                            <span class="text-danger">{{ $errors->first('area') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.state.fields.area_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="country_id">{{ trans('cruds.state.fields.country') }}</label>
                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}"
                            name="country_id" id="country_id">
                            @foreach ($countries as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('country_id') ? old('country_id') : $state->country->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="text-danger">{{ $errors->first('country') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.state.fields.country_helper') }}</span>
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
