<!DOCTYPE html>
@php
    if(!isset($page)){
        $page = \Btybug\btybug\Services\RenderService::getFrontPageByURL();
    }

@endphp
<html>
<head>
    @yield('CSS')

    {!! HTML::style('public-x/custom/css/'.str_replace(' ','-',$page->slug).'.css') !!}
</head>
<body>
@yield('content')
{!! HTML::script('public-x/custom/js/'.str_replace(' ','-',$page->slug).'.js ') !!}
@yield('JS')
</body>
</html>