<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class InsertInitialPages extends Migration
{

    protected $languages = ['zh-TW' => true,'en' => true];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updatePageWrap();
        $this->insertPageWrap();
        $this->pageIndex();

        $this->pageAll();
        $this->insertTemplate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    protected function updatePageWrap()
    {
        $groupId = DBHelper::getSystemParameterGroupId('page_wrap');

        $wrapId = DB::table('system_parameter')
            ->join('data_plaintext as value', function ($join) {
                $join->on('value.model_id', '=', 'system_parameter.id')
                    ->where('value.model_type', \Minmax\Base\Models\SystemParameter::class)
                    ->where('value.column_name', 'value');
            })
            ->where('parent_id', $groupId)
            ->where('value.content', 'web-default')
            ->value('id');

        $options = DB::table('data_complex')
            ->where('model_type', \Minmax\Base\Models\SystemParameter::class)
            ->where('model_id', $wrapId)
            ->where('column_name', 'options')
            ->value('content');
        if (filled($options)) {
            $options = json_decode($options, true);

            foreach ($options as $index => $option) {
                if (array_get($option, 'key') == 'extends') {
                    $options[$index]['value'] = 'web.layouts.page-wrap.default';
                }
            }
        } else {
            $options = [['key' => 'extends', 'value' => 'web.layouts.page-wrap.default']];
        }

        DB::table('data_complex')
            ->where('model_type', \Minmax\Base\Models\SystemParameter::class)
            ->where('model_id', $wrapId)
            ->where('column_name', 'options')
            ->update([
                'content' => json_encode($options),
            ]);
    }

    protected function insertPageWrap()
    {
        $groupId = DBHelper::getSystemParameterGroupId('page_wrap');

        DB::table('system_parameter')->insert($insertData = [
            ['id' => $item1_3 = uuid(), 'parent_id' => $groupId],
        ]);

        DBHelper::insertDistributedData('system_parameter', [
            $item1_3 => ['value' => 'web-index', 'sort' => 3, 'active' => 1,
                'title' => ['en' => 'Home', 'zh-TW' => '首頁', 'zh-CN' => '首页', ],
                'options' => json_encode([
                    ['key' => 'extends', 'value' => 'web.layouts.page-wrap.index']
                ]),
            ],
        ]);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\SystemParameter', array_pluck($insertData, 'id') , $this->languages);
    }

    protected function pageIndex()
    {
        DB::table('data_article_editor')
            ->where('model_type', \Minmax\Article\Models\ArticlePage::class)
            ->where('model_id', 'web-home')
            ->where('column_name', 'editor')
            ->update([
                'content' => rescue(function() {
                    return view('web.templates.pages.index', ['local' => 'zh-TW'])->render();
                }, ''),
            ]);



        DB::table('data_selection')
            ->where('model_type', \Minmax\Article\Models\ArticlePage::class)
            ->where('model_id', 'web-home')
            ->where('column_name', 'page_wrap')
            ->update([
                'content' => 'web-index',
            ]);
    }


    protected function pageAll()
    {
        $timestamp = now();



        DB::table('article_page')->insert($insertData = [
            //['id' => $id1 = 'web-home', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id2 = 'web-about', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id3 = 'web-about-president', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4 = 'web-about-history', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5 = 'web-about-organization', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id6 = 'web-about-management', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id7 = 'web-about-vision', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id8 = 'web-about-awards', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id9 = 'web-about-relationship', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id10 = 'web-about-location', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id11 = 'web-news', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id12 = 'web-news-post', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id13 = 'web-products', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id14 = 'web-products-post', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id15 = 'web-financial', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id16 = 'web-financial-income-statement', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id41 = 'web-financial-balance-sheet', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id42 = 'web-financial-cash-flow', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id43 = 'web-financial-share-data', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id44 = 'web-financial-important-ratio', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id45 = 'web-financial-products-proportion', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id17 = 'web-financial-monthly', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id18 = 'web-financial-quarterly-statements', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id19 = 'web-financial-annual', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id20 = 'web-financial-law-conference', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id21 = 'web-shareholders-meeting', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id22 = 'web-shareholders-dividend', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id23 = 'web-corporate-overview', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id24 = 'web-corporate-operate', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id25 = 'web-corporate-directors', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id46 = 'web-corporate-directors-policy', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id47 = 'web-corporate-directors-resolutions', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id48 = 'web-corporate-directors-evaluation', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id26 = 'web-corporate-committee', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id49 = 'web-corporate-committee-communication', 'created_at' => $timestamp, 'updated_at' => $timestamp],


            ['id' => $id27 = 'web-corporate-internal-audit', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id28 = 'web-corporate-regulations', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id29 = 'web-corporate-intellectual-property', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id30 = 'web-corporate-integrity', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id50 = 'web-corporate-integrity-report', 'created_at' => $timestamp, 'updated_at' => $timestamp],


            ['id' => $id31 = 'web-corporate-employee', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id51 = 'web-corporate-employee-safe', 'created_at' => $timestamp, 'updated_at' => $timestamp],


            ['id' => $id32 = 'web-investor-service', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id33 = 'web-investor-service-agent', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id34 = 'web-stakeholder', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id35 = 'web-csr', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id36 = 'web-contact', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id37 = 'web-staff-login', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id38 = 'web-privacy', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id39 = 'web-sitemap', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id40 = 'web-search', 'created_at' => $timestamp, 'updated_at' => $timestamp],




        ]);

        $sort = 1;

        DBHelper::insertDistributedData('article_page', [

            $id2 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '公司簡介',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id3 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '經營者的話',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-president', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-president',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id4 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '大事紀',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-history', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-history',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id5 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '公司組織',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-organization', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-organization',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id6 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '經營團隊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-management', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-management',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id7 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '使命與願景',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-vision', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-vision',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id8 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '肯定與榮耀',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-awards', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-awards',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id9 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '關係企業',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-relationship', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-relationship',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id10 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '全球據點',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-location', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'about-location',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id11 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '新聞中心',
                'editor' => rescue(function() {
                    return view('web.templates.pages.news', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'news/{cls?}',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id12 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '新聞中心內頁',
                'editor' => rescue(function() {
                    return view('web.templates.pages.news-post', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'news/{cls}/{id}',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id13 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '產品與服務',
                'editor' => rescue(function() {
                    return view('web.templates.pages.products', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'products',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id14 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '產品與服務內頁',
                'editor' => rescue(function() {
                    return view('web.templates.pages.products-post', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'products/{cls}/{cls2}/{id}',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id15 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務資訊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id16 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務摘要-損益表',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-income-statement', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-income-statement',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id41 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務摘要-資產負債表
',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-balance-sheet', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-balance-sheet',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id42 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務摘要-現金流量表
',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-cash-flow', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-cash-flow',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id43 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務摘要-每股數據
',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-share-data', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-share-data',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id44 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務摘要-重要比率
',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-important-ratio', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-important-ratio',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id45 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '財務摘要-產品組合
',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-products-proportion', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-products-proportion',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],



            $id17 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '每月營收報告',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-monthly', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-monthly/{y?}',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id18 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '每季財務報告',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-quarterly-statements', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-quarterly-statements',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id19 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '公司年報',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-annual', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-annual',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id20 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '法說會資料',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-law-conference', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'financial-law-conference',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id21 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '股東會',
                'editor' => rescue(function() {
                    return view('web.templates.pages.shareholders-meeting', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'shareholders-meeting',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id22 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '股利資訊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.shareholders-dividend', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'shareholders-dividend',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id23 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '公司治理概述',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-overview', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-overview',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id24 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '公司治理運作情形',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-operate', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-operate',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id25 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '董事會-獨立董事選任資訊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-directors',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id46 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '董事會-董事會成員多元化政策落實情形',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors-policy', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-directors-policy',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id47 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '董事會-董事會決議事項',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors-resolutions', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-directors-resolutions',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id48 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '董事會-董事會績效評估',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors-evaluation', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-directors-evaluation',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],



            $id26 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '委員會-委員會成員及運作',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-committee', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-committee',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id49 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '委員會-獨立董事與內部溝通',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-committee-communication', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-committee-communication',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],



            $id27 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '內部稽核',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-internal-audit', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-internal-audit',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id28 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '公司重要規章',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-regulations', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-regulations',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id29 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '智慧財產權管理計畫',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-intellectual-property', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-intellectual-property',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id30 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '誠信經營-企業誠信經營報告',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-integrity', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-integrity',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id50 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '誠信經營-檢舉制度',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-integrity-report', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-integrity-report',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],



            $id31 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '員工與福利-員工福利與退休制度',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-employee', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-employee',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],
            $id51 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '員工與福利-工作環境與人身安全保護措施',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-employee-safe', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'corporate-employee-safe',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],



            $id32 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '投資人服務窗口',
                'editor' => rescue(function() {
                    return view('web.templates.pages.investor-service', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'investor-service',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id33 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '股務代理機構',
                'editor' => rescue(function() {
                    return view('web.templates.pages.investor-service-agent', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'investor-service-agent',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id34 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '利害關係人專區',
                'editor' => rescue(function() {
                    return view('web.templates.pages.stakeholder', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'stakeholder',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id35 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => 'CSR活動報導',
                'editor' => rescue(function() {
                    return view('web.templates.pages.csr', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'csr',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id36 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '客戶服務表單',
                'editor' => rescue(function() {
                    return view('web.templates.pages.contact', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'contact',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id37 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '員工專區',
                'editor' => rescue(function() {
                    return view('web.templates.pages.staff-login', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'staff-login',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id38 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '隱私權政策',
                'editor' => rescue(function() {
                    return view('web.templates.pages.privacy', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'privacy',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id39 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '網站地圖',
                'editor' => rescue(function() {
                    return view('web.templates.pages.sitemap', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'sitemap',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],

            $id40 => [
                'group' => 'single',
                'page_wrap' => 'web-default',
                'title' => '網站搜尋',
                'editor' => rescue(function() {
                    return view('web.templates.pages.search', ['local' => 'zh-TW'])->render();
                }, ''),
                'start_at' => null, 'end_at' => null,
                'path' => 'search',
                'menus' => null,
                'permission' => null, 'roles' => null,
                'operations' => json_encode(['indelible']),
                'sort' => ++$sort, 'active' => 1,
            ],







        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticlePage', array_pluck($insertData, 'id') , $this->languages);
    }

    protected function insertTemplate()
    {
        $timestamp = now();

        // Insert to template
        DB::table('template')->insert($insertData = [
            ['id' => $id1 = 'web-home', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id2 = 'web-about', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id3 = 'web-about-president', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4 = 'web-about-history', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5 = 'web-about-organization', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id6 = 'web-about-management', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id7 = 'web-about-vision', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id8 = 'web-about-awards', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id9 = 'web-about-relationship', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id10 = 'web-about-location', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id11 = 'web-news', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id12 = 'web-news-post', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id13 = 'web-products', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id14 = 'web-products-post', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id15 = 'web-financial', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id16 = 'web-financial-income-statement', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id41 = 'web-financial-balance-sheet', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id42 = 'web-financial-cash-flow', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id43 = 'web-financial-share-data', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id44 = 'web-financial-important-ratio', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id45 = 'web-financial-products-proportion', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id17 = 'web-financial-monthly', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id18 = 'web-financial-quarterly-statements', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id19 = 'web-financial-annual', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id20 = 'web-financial-law-conference', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id21 = 'web-shareholders-meeting', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id22 = 'web-shareholders-dividend', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id23 = 'web-corporate-overview', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id24 = 'web-corporate-operate', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id25 = 'web-corporate-directors', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id46 = 'web-corporate-directors-policy', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id47 = 'web-corporate-directors-resolutions', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id48 = 'web-corporate-directors-evaluation', 'created_at' => $timestamp, 'updated_at' => $timestamp],



            ['id' => $id26 = 'web-corporate-committee', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id49 = 'web-corporate-committee-communication', 'created_at' => $timestamp, 'updated_at' => $timestamp],



            ['id' => $id27 = 'web-corporate-internal-audit', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id28 = 'web-corporate-regulations', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id29 = 'web-corporate-intellectual-property', 'created_at' => $timestamp, 'updated_at' => $timestamp],


            ['id' => $id30 = 'web-corporate-integrity', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id50 = 'web-corporate-integrity-report', 'created_at' => $timestamp, 'updated_at' => $timestamp],


            ['id' => $id31 = 'web-corporate-employee', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id51 = 'web-corporate-employee-safe', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id32 = 'web-investor-service', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id33 = 'web-investor-service-agent', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id34 = 'web-stakeholder', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id35 = 'web-csr', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id36 = 'web-contact', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id37 = 'web-staff-login', 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id38 = 'web-privacy', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id39 = 'web-sitemap', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id40 = 'web-search', 'created_at' => $timestamp, 'updated_at' => $timestamp],


        ]);

        $sort = 0;

        DBHelper::insertDistributedData('template', [
            $id1 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => '前臺網站首頁',
                'title' => '首頁',
                'editor' => rescue(function() {
                    return view('web.templates.pages.index', ['local' => 'zh-TW'])->render();
                }, ''),
                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id2 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '公司簡介',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id3 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '經營者的話',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-president', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id4 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '大事紀',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-history', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id5 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '公司組織',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-organization', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id6 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '經營團隊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-management', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id7 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '使命與願景',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-vision', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],



            $id8 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '肯定與榮耀',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-awards', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id9 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '關係企業',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-relationship', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id10 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '全球據點',
                'editor' => rescue(function() {
                    return view('web.templates.pages.about-location', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id11 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '新聞中心',
                'editor' => rescue(function() {
                    return view('web.templates.pages.news', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id12 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '新聞中心內頁',
                'editor' => rescue(function() {
                    return view('web.templates.pages.news-post', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id13 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '產品與服務',
                'editor' => rescue(function() {
                    return view('web.templates.pages.products', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id14 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '產品與服務內頁',
                'editor' => rescue(function() {
                    return view('web.templates.pages.products-post', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id15 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務資訊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id16 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務摘要-損益表',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-income-statement', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id41 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務摘要-資產負債表',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-balance-sheet', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id42 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務摘要-現金流量表',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-cash-flow', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id43 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務摘要-每股數據',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-share-data', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id44 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務摘要-重要比率',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-important-ratio', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id45 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '財務摘要-產品組合',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-products-proportion', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],







            $id17 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '每月營收報告',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-monthly', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id18 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '每季財務報告',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-quarterly-statements', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id19 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '公司年報',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-annual', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id20 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '法說會資料',
                'editor' => rescue(function() {
                    return view('web.templates.pages.financial-law-conference', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id21 => [
                'guard' => 'admin', 'group' => 'page',
                'title' => '股東會',
                'editor' => rescue(function() {
                    return view('web.templates.pages.shareholders-meeting', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id22 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '股利資訊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.shareholders-dividend', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id23 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '公司治理概述',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-overview', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id24 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '公司治理運作情形',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-operate', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id25 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '董事會-獨立董事選任資訊',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id46 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '董事會-董事會成員多元化政策落實情形',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors-policy', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id47 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '董事會-董事會決議事項',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors-resolutions', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id48 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '董事會-董事會績效評估',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-directors-evaluation', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],





            $id26 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '委員會-委員會成員及運作',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-committee', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id49 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '委員會-獨立董事與內部溝通',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-committee-communication', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id27 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '內部稽核',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-internal-audit', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id28 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '公司重要規章',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-regulations', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id29 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '智慧財產權管理計畫',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-intellectual-property', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id30 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '誠信經營-企業誠信經營報告',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-integrity', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id50 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '誠信經營-檢舉制度',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-integrity-report', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],



            $id31 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '員工與福利-員工福利與退休制度',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-employee', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id51 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '員工與福利-工作環境與人身安全保護措施',
                'editor' => rescue(function() {
                    return view('web.templates.pages.corporate-employee-safe', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id32 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '投資人服務窗口',
                'editor' => rescue(function() {
                    return view('web.templates.pages.investor-service', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id33 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '股務代理機構',
                'editor' => rescue(function() {
                    return view('web.templates.pages.investor-service-agent', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id34 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '利害關係人專區',
                'editor' => rescue(function() {
                    return view('web.templates.pages.stakeholder', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id35 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => 'CSR活動報導',
                'editor' => rescue(function() {
                    return view('web.templates.pages.csr', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

            $id36 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '客戶服務表單',
                'editor' => rescue(function() {
                    return view('web.templates.pages.contact', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id37 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '員工專區',
                'editor' => rescue(function() {
                    return view('web.templates.pages.staff-login', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id38 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '隱私權政策',
                'editor' => rescue(function() {
                    return view('web.templates.pages.privacy', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id39 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '網站地圖',
                'editor' => rescue(function() {
                    return view('web.templates.pages.sitemap', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],


            $id40 => [
                'guard' => 'admin', 'group' => 'page',
                'description' => null,
                'title' => '網站搜尋',
                'editor' => rescue(function() {
                    return view('web.templates.pages.search', ['local' => 'zh-TW'])->render();
                }, ''),

                'pic' => null,
                'sort' => ++$sort, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\Template', array_pluck($insertData, 'id') , $this->languages);
    }
}
