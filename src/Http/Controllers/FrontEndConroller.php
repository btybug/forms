<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 09.01.2018
 * Time: 16:49
 */

namespace BtyBugHook\Forms\Http\Controllers;


use BtyBugHook\Forms\Models\FieldTypes;
use Illuminate\Routing\Controller;

//FrontEndConroller@getFieldTypes

class FrontEndConroller extends Controller
{
    public function getFieldTypes(FieldTypes $fieldTypes)
    {
        $types=$fieldTypes->all();
        return view('forms::frontend.fields.index',compact('types'));
    }
    public function getFieldTypesSettings(FieldTypes $fieldTypes,$param)
    {
        $type=$fieldTypes->find($param);
        return view('forms::frontend.fields.settings',compact('types'));
    }
}