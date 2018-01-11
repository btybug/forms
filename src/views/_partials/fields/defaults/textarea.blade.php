<div class="bty-more-textarea">
    <div>
        <label>{!! $data['label'] !!}</label>
    </div>
    <div>
        <div class="bty-new-textarea">
            <textarea id="bio" name="{!! $data['name'] !!}" placeholder="{!! $data['placeholder'] !!}"></textarea>
        </div>

    </div>
    <div>
        <p>{!! $data['help'] !!}</p>
        <span><i class="fa {!! $data['tooltip_icon'] or 'fa-question' !!}" aria-hidden="true"></i></span>
    </div>
</div>