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
Route::get('/fields/{id}', 'IndexConroller@getEditField',true);
Route::get('/settings', 'IndexConroller@getSettings',true);
Route::post('/render-field-types', 'IndexConroller@postRenderFieldTypes');

Route::group(['prefix'=>'datatable'],function (){
    Route::get('get-field-types','DataTablesConroller@getFieldTypes')->name('field_types_dt');
});

