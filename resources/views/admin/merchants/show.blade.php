@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.merchant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.merchants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.id') }}
                        </th>
                        <td>
                            {{ $merchant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.name') }}
                        </th>
                        <td>
                            {{ $merchant->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.description') }}
                        </th>
                        <td>
                            {{ $merchant->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.contact_number') }}
                        </th>
                        <td>
                            {{ $merchant->contact_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Merchant::STATUS_SELECT[$merchant->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.address') }}
                        </th>
                        <td>
                            {{ $merchant->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.state') }}
                        </th>
                        <td>
                            {{ $merchant->state->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.longitude') }}
                        </th>
                        <td>
                            {{ $merchant->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.latitude') }}
                        </th>
                        <td>
                            {{ $merchant->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.ssm_number') }}
                        </th>
                        <td>
                            {{ $merchant->ssm_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.ssm_document') }}
                        </th>
                        <td>
                            @if($merchant->ssm_document)
                                <a href="{{ $merchant->ssm_document->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.logo') }}
                        </th>
                        <td>
                            @if($merchant->logo)
                                <a href="{{ $merchant->logo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.merchant.fields.category') }}
                        </th>
                        <td>
                            @foreach($merchant->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By 
                        </th>
                        <td>
                            {{ $merchant->created_by->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.merchants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection