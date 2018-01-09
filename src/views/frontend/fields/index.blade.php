@extends('forms::frontend.layouts.app')
@section('content')
    <section>
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-8 custom_html_for_filter">
                @foreach($types as $type)
                    <div class="bty-unit-2">
                        <div class="custom_margin_5">
                            <div>
                                <span>{!! BBgetDateFormat($type->created_at,"d") !!}</span>
                                <span>{!! BBgetDateFormat($type->created_at,"M") !!}</span>
                                <span>{!! BBgetDateFormat($type->created_at,"Y") !!}</span>
                            </div>
                            <span><img src="http://blog.mcafeeinstitute.com/wp-content/uploads/2015/10/rain_wallpaper_good_2023_high_definition.jpg"
                                       alt=""></span>
                            <div class="{{ 'custom_div_for_tags'}}">
                                <ul>
                                    <li><a href=" {{url('field-types/settings',$type->id)}}"><i
                                                    class="fa fa-cog" aria-hidden="true"></i> </a></li>
                                </ul>
                                <div>
                                    <div class="bty-unit-2-title">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> {!! $type->title !!}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-2"></div>
        </div>
    </section>

@stop
@section('CSS')

@stop

@section('JS')

@stop
