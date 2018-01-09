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
            $settings_url= url("admin/forms/type-settings",$post->slug);
            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>
                    <a href='$settings_url' class='btn btn-primary'><i class='fa fa-eye'></i></a>";
        },2)->addColumn('author', function ($post) {

            return BBGetUser($post->author_id);
        })->rawColumns(['actions'])->make(true);
  }
}