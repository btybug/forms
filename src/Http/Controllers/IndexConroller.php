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

        return view('blog::index');
    }

    public function getPosts(
        PostsRepository $postsRepository
    )
    {
        $posts = $postsRepository->getAll();

        return view('blog::list', compact(['posts']));
    }

    public function getNewPost()
    {
        return view('blog::create');
    }

    public function postNewPost(
        CreatePostRequest $request,
        PostsService $postsService
    )
    {
        $result = $postsService->create($request->except("_token", 'image'), $request->file("image"));

        return redirect()->to('admin/blog/posts')->with("message", "Post Successfully Created");
    }

    public function getSettings(
        FrontPagesRepository $pagesRepository,
        FormsRepository $formsRepository,
        AdminsettingRepository $adminsettingRepository
    )
    {
        $table = 'posts';
        $all = $pagesRepository->findBy('slug', 'all-posts');
        $single = $pagesRepository->findBy('slug', 'single-post');
        $createForms = $formsRepository->getFormsByFieldType($table,['*'],true,'new');
        $editForms = $formsRepository->getFormsByFieldType($table,['*'],true,'edit');
        $columns = \DB::select('SHOW COLUMNS FROM ' . $table);
        $this->data['default'] = ['NULL', 'USER_DEFINED', 'CURRENT_TIMESTAMP'];
        $this->data['tbtypes'] = Migrations::types();
        $this->data['engine'] = Migrations::engine();
        $this->data['table'] = $table;
        $this->data['columns'] = $columns;
        foreach ($columns as $column) {
            $after_columns[$column->Field] = $column->Field;
        }
        $this->data['after_columns'] = $after_columns;
        $settings = $adminsettingRepository->findOneByMultipleSettingsArray(['section' => 'btybug_blog','settingkey' => 'blog_settings']);
        return view('blog::settings', compact(['all', 'single','createForms','editForms','settings']))->with($this->data);
    }

    public function getFormBulder()
    {
        $form = null;
        //$data['form_fields'] = ($settings) ? json_decode($settings->value,true) : [];
        return view("blog::form_bulder",compact('form'));
    }

    public function getEditFormBulder(
        $id,
        FormsRepository $formsRepository,
        FormService $formService
    )
    {
        $form = $formsRepository->findOrFail($id);
        $form->fields_json = $formService->fieldsJson($id,true);
        $fields = json_encode((count($form->form_fields)) ? $form->form_fields()->pluck('field_slug','field_slug')->toArray() : []);
        $html = $formService->render($id);
        return view("blog::form_bulder",compact('form','fields','html'));
    }

    public function postFormBulder(
        Request $request,
        FormService $service
    )
    {
        $service->createOrUpdate($request->except('_token'));

        return redirect()->to('admin/blog/form-list')->with('message','Form successfully Saved');
    }

    public function getList(
        FormsRepository $formsRepository
    )
    {
        $pluginForms = $formsRepository->getFormsByFieldType('posts',['core','plugin']);
        $forms = $formsRepository->getFormsByFieldType('posts',['custom']);
        return view("blog::form-list",compact('pluginForms','forms'));
    }


    public function postSettings(
        Request $request,
        FrontPagesRepository $pagesRepository,
        AdminsettingRepository $adminsettingRepository
    )
    {
        $adminsettingRepository->createOrUpdate(json_encode($request->only('posts_create_form','posts_edit_form','url_manager'),true), 'btybug_blog', 'blog_settings');
        $all = $pagesRepository->findBy('slug', 'all-posts');
        $single = $pagesRepository->findBy('slug', 'single-post');
        $pagesRepository->update($all->id,['template' => $request->all_main_content]);
        $pagesRepository->update($single->id,['template' => $request->single_main_content]);
        return redirect()->back();
    }

    public function unitRenderWithFields(
        Request $request,
        AdminsettingRepository $adminsettingRepository,
        FieldsRepository $fieldsRepository,
        FieldService $fieldService
    )
    {
        $fields = $request->get('fields',null);
        $data = [];
        $existing = [];
        if($fields){
            foreach ($fields as $k => $v){
                $f = $fieldsRepository->find($k);
                if($f) {

                    $existing['object'] = $f;
                    $existing['html'] = $fieldService->returnHtml($f);
                    $existing['field_data'] = get_field_data($f->id);

                    $data[] = $existing;
                }
            }

            return \Response::json(['error' => false,'fields' => $data]);
        }
        return \Response::json(['message' => "Fields are invalid",'error' => true]);
    }

    public function postFormFieldsSettings(Request $request, AdminsettingRepository $adminsettingRepository)
    {
        $data = $request->except('_token');
        $adminsettingRepository->createOrUpdate(json_encode($data,true), 'btybug_blog', 'form_field_settings');
        return redirect()->back();
    }

    public function getEditPost(
        $id,
        PostsRepository $postsRepository
    )
    {
        $post = $postsRepository->findOrFail($id);

        return view('blog::edit',compact('post'));
    }

    public function postEditPos(
        $id,
        Request $request,
        PostsService $postsService
    )
    {
        $result = $postsService->update($request->except("_token", 'image'), $request->file("image"));

        return redirect()->to('admin/blog/posts')->with("message", "Post Successfully Edited");
    }

    public function getFieldsByTable(
        Request $request,
        FieldsRepository $fieldsRepository
    )
    {
        $fields = $fieldsRepository->getWhereNotExists($request->table,$request->fields);
        $html = \View("blog::_partials.field-list",compact('fields'))->render();

        return \Response::json(['html' => $html]);
    }

    public function getFormSettings (
        $id,
        RoleRepository $roleRepository,
        FormsRepository $formsRepository
    )
    {
        $form = $formsRepository->findOrFail($id);
        $formRoles = (count($form->form_roles)) ? $form->form_roles()->pluck('role_id','role_id')->toArray() : [];
        $roles = $roleRepository->getAll()->toArray();
        return view('blog::forms.settings',compact('roles','form','formRoles'));
    }

    public function postFormSettings(
        $id,
        Request $request,
        FormService $formService
    )
    {
        $formService->saveSettings($id,$request);

        return redirect()->back()->with('message','Form settings are saved');
    }

    public function getMyFormsView (
        $id,
        FormsRepository $formsRepository,
        FormService $formService
    )
    {
        $form = $formsRepository->findOneByMultiple(['id' => $id,'created_by' => 'plugin']);
        if( ! $form) abort(404,"Form not found");

        return view('blog::forms.view',compact('form'));
    }

    public function postsData()
    {
        set_time_limit(-1);
        ini_set('memory_limit', '2048M');
        return DataTables::of(Post::query())->addColumn('actions', function ($post) {
            $url= url("admin/blog/edit-post",$post->id);
            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>";
        },2)->addColumn('author', function ($post) {

            return BBGetUser($post->author_id);
        })->rawColumns(['actions'])->make(true);
    }

    public function createPosts()
    {

        set_time_limit(-1);
        ini_set('memory_limit', '2048M');
        $data=array();
        for ($i=0;$i<500;$i++){
            $data[$i]['author_id']=1;
            $data[$i]['title']=str_random(5);
            $data[$i]['description']=str_random(10);
            $data[$i]['image']='images/posts/5a26da145b969.jpg';
            $data[$i]['slug']=str_random(5);
            $data[$i]['status']='published';
        }
        return \DB::table('posts')->insert($data);
    }
}