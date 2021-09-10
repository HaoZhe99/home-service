@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%; ">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.merchant.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.merchants.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('cruds.merchant.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', '') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.merchant.fields.description') }}</label>
                        <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                            name="description" id="description" value="{{ old('description', '') }}">
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.description_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">{{ trans('cruds.merchant.fields.contact_number') }}</label>
                        <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text"
                            name="contact_number" id="contact_number" value="{{ old('contact_number', '') }}">
                        @if ($errors->has('contact_number'))
                            <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.contact_number_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.merchant.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status">
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Merchant::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="address">{{ trans('cruds.merchant.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                            name="address1" id="address" value="{{ old('address', '') }}" style="margin-bottom: 10px">
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                            name="address2" id="address" value="{{ old('address', '') }}" style="margin-bottom: 10px">
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                            name="address3" id="address" value="{{ old('address', '') }}">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.address_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="state_id">{{ trans('cruds.merchant.fields.postcode') }}</label>
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
                        <span class="help-block">{{ trans('cruds.merchant.fields.state_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="longitude">{{ trans('cruds.merchant.fields.longitude') }}</label>
                        <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text"
                            name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                        @if ($errors->has('longitude'))
                            <span class="text-danger">{{ $errors->first('longitude') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.longitude_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="latitude">{{ trans('cruds.merchant.fields.latitude') }}</label>
                        <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text"
                            name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                        @if ($errors->has('latitude'))
                            <span class="text-danger">{{ $errors->first('latitude') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.latitude_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="ssm_number">{{ trans('cruds.merchant.fields.ssm_number') }}</label>
                        <input class="form-control {{ $errors->has('ssm_number') ? 'is-invalid' : '' }}" type="text"
                            name="ssm_number" id="ssm_number" value="{{ old('ssm_number', '') }}">
                        @if ($errors->has('ssm_number'))
                            <span class="text-danger">{{ $errors->first('ssm_number') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.ssm_number_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="ssm_document">{{ trans('cruds.merchant.fields.ssm_document') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('ssm_document') ? 'is-invalid' : '' }}"
                            id="ssm_document-dropzone">
                        </div>
                        @if ($errors->has('ssm_document'))
                            <span class="text-danger">{{ $errors->first('ssm_document') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.ssm_document_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="logo">{{ trans('cruds.merchant.fields.logo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                            id="logo-dropzone">
                        </div>
                        @if ($errors->has('logo'))
                            <span class="text-danger">{{ $errors->first('logo') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.logo_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="categories">{{ trans('cruds.merchant.fields.category') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}"
                            name="categories[]" id="categories" multiple>
                            @foreach ($categories as $id => $category)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('categories'))
                            <span class="text-danger">{{ $errors->first('categories') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.merchant.fields.category_helper') }}</span>
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

@section('scripts')
    <script>
        Dropzone.options.ssmDocumentDropzone = {
            url: '{{ route('admin.merchants.storeMedia') }}',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="ssm_document"]').remove()
                $('form').append('<input type="hidden" name="ssm_document" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="ssm_document"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($merchant) && $merchant->ssm_document)
                    var file = {!! json_encode($merchant->ssm_document) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="ssm_document" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.logoDropzone = {
            url: '{{ route('admin.merchants.storeMedia') }}',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="logo"]').remove()
                $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($merchant) && $merchant->logo)
                    var file = {!! json_encode($merchant->logo) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
