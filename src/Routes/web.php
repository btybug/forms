<?php
/**
 * Copyright (c) 2017.
 * *
 *  * Created by PhpStorm.
 *  * User: Edo
 *  * Date: 10/3/2016
 *  * Time: 10:44 PM
 *
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//Routes

Route::get('/', 'IndexConroller@getIndex',true);
Route::get('/create', 'IndexConroller@getFormBulder',true)->name("forms_builder_form");
Route::post('/create', 'IndexConroller@postFormBulder')->name('add_or_update_form_builder');
Route::post('/get-fields', 'IndexConroller@getFieldsByTable');
Route::post('/render-unit', 'IndexConroller@unitRenderWithFields');
Route::get('/fields', 'IndexConroller@getFields',true);
Route::get('/field-delete/{id}', 'IndexConroller@getDeleteFields');

Route::get('/fields/{id}', 'IndexConroller@getEditField',true);
Route::get('/type-settings', 'IndexConroller@getTypeSettings',true);
Route::get('/type-settings/{slug}', 'IndexConroller@getTypeSettings',true);
Route::post('/ajax-type-settings/{slug}', 'IndexConroller@getAjaxTypeSettings',true);
Route::get('/settings', 'IndexConroller@getSettings',true);
Route::post('/render-field-types', 'IndexConroller@postRenderFieldTypes');
Route::post('/get-field-html', 'IndexConroller@fieldHtml');
Route::post('/save-field', 'IndexConroller@saveField')->name('forms_save_field');

Route::group(['prefix'=>'frontend'],function (){
    Route::get('/my-field-page-settings', 'FrontEndConroller@getMyfieldSettings',true);
});

Route::group(['prefix'=>'datatable'],function (){
    Route::get('get-field-types','DataTablesConroller@getFieldTypes')->name('field_types_dt');
    Route::get('get-my-fields','DataTablesConroller@getMyFields')->name('my_fields_dt');
});

