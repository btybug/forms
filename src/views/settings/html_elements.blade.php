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
        "abbreviation" => '<abbr>Heading 6 Element</abbr>',
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