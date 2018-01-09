<?php

namespace BtyBugHook\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Forms\Models\FieldTypes;
use Yajra\DataTables\DataTables;

class DataTablesConroller extends Controller
{
    public function getFieldTypes()
    {
        return DataTables::of(FieldTypes::query())->addColumn('actions', function ($post) {
            $url= url("admin/forms/fields",$post->id);
            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>";
        },2)->addColumn('author', function ($post) {

            return BBGetUser($post->author_id);
        })->rawColumns(['actions'])->make(true);
  }
}