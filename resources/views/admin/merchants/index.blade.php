@extends('layouts.admin')
@section('content')
    @can('merchant_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.merchants.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.merchant.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.merchant.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Merchant"
                    style="border-left-color: black">
                    <thead>
                        <tr>
                            {{-- <th width="">

                        </th> --}}
                            <th>
                                {{ trans('cruds.merchant.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.merchant.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.merchant.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.merchant.fields.contact_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.merchant.fields.status') }}
                            </th>
                            {{-- <th>
                            {{ trans('cruds.merchant.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.longitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.latitude') }}
                        </th> --}}
                            {{-- <th>
                            {{ trans('cruds.merchant.fields.ssm_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.ssm_document') }}
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.logo') }}
                        </th> --}}
                            <th>
                                {{ trans('cruds.merchant.fields.category') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchants as $key => $merchant)
                            <tr data-entry-id="{{ $merchant->id }}">
                                {{-- <td>

                            </td> --}}
                                <td>
                                    {{ $merchant->id ?? '' }}
                                </td>
                                <td>
                                    {{ $merchant->name ?? '' }}
                                </td>
                                <td>
                                    {{ $merchant->description ?? '' }}
                                </td>
                                <td>
                                    {{ $merchant->contact_number ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Merchant::STATUS_SELECT[$merchant->status] ?? '' }}
                                </td>
                                {{-- <td>
                                {{ $merchant->address ?? '' }}
                            </td>
                            <td>
                                {{ $merchant->state->state ?? '' }}
                            </td>
                            <td>
                                {{ $merchant->longitude ?? '' }}
                            </td>
                            <td>
                                {{ $merchant->latitude ?? '' }}
                            </td> --}}
                                {{-- <td>
                                {{ $merchant->ssm_number ?? '' }}
                            </td>
                            <td>
                                @if ($merchant->ssm_document)
                                    <a href="{{ $merchant->ssm_document->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td> --}}
                                {{-- <td>
                                @if ($merchant->logo)
                                    <a href="{{ $merchant->logo->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td> --}}
                                <td>
                                    @foreach ($merchant->categories as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('merchant_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.merchants.show', $merchant->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('merchant_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.merchants.edit', $merchant->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('merchant_delete')
                                        <form action="{{ route('admin.merchants.destroy', $merchant->id) }}" method="POST"
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
            @can('merchant_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.merchants.massDestroy') }}",
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
            let table = $('.datatable-Merchant:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
