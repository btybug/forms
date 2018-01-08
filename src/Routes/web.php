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
Route::get('/posts', 'IndexConroller@getPosts',true);
Route::get('/posts-data', 'IndexConroller@postsData')->name('postsData');
Route::get('/create-data', 'IndexConroller@createPosts');
Route::get('/new-post', 'IndexConroller@getNewPost',true);
//Route::post('/new-post', 'IndexConroller@postNewPost');
Route::post('/get-fields', 'IndexConroller@getFieldsByTable');
Route::get('/settings', 'IndexConroller@getSettings',true);

Route::post('/render-fields', 'MyFormController@postRenderField');
Route::post('/save-form', 'MyFormController@postSaverForm');

Route::group(['prefix'=>'edit-post'],function (){
    Route::get('/', 'IndexConroller@getEditPost',true);
    Route::get('/{param}', 'IndexConroller@getEditPost',true);
    Route::post('/{param}', 'IndexConroller@postEditPos');
});

Route::group(['prefix'=>'form-list'],function (){
    Route::get('/', 'IndexConroller@getList',true);
    Route::get('/create', 'IndexConroller@getFormBulder',true)->name("form_builder_blog");

    Route::group(['prefix'=>'edit-form'],function (){
        Route::get('/', 'IndexConroller@getEditFormBulder',true);
        Route::get('/{id}', 'IndexConroller@getEditFormBulder',true)->name("form_edit_builder");
    });

    Route::post('/create', 'IndexConroller@postFormBulder')->name('add_or_update_form_builder');

    Route::group(['prefix'=>'settings'],function (){
        Route::get('/', 'IndexConroller@getFormSettings',true);
        Route::get('/{id}', 'IndexConroller@getFormSettings',true)->name("form_settings");
        Route::post('/{id}', 'IndexConroller@postFormSettings',true)->name("post_form_settings");
    });
    Route::group(['prefix'=>'view'],function (){
        Route::get('/', 'IndexConroller@getMyFormsView',true);
        Route::get('/{id}', 'IndexConroller@getMyFormsView',true)->name("form_view");
    });
    Route::group(['prefix'=>'edit'],function (){
        Route::get('/', 'MyFormController@getMyFormsEdit',true);
        Route::get('/{id}', 'MyFormController@getMyFormsEdit',true)->name("form_edit");
    });
    Route::post('/form-fields', 'IndexConroller@postFormFieldsSettings');
});
Route::post('/settings', 'IndexConroller@postSettings');
Route::post('/render-unit', 'IndexConroller@unitRenderWithFields');