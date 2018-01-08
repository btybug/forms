<?php

namespace BtyBugHook\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Btybug\Console\Models\Forms;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use Btybug\Console\Services\FieldService;
use Btybug\Console\Services\FormService;
use Btybug\User\Repository\RoleRepository;
use BtyBugHook\Blog\Models\Post;
use Illuminate\Http\Request;
use Btybug\btybug\Models\Templates\Units;
use Btybug\Console\Repository\FrontPagesRepository;
use Btybug\btybug\Models\Migrations;
use Btybug\btybug\Repositories\AdminsettingRepository;
use BtyBugHook\Blog\Http\Requests\CreatePostRequest;
use BtyBugHook\Blog\Http\Requests\PostSettingsRequest;
use BtyBugHook\Blog\Repository\PostsRepository;
use BtyBugHook\Blog\Services\PostsService;
use Yajra\DataTables\DataTables;

class IndexConroller extends Controller
{
    public function getIndex()
    {
        return view('forms::index');
    }
}