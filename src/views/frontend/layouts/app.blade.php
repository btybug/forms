<!DOCTYPE html>
@php
    if(!isset($page)){
        $page = \Btybug\btybug\Services\RenderService::getFrontPageByURL();
    }

@endphp
<html>
<head>
    @yield('CSS')
    {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    {!! Html::style('public/css/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('public/css/cms.css') !!}
    {!! HTML::style('public-x/custom/css/'.str_replace(' ','-',$page->slug).'.css') !!}
</head>
<body>
{!! BBheader() !!}
@yield('content')

{!! Html::script('public/js/jquery-2.1.4.min.js') !!}
{!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
@yield('JS')
{!! HTML::script('public-x/custom/js/'.str_replace(' ','-',$page->slug).'.js ') !!}
</body>
</html>