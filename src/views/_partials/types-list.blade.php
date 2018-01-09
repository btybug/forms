<div class="col-md-12" style="padding: 10px;">
    <div class="col-md-12">
        {!! Form::open(['id' => 'selected-types']) !!}
        @if($types && count($types))
            @foreach($types as $type)
                <label style="    display: block;">
                    <div class="col-md-4 field-item">
                        {!! $type->title !!}
                        {!! Form::checkbox('types['.$type->id.']',1,null) !!}
                    </div>
                </label>
            @endforeach
        @else
            No Available Types
        @endif
    </div>
</div>

<style>
    .field-item {
        height: 50px;
        border: 1px solid;
        padding: 3px;
        text-align: center;
        background: brown;
        color: white;
    }
</style>
