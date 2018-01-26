<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Basic Fields</h3>
    </div>
    <div class="panel-body">
        @if($types && count($types))
            <div class="html-elements-list">
                @foreach($types as $type)
                    <div class="html-element-item draggable-element"
                         data-type="{!! $type->slug !!}">{!! $type->title !!}</div>
                @endforeach
            </div>
        @else
            No Available Types
        @endif
    </div>
</div>