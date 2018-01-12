<?php namespace  BtyBugHook\Forms\Services;
use Btybug\Console\Repository\FrontPagesRepository;

/**
 * Created by PhpStorm.
 * User: menq
 * Date: 08.01.2018
 * Time: 16:14
 */

class CommonService extends \Btybug\Console\Services\FieldService
{
    private static $frontPagesArray = [
        'my-account' => [
            [
                'title' => 'My fields',
                'slug' => 'my-fields',
                'url' => '/my-account/my-fields',
                'module_id' => 'sahak.avatar/forms',
                'content_type' => 'template',
                'header' => true,
                'form_path' => 'forms::frontend.my_fields_page_settings'
            ],
            [
                'title' => 'My forms',
                'slug' => 'my-forms',
                'url' => '/my-account/my-forms',
                'module_id' => 'sahak.avatar/forms',
                'header' => true,
                'content_type' => 'special',
                'settings' => [
                    "file_path" => "\\BtyBugHook\\Forms\\Http\\Controllers\\FrontEndConroller@myForms"
                ]
            ]
        ],
        [
            'title' => 'Field Edit',
            'slug' => 'my-field-edit',
            'url' => '/my-account/my-fields/edit/{param}',
            'module_id' => 'sahak.avatar/forms',
            'header' => true,
            'content_type' => 'special',
            'settings' => [
                "file_path" => "\\BtyBugHook\\Forms\\Http\\Controllers\\FrontEndConroller@myFieldEdit"
            ]
        ]
    ];

    public static function registerFrontendPages()
    {
        $frontendPageRepository = new FrontPagesRepository();
        $pagesData = self::$frontPagesArray;
        if(count($pagesData)){
            foreach ($pagesData as $parentPageSlug => $subPages){
                $parentPage = $frontendPageRepository->findBy('slug',$parentPageSlug);
                if($parentPage && count($subPages)){
                    foreach ($subPages as $data){
                        $data['parent_id'] = $parentPage->id;
                        register_frontend_page($data);
                    }
                }else{
                    foreach ($subPages as $data){
                        $data['parent_id'] = 0;
                        register_frontend_page($data);
                    }
                }
            }
        }
    }
}