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
        return view('forms::index');
    }

    public function getFormBulder()
    {
        $form = null;
        return view('forms::form_bulder', compact('form'));
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
    )
    {
        return view('forms::fields.type-settings', compact('slug'));
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
        $result = $fieldRepository->create([
            'user_id' => \Auth::id(),
            'field_type' => $request->get('field_type'),
            'json_data' => json_encode($request->except('_token'),true)
        ]);

        return ($result) ? redirect('my-account/my-fields')
            ->with("message", 'Field Created Successfully') : back()->with('error', 'Something went wrong');
    }
}