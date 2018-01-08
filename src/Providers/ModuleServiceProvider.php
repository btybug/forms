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

namespace BtyBugHook\Forms\Providers;

use Btybug\btybug\Models\Routes;
use Illuminate\Support\ServiceProvider;


class ModuleServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../views', 'forms');
        $this->loadViewsFrom(__DIR__ . '/../views', 'forms');
        \Eventy::action('admin.menus', [
            "title" => "Forms",
            "custom-link" => "#",
            "icon" => "fa fa-anchor",
            "is_core" => "yes",
            "children" => [
                [
                    "title" => "Fields",
                    "custom-link" => "/admin/forms/fields",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ], [
                    "title" => "Forms",
                    "custom-link" => "/admin/forms",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ], [
                    "title" => "Settings",
                    "custom-link" => "/admin/forms/settings",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ]
            ]]);
        Routes::registerPages('sahak.avatar/forms');
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

    }

}

