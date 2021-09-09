@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%; ">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.address.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.addresses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="address">{{ trans('cruds.address.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                            name="address" id="address" value="{{ old('address', '') }}">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.address.fields.address_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="state_id">Postcode</label>
                        <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}"
                            name="state_id" id="state_id">
                            @foreach ($states as $id => $entry)
                                <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.address.fields.state_helper') }}</span>
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
