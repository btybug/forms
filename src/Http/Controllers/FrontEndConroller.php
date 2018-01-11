<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 09.01.2018
 * Time: 16:49
 */

namespace BtyBugHook\Forms\Http\Controllers;


use BtyBugHook\Forms\Models\FieldTypes;
use BtyBugHook\Forms\Repository\FieldTypesRepository;
use BtyBugHook\Forms\Repository\UserFieldRepository;
use Illuminate\Routing\Controller;

//FrontEndConroller@getFieldTypes

class FrontEndConroller extends Controller
{
    public function getFieldTypes(FieldTypes $fieldTypes)
    {
        $types = $fieldTypes->all();
        return view('forms::frontend.fields.index', compact('types'));
    }

    public function getFieldTypesSettings(
        FieldTypesRepository $fieldTypes,
        $slug
    )
    {
        $type = $fieldTypes->findBy('slug', $slug);
        $data = null;
        return view('forms::frontend.fields.settings', compact('types','slug','data'));
    }

    public function myFields()
    {
        return view('forms::frontend.fields.my_fields');
    }

    public function myForms()
    {
        return view('forms::frontend.my_forms');
    }

    public function myFieldEdit(
        UserFieldRepository $fieldRepository,
        $id
    )
    {
        $field = $fieldRepository->findOneByMultiple(['id'=>$id,'user_id'=>\Auth::id()]);
        $slug = ($field) ? $field->field_type : null;
        $data = $field->json_data;
        return view('forms::frontend.fields.settings',compact(['field','slug','data']));
    }
}