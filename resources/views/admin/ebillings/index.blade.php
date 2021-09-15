@extends('layouts.admin')
@section('content')
    @can('ebilling_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.ebillings.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.ebilling.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.ebilling.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Ebilling"
                    style="border-left-color: black">
                    <thead>
                        <tr>
                            {{-- <th width="10">

                        </th> --}}
                            <th>
                                {{ trans('cruds.ebilling.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.ebilling.fields.money') }}
                            </th>
                            <th>
                                {{ trans('cruds.ebilling.fields.status') }}
                            </th>
                            {{-- <th>
                            {{ trans('cruds.ebilling.fields.receipt') }}
                        </th> --}}
                            {{-- <th>
                            {{ trans('cruds.ebilling.fields.remark') }}
                        </th> --}}
                            <th>
                                {{ trans('cruds.ebilling.fields.order') }}
                            </th>
                            <th>
                                {{ trans('cruds.ebilling.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.ebilling.fields.payment_method') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ebillings as $key => $ebilling)
                            <tr data-entry-id="{{ $ebilling->id }}">
                                {{-- <td>

                            </td> --}}
                                <td>
                                    {{ $ebilling->id ?? '' }}
                                </td>
                                <td>
                                    {{ $ebilling->money ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Ebilling::STATUS_SELECT[$ebilling->status] ?? '' }}
                                </td>
                                {{-- <td>
                                @if ($ebilling->receipt)
                                    <a href="{{ $ebilling->receipt->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td> --}}
                                {{-- <td>
                                {{ $ebilling->remark ?? '' }}
                            </td> --}}
                                <td>
                                    {{ $ebilling->order->price ?? '' }}
                                </td>
                                <td>
                                    {{ $ebilling->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $ebilling->payment_method->name ?? '' }}
                                </td>
                                <td>
                                    @can('ebilling_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.ebillings.show', $ebilling->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('ebilling_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.ebillings.edit', $ebilling->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('ebilling_edit')
                                        <a class="btn btn-xs btn-success"
                                            href="{{ route('admin.ebillings.approve', $ebilling->id) }}">
                                            {{ trans('global.approve') }}
                                        </a>
                                    @endcan

                                    @can('ebilling_edit')
                                        <a class="btn btn-xs btn-warning"
                                            href="{{ route('admin.ebillings.reject', $ebilling->id) }}">
                                            {{ trans('global.reject') }}
                                        </a>
                                    @endcan

                                    @can('ebilling_delete')
                                        <form action="{{ route('admin.ebillings.destroy', $ebilling->id) }}" method="POST"
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



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('ebilling_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.ebillings.massDestroy') }}",
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
            let table = $('.datatable-Ebilling:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
