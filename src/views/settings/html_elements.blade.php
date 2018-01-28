@php

$elementsGroups = [
    "Text Elements" => [
        "h1" => '<h1>Heading 1 Element</h1>',
        "h2" => '<h2>Heading 2 Element</h2>',
        "h3" => '<h3>Heading 3 Element</h3>',
        "h4" => '<h4>Heading 4 Element</h4>',
        "h5" => '<h5>Heading 5 Element</h5>',
        "h6" => '<h6>Heading 6 Element</h6>',
        "span" => '<span>Sample text...</span>',
        "small" => '<small>Sample text...</small>',
        "b" => '<b>Sample text...</b>',
        "strong" => '<strong>Sample text...</strong>',
        "i" => '<i>Sample text...</i>',
        "del" => '<del>Sample text...</del>',
        "ins" => '<ins>Sample text...</ins>',
        "mark" => '<mark>Sample text...</mark>',
        "u" => '<u>Sample text...</u>',
        "br" => '<br />',
        "blockquote" => '<blockquote>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
    <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
</blockquote>',
        "abbreviation" => '<abbr>Sample text...</abbr>',
    ],
    "Bootstrap Components" => [
        'jumbotron' => '<div class="jumbotron"> <h1>Hello, world!</h1> <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p> <p><a href="#" class="btn btn-primary btn-lg" role="button">Learn more</a></p> </div>',

        'page header' => '<div class="page-header">
  <h1>Example page header <small>Subtext for header</small></h1>
</div>',

        'thumbnail' => '<div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTYxM2E2Y2YwZDMgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNjEzYTZjZjBkMyI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44NTkzNzUiIHk9IjEwNS4xIj4yNDJ4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"> <div class="caption"> <h3>Thumbnail label</h3> <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> </div> </div>',

        'panel' => '<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>',
    ],
    "Container Elements" => [],
    "Buttons & Links" => [],
    "Other Elements" => [
        "img" => '<img src="https://placeimg.com/640/480/any" />'
    ],
];

@endphp


@foreach($elementsGroups as $group => $elements)
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$group}}</h3>
    </div>
    <div class="panel-body">
        <div class="html-elements-list">
            @foreach($elements as $tag => $element)
            <div class="html-element-item draggable-element" data-type="element">
                {{$tag}}
                <div class="html-element-item-sample hidden">{!! $element !!}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach