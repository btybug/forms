<?php

namespace BtyBugHook\Blog;
use BtyBugHook\Forms\Services\CommonService;

/**
 * Created by PhpStorm.
 * User: Edo
 * Date: 8/8/2016
 * Time: 9:11 PM
 */


class Autoload
{
// this function will called only install time
    public function up($config){
    	// Testing commits
//        Test::migrate();
//        Test::seed();
        CommonService::registerFrontendPages();
    }
    // this function will called only uninstall time
    public function down($config){
    }
}