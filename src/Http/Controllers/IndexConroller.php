<?php

namespace BtyBugHook\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
use Btybug\btybug\Repositories\AdminsettingRepository;
use Btybug\Console\Repository\FieldsRepository;
use BtyBugHook\Forms\Http\Requests\FieldCreateRequest;
use BtyBugHook\Forms\Repository\FieldTypesRepository;
use BtyBugHook\Forms\Repository\UserFieldRepository;
use BtyBugHook\Forms\Services\FieldService;
use Btybug\Console\Services\FormService;
use Illuminate\Http\Request;

class IndexConroller extends Controller
{
    public function getIndex()
    {
        dd(1);
        return view('forms::index');
    }

    public function getFormBulder()
    {
        $form = null;
//        return view('forms::form_bulder', compact('form'));
        return view('forms::form_builder', compact('form'));
    }

    public function postFormBulder(
        Request $request,
        FormService $service
    )
    {
        $service->createOrUpdate($request->except('_token'));

        return redirect()->to('admin/forms')->with('message', 'Form successfully Saved');
    }

    public function getFieldsByTable(
        Request $request,
        FieldsRepository $fieldsRepository
    )
    {
        $fields = $fieldsRepository->getWhereNotExists($request->table, $request->fields);
        $html = \View("forms::_partials.field-list", compact('fields'))->render();

        return \Response::json(['html' => $html]);
    }

    public function unitRenderWithFields(
        Request $request,
        AdminsettingRepository $adminsettingRepository,
        FieldsRepository $fieldsRepository,
        FieldService $fieldService
    )
    {
        $fields = $request->get('fields', null);
        $data = [];
        $existing = [];
        if ($fields) {
            foreach ($fields as $k => $v) {
                $f = $fieldsRepository->find($k);
                if ($f) {

                    $existing['object'] = $f;
                    $existing['html'] = $fieldService->returnHtml($f);
                    $existing['field_data'] = get_field_data($f->id);

                    $data[] = $existing;
                }
            }

            return \Response::json(['error' => false, 'fields' => $data]);
        }
        return \Response::json(['message' => "Fields are invalid", 'error' => true]);
    }

    public function getFields()
    {
        return view('forms::fields.index');
    }

    public function getEditField(
        $id
    )
    {
        $field = null;
        return view('forms::fields.edit', compact('field'));
    }

	public function getTypeSettings(
		$slug
	) {
		return view( 'forms::fields.type-settings', compact( 'slug' ) );
	}

	public function getAjaxTypeSettings(
		$slug
	) {
		return view( 'forms::fields.ajax-type-settings', compact( 'slug' ) );
	}

    public function getSettings()
    {
        return view('forms::settings');
    }

    public function postRenderFieldTypes(
        Request $request,
        FieldTypesRepository $typesRepository
    )
    {
        $types = $typesRepository->getAll();
        $html = \View("forms::_partials.types-list", compact('types'))->render();

        return \Response::json(['html' => $html]);
    }

    public function fieldHtml(
        Request $request
    )
    {
        $html = null;
        $value = $request->get('value');
        $options = $request->get('options', []);

        if (\View::exists('forms::_partials.fields.defaults.' . $value)) {
            $html = view('forms::_partials.fields.defaults.' . $value)->with('data', $options)->render();
        }

        return \Response::json(['html' => $html]);
    }

    public function saveField(
        FieldCreateRequest $request,
        UserFieldRepository $fieldRepository
    )
    {
        if($request->get('id')){
            $result = $fieldRepository->update($request->get('id'),[
                'user_id' => \Auth::id(),
                'field_type' => $request->get('field_type'),
                'json_data' => $request->except('_token')
            ]);
        }else{
            $result = $fieldRepository->create([
                'user_id' => \Auth::id(),
                'field_type' => $request->get('field_type'),
                'json_data' => $request->except('_token')
            ]);
        }

        return ($result) ? redirect('my-account/my-fields')
            ->with("message", 'Field Saved Successfully') : back()->with('error', 'Something went wrong');
    }

    public function getDeleteFields(
        $id,
        UserFieldRepository $fieldRepository
    )
    {
        $field = $fieldRepository->findOneByMultiple(['id' => $id,'user_id'=> \Auth::id()]);
        if ($field) $field->delete();

        return back();
    }

    public function getFromLayout(Request $request){

	    $html = "";
	    $css = "";
	    $js = "";

	    return \Response::json([
	    	'html' => $html,
		    'css' => $css,
		    'js' => $js,
	    ]);
    }

	public function getRenderAssets(Request $request){

    	$assetsType = $request->get('assets_type');
    	$assetsFile = $request->get('assets_file');

		$html = "";

		return \Response::json([
			'type' => $assetsType
		]);
	}
}