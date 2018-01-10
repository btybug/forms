@extends('forms::frontend.layouts.app')
@section('content')
        <table id="fields-table"  class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Actions</th>
            </thead>
        </table>

@stop
@section('CSS')
    {!! Html::style('public/js/DataTables/Buttons-1.5.1/js/buttons.bootstrap.js') !!}
@stop
@section('JS')
    {!! Html::script('public/js/DataTables/datatables.js') !!}
    <script>
        $(function () {
            {{--$('#fields-table').DataTable({--}}
                {{--dom: 'Bfrtip',--}}
                {{--buttons: [--}}
                    {{--'copy', 'excel', 'pdf',{--}}
                        {{--text: 'Reload',--}}
                        {{--action: function ( e, dt, node, config ) {--}}
                            {{--dt.ajax.reload();--}}
                        {{--}--}}
                    {{--},{--}}
                        {{--text: 'Create New',--}}
                        {{--action: function ( e, dt, node, config ) {--}}

                        {{--}--}}
                    {{--}--}}
                {{--],--}}

                {{--ajax: '{!! route('field_types_dt') !!}',--}}
                {{--columns: [--}}
                    {{--{data: 'id', name: 'id',},--}}
                    {{--{data: 'title', name: 'title'},--}}
                    {{--{data: 'actions', name: 'actions'}--}}
                {{--]--}}
            {{--});--}}
        });
    </script>
@stop
