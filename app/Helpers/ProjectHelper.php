<?php
/*
 * Here you can make your own shortcut functions.
 * You can check Minmax\Base\Helper\ShortcutHelper.php to learn how to make.
 */

if (! function_exists('sampleInfo')) {
    /**
     * Get php server info.
     */
    function sampleInfo()
    {
        echo phpinfo();
        exit();
    }
}


function stripTags($html){

    $html = strip_tags($html);
    $html = preg_replace('/\n/is','',$html);
    $html = preg_replace('/ |　/is','',$html);
    $html = preg_replace('/ /is','',$html);


    return $html ? $html : '';
}



function breadcrumbs($route, $parameters = [])
{
    $breadcrumbs = array();
    $breadcrumbs[] = ['uri' => route('web.home') , 'title' => trans('web.menu.home')];

    //\Request::route()->getName()
    switch($route){
        case 'web.page.web-about':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-president':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-president')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-history':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-history')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-organization':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-organization')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;


        case 'web.page.web-about-management':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-management')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-vision':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-vision')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-awards':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-awards')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-relationship':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-relationship')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-about-location':
            $breadcrumbs[] = ['uri' => route('web.page.web-about') , 'title' => trans('web.menu.abouts')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-abouts-about-location')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            break;

        case 'web.page.web-news':
            $breadcrumbs[] = ['uri' => route('web.page.web-news') , 'title' => trans('web.menu.news')];

            $articleCategory = \Minmax\Article\Models\ArticleCategory::query()
                ->with(['articleCategories.articleCategories'])
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->where(function($query){
                    $query->orwhere('id',request()->route('cls'))->distributedOrWhere('path',request()->route('cls'));
                })
                ->distributedActive()
                ->first();

            if(filled(request()->route('cls'))) {
                $breadcrumbs[] = ['uri' => route('web.page.web-news', ['cls' => request()->route('cls') ?? '']), 'title' => array_get($articleCategory, 'title', trans('web.news.all'))];
            }else{
                $breadcrumbs[] = ['uri' => route('web.page.web-news'), 'title' =>  trans('web.news.all')];
            }
            break;

        case 'web.page.web-news-post':
            $breadcrumbs[] = ['uri' => route('web.page.web-news') , 'title' => trans('web.menu.news')];

            $articleCategory = \Minmax\Article\Models\ArticleCategory::query()
                ->with(['articleCategories.articleCategories'])
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->where(function($query){
                    $query->orwhere('id',request()->route('cls'))->distributedOrWhere('path',request()->route('cls'));
                })
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => route('web.page.web-news', ['cls' => request()->route('cls') ?? '']), 'title' => array_get($articleCategory, 'title', trans('web.news.all'))];


            break;


        case 'web.page.web-products':
            $breadcrumbs[] = ['uri' => route('web.page.web-products') , 'title' => trans('web.menu.products')];

            /*
            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-products')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];
            */

            break;

        case 'web.page.web-products-post':
            $breadcrumbs[] = ['uri' => route('web.page.web-products') , 'title' => trans('web.menu.products')];

            $articleIntroId = request()->route('id');

            $model = $articleIntro = \Minmax\Article\Models\ArticleIntro::query()
                ->with([
                    'articleCategories',
                    'articleCategories.articleCategory',
                ])

                ->where(function ($query) {
                    $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
                })
                ->where(function ($query) {
                    $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
                })
                ->where(function($query) use($articleIntroId){
                    $query->orWhere('id',$articleIntroId)->distributedOrWhere('path',$articleIntroId);
                })
                ->distributedActive()
                ->first();


            $breadcrumbs[] = ['uri' => route('web.page.web-products-post',[
                'cls' => array_get($articleIntro,'articleCategories.0.path',array_get($articleIntro,'articleCategories.0.id')) ,
                'cls2' => array_get($articleIntro,'articleCategories.0.articleCategory.path',array_get($articleIntro,'articleCategories.0.articleCategory.id')),
                'id' => request()->route('id')
            ]) , 'title' => array_get($articleIntro,'title') ];
            break;

        case 'web.page.web-financial':
            $breadcrumbs[] = ['uri' => route('web.page.web-financial') , 'title' => trans('web.menu.investor')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-investor-financials')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-investor-financial')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];
            break;

        case 'web.page.web-financial-income-statement':
            $breadcrumbs[] = ['uri' => route('web.page.web-financial') , 'title' => trans('web.menu.investor')];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-investor-financials')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];

            $menu = \Minmax\Base\Models\SystemMenu::query()
                ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))
                ->distributedWhere('guard', 'web')
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('code','web-header-investor-financial-income-statement')
                ->distributedActive()
                ->first();

            $breadcrumbs[] = ['uri' => array_get($menu,'url') , 'title' => array_get($menu,'title') ];
            break;


    }

    $arr['breadcrumbs'] = $breadcrumbs ?? [];
    $arr['model'] = $model ?? [];

    return $arr;

}
