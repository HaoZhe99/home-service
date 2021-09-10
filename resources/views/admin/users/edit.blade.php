@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%;">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', $user->name) }}" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="username">{{ trans('cruds.user.fields.username') }}</label>
                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                            name="username" id="username" value="{{ old('username', $user->username) }}">
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                            name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                            name="password" id="password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                            name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                            name="roles[]" id="roles" multiple required>
                            @foreach ($roles as $id => $role)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('roles', [])) || $user->roles->contains($id) ? 'selected' : '' }}>
                                    {{ $role }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('roles'))
                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('verify') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="verify" value="0">
                            <input class="form-check-input" type="checkbox" name="verify" id="verify" value="1"
                                {{ $user->verify || old('verify', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="verify">{{ trans('cruds.user.fields.verify') }}</label>
                        </div>
                        @if ($errors->has('verify'))
                            <span class="text-danger">{{ $errors->first('verify') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.verify_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="verify_token">{{ trans('cruds.user.fields.verify_token') }}</label>
                        <input class="form-control {{ $errors->has('verify_token') ? 'is-invalid' : '' }}" type="text"
                            name="verify_token" id="verify_token" value="{{ old('verify_token', $user->verify_token) }}">
                        @if ($errors->has('verify_token'))
                            <span class="text-danger">{{ $errors->first('verify_token') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.verify_token_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="addresses">{{ trans('cruds.user.fields.address') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('addresses') ? 'is-invalid' : '' }}"
                            name="addresses[]" id="addresses" multiple>
                            @foreach ($addresses as $id => $address)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('addresses', [])) || $user->addresses->contains($id) ? 'selected' : '' }}>
                                    {{ $address }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('addresses'))
                            <span class="text-danger">{{ $errors->first('addresses') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.address_helper') }}</span>
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
