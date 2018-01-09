<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 09.01.2018
 * Time: 16:49
 */

namespace BtyBugHook\Forms\Http\Controllers;


use Illuminate\Routing\Controller;

//FrontEndConroller@getFieldTypes

class FrontEndConroller extends Controller
{
    public function getFieldTypes()
    {
        return view('forms::frontend.fields.index');
    }
}