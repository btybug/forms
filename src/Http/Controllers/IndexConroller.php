<?php

namespace BtyBugHook\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $form=null;
        return view('forms::form_bulder',compact('form'));
    }
    public function postFormBulder(
        Request $request,
        FormService $service
    )
    {
        $service->createOrUpdate($request->except('_token'));

        return redirect()->to('admin/forms')->with('message','Form successfully Saved');
    }
}