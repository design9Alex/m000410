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


    }

    $arr['breadcrumbs'] = $breadcrumbs ?? [];
    $arr['model'] = $model ?? [];

    return $arr;

}
