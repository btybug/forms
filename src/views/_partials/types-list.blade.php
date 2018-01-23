<div class="bb-fields-list">
    @if($types && count($types))
        @foreach($types as $type)
            <div data-type="{!! $type->slug !!}">{!! $type->title !!}</div>
        @endforeach
    @else
        No Available Types
    @endif
</div>