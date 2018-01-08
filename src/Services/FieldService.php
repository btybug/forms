<?php namespace  BtyBugHook\Forms\Services;
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 08.01.2018
 * Time: 16:14
 */

class FieldService extends \Btybug\Console\Services\FieldService
{
    public function returnHtml($field)
    {
        if($field->type && $field->type == 'special'){
            return BBRenderUnits($field->default_value,['field_id' => $field->id]);
        }else{
            if(\View::exists("forms::_partials.fields.text".$field->type)){
                return  \view("forms::_partials.fields.text".$field->type)->with('field',$field->toArray())->render();
            }
           return "<p>unexpected type</p>";
        }
    }
}