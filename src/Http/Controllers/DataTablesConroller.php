<?php

namespace BtyBugHook\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Forms\Models\FieldTypes;
use BtyBugHook\Forms\Models\UserFields;
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

  public function getMyFields()
    {
        return DataTables::of(UserFields::where('user_id',\Auth::id()))->addColumn('actions', function ($post) {
            $url= '';//url("admin/forms/fields",$post->id);
            $settings_url= '';//url("admin/forms/type-settings",$post->slug);
            $delete_url= '';// url("admin/forms/type-settings",$post->slug);
            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>
                    <a href='$settings_url' class='btn btn-primary'><i class='fa fa-eye'></i></a>
                    <a href='$delete_url' class='btn btn-danger'><i class='fa fa-trash'></i></a>";
        },2)->editColumn('name', function ($post){
            $data = json_decode($post->json_data,true);
            return (! isset($data['name'])) ?: $data['name'];
        })->editColumn('label', function ($post){
            $data = json_decode($post->json_data,true);
            return (! isset($data['label'])) ?: $data['label'];
        })->editColumn('placeholder', function ($post){
            $data = json_decode($post->json_data,true);
            return (! isset($data['placeholder'])) ?: $data['placeholder'];
        })->editColumn('created_at', function ($post){
            return BBgetDateFormat($post->created_at);
        })->rawColumns(['actions'])->make(true);
  }
}