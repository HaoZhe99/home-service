@extends('layouts.admin')
@section('content')
    @can('order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Order"
                    style="border-left-color: black">
                    <thead>
                        <tr>
                            {{-- <th width="10">

                        </th> --}}
                            <th>
                                {{ trans('cruds.order.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.status') }}
                            </th>
                            {{-- <th>
                                {{ trans('cruds.order.fields.comment') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.rate') }}
                            </th> --}}
                            {{-- <th>
                                {{ trans('cruds.order.fields.remark') }}
                            </th> --}}
                            <th>
                                {{ trans('cruds.order.fields.merchant') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.package') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.servicer') }}
                            </th>
                            {{-- <th>
                                {{ trans('cruds.order.fields.qr_code') }}
                            </th> --}}
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr data-entry-id="{{ $order->id }}">
                                {{-- <td>

                                </td> --}}
                                <td>
                                    {{ $order->id ?? '' }}
                                </td>
                                <td>
                                    {{ $order->price ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Order::STATUS_SELECT[$order->status] ?? '' }}
                                </td>
                                {{-- <td>
                                    {{ $order->comment ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Order::RATE_SELECT[$order->rate] ?? '' }}
                                </td>
                                <td>
                                    {{ $order->remark ?? '' }}
                                </td> --}}
                                <td>
                                    {{ $order->merchant->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->package->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->servicer->name ?? '' }}
                                </td>
                                {{-- <td>
                                    {{ $order->qr_code->code ?? '' }}
                                </td> --}}
                                <td>
                                    @can('order_show')
                                        <a class="btn btn-xs btn-secondary" href="{{ route('admin.orders.show', $order->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-success" href="{{ route('admin.orders.complete', $order->id) }}">
                                            Completed
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-warning" href="{{ route('admin.orders.incomplete', $order->id) }}">
                                            Incomplete
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <button class="btn btn-xs btn-dark"  data-toggle="modal" data-target="#exampleModal">
                                            Assign Servicer
                                        </button>
                                    @endcan

                                    @can('order_delete')
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    Assign Servicer
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.assign', [$order->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="servicer_id">{{ trans('cruds.order.fields.servicer') }}</label>
                            <select class="form-control select2 {{ $errors->has('servicer') ? 'is-invalid' : '' }}"
                                name="servicer_id" id="servicer_id">
                                @foreach ($servicers as $id => $entry)
                                    <option value="{{ $id }}"
                                        {{ (old('servicer_id') ? old('servicer_id') : $servicer->id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('servicer'))
                                <span class="text-danger">{{ $errors->first('servicer') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.servicer_helper') }}</span>
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
    </div>
</div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('order_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.orders.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Order:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
