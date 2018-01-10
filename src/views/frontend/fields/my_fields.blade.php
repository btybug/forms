@extends('forms::frontend.layouts.app')
@section('content')
        <div class="col-md-12">
            <h3>My Fields</h3>
            <table id="fields-table"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Label</th>
                    <th>Placeholder</th>
                    <th>Type</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </thead>
            </table>
        </div>

@stop
@section('CSS')
    {!! Html::style('public/js/DataTables/Buttons-1.5.1/js/buttons.bootstrap.js') !!}
@stop
@section('JS')
    {!! Html::script('public/js/DataTables/datatables.js') !!}
    <script>
        $(function () {
            $('#fields-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf',{
                        text: 'Reload',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                        }
                    },{
                        text: 'Field Types',
                        action: function ( e, dt, button, config ) {
                            window.location = '/field-types'
                        }
                    }
                ],

                ajax: '{!! route('my_fields_dt') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'label', name: 'label'},
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'field_type', name: 'field_type'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
