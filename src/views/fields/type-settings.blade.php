@extends('btybug::layouts.admin')
@section('content')
   <div class="col-md-12">
        @include("forms::_partials.fields.".$slug)
   </div>
@endsection
@section('CSS')
    {!! HTML::style('public/css/bootstrap/css/bootstrap-switch.min.css') !!}
    {!! HTML::style('public/css/font-awesome/css/fontawesome-iconpicker.min.css') !!}
@stop
@section('JS')
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
@endsection
