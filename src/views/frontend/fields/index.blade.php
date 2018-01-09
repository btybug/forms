@extends('forms::frontend.layouts.app')
@section('content')
    <section>
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <table id="fields-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </thead>
                </table>
            </div>
            <div class="col-md-3"></div>
        </div>
    </section>
    {!! BBscript(base_path('public'.DS.'js'.DS.'DataTables'.DS.'datatables.js')) !!}
    {!! BBscript(base_path('public'.DS.'js'.DS.'DataTables'.DS.'Buttons-1.5.1'.DS.'js'.DS.'buttons.bootstrap.js')) !!}
@stop
@section('CSS')
    {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    {!! Html::style('public/css/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('public/js/DataTables/Buttons-1.5.1/css/buttons.bootstrap.css') !!}
@stop

@section('JS')
    {!! Html::script('public/js/jquery-2.1.4.min.js') !!}
    {!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
    {!! Html::script('public/js/DataTables/datatables.js') !!}
    <script>
        $(function () {
            $('#fields-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', {
                        text: 'Reload',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    }
                ],

                ajax: '{!! route('field_types_dt') !!}',
                columns: [
                    {data: 'id', name: 'id',},
                    {data: 'title', name: 'title'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
