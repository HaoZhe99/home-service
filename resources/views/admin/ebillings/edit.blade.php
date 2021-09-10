@extends('layouts.admin')
@section('content')

    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card" style="width: 80%;">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('cruds.ebilling.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.ebillings.update', [$ebilling->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="money">{{ trans('cruds.ebilling.fields.money') }}</label>
                        <input class="form-control {{ $errors->has('money') ? 'is-invalid' : '' }}" type="number"
                            name="money" id="money" value="{{ old('money', $ebilling->money) }}" step="0.01">
                        @if ($errors->has('money'))
                            <span class="text-danger">{{ $errors->first('money') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.money_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.ebilling.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status">
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Ebilling::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('status', $ebilling->status) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="receipt">{{ trans('cruds.ebilling.fields.receipt') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('receipt') ? 'is-invalid' : '' }}"
                            id="receipt-dropzone">
                        </div>
                        @if ($errors->has('receipt'))
                            <span class="text-danger">{{ $errors->first('receipt') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.receipt_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="remark">{{ trans('cruds.ebilling.fields.remark') }}</label>
                        <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text"
                            name="remark" id="remark" value="{{ old('remark', $ebilling->remark) }}">
                        @if ($errors->has('remark'))
                            <span class="text-danger">{{ $errors->first('remark') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.remark_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="order_id">{{ trans('cruds.ebilling.fields.order') }}</label>
                        <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}"
                            name="order_id" id="order_id">
                            @foreach ($orders as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('order_id') ? old('order_id') : $ebilling->order->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('order'))
                            <span class="text-danger">{{ $errors->first('order') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.order_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="user_id">{{ trans('cruds.ebilling.fields.user') }}</label>
                        <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}"
                            name="user_id" id="user_id">
                            @foreach ($users as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('user_id') ? old('user_id') : $ebilling->user->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user'))
                            <span class="text-danger">{{ $errors->first('user') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.user_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="payment_method_id">{{ trans('cruds.ebilling.fields.payment_method') }}</label>
                        <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}"
                            name="payment_method_id" id="payment_method_id">
                            @foreach ($payment_methods as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('payment_method_id') ? old('payment_method_id') : $ebilling->payment_method->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('payment_method'))
                            <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ebilling.fields.payment_method_helper') }}</span>
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
        Dropzone.options.receiptDropzone = {
            url: '{{ route('admin.ebillings.storeMedia') }}',
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
                $('form').find('input[name="receipt"]').remove()
                $('form').append('<input type="hidden" name="receipt" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="receipt"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($ebilling) && $ebilling->receipt)
                    var file = {!! json_encode($ebilling->receipt) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="receipt" value="' + file.file_name + '">')
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
