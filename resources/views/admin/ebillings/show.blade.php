@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ebilling.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ebillings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.id') }}
                        </th>
                        <td>
                            {{ $ebilling->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.money') }}
                        </th>
                        <td>
                            {{ $ebilling->money }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Ebilling::STATUS_SELECT[$ebilling->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.receipt') }}
                        </th>
                        <td>
                            {{-- @if($ebilling->receipt) --}}
                                <a href="{{url('/images/1/abc.png')}}" target="_blank">
                                    <img src="{{url('images/1/abc.png')}}" width="50" height="100">
                                </a>
                            {{-- @endif --}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.remark') }}
                        </th>
                        <td>
                            {{ $ebilling->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.order') }}
                        </th>
                        <td>
                            {{ $ebilling->order->price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.user') }}
                        </th>
                        <td>
                            {{ $ebilling->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ebilling.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $ebilling->payment_method->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ebillings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection