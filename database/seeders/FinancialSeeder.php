<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;


class FinancialSeeder extends Seeder
{
    protected $languages = ['zh-TW' => true,'en' => true];
    protected $timestamp;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->init();

        $this->insertSiteParameters();

        $this->insertArticleColumn();
        $this->insertArticleCategory();
        $this->insertArticleBlock();
        $this->insertArticleDownload();
        $this->insertArticleIntro();
        $this->insertTemplate();

    }

    protected function init(){
        $this->timestamp = date('Y-m-d H:i:s');
    }

    protected function insertArticleColumn()
    {

        DB::table('article_column')->insert($insertData = [
            ['id' => 'income-statement', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],   //損益表
            ['id' => 'balance-sheet', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //資產負債表
            ['id' => 'cash-flow', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //現金流量表
            ['id' => 'share-data', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp], //每股數據
            ['id' => 'important-ratio', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],    //重要比率
            ['id' => 'products-proportion', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],    //產品組合

            ['id' => 'financial-monthly', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //每月營收報告
            ['id' => 'financial-quarterly-statements', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //每季財務報告
            ['id' => 'financial-annual', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //公司年報
            ['id' => 'financial-law-conference', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //公司年報
        ]);

        DBHelper::insertDistributedData('article_column', [
            'income-statement' => [
                'title' => '[財務摘要] 損益表',
                'column_set' => json_encode([
                    ['column' => 'financial_type', 'component' => 'minmax-select'],
                    ['column' => 'income', 'component' => 'minmax-input-text'], //營業收入
                    ['column' => 'grossprofit', 'component' => 'minmax-input-text'],    //營業毛利
                    ['column' => 'revenue', 'component' => 'minmax-input-text'],    //營業利益
                    ['column' => 'netincome', 'component' => 'minmax-input-text'],  //稅前淨利
                    ['column' => 'cpynetincome', 'component' => 'minmax-input-text'],   //歸屬於母公司淨利
                    ['column' => 'eps10', 'component' => 'minmax-input-text'],  //股票面額10元計稅後EPS(元)
                    ['column' => 'eps1', 'component' => 'minmax-input-text'],   //股票面額1元計稅後EPS(元)

                ]),
                'sort' => 1, 'active' => 1,
            ],
            'balance-sheet' => [
                'title' => '[財務摘要] 資產負債表',
                'column_set' => json_encode([
                    ['column' => 'financial_type', 'component' => 'minmax-select'],
                    ['column' => 'cash', 'component' => 'minmax-input-text'],
                    ['column' => 'receiveable', 'component' => 'minmax-input-text'],
                    ['column' => 'currentassets', 'component' => 'minmax-input-text'],
                    ['column' => 'equityinvestments', 'component' => 'minmax-input-text'],
                    ['column' => 'currentliabilities', 'component' => 'minmax-input-text'],
                    ['column' => 'noncurrentliabilities', 'component' => 'minmax-input-text'],
                    ['column' => 'totalequity', 'component' => 'minmax-input-text'],
                    ['column' => 'totalassets', 'component' => 'minmax-input-text'],
                    ['column' => 'netincome10', 'component' => 'minmax-input-text'],
                    ['column' => 'netincome1', 'component' => 'minmax-input-text'],
                    ['column' => 'currentratio', 'component' => 'minmax-input-text'],
                    ['column' => 'debtratio', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 2, 'active' => 1,
            ],
            'cash-flow' => [
                'title' => '[財務摘要] 現金流量表',
                'column_set' => json_encode([
                    ['column' => 'financial_type', 'component' => 'minmax-select'],
                    ['column' => 'operate', 'component' => 'minmax-input-text'],
                    ['column' => 'invest', 'component' => 'minmax-input-text'],
                    ['column' => 'fund', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 3, 'active' => 1,
            ],
            'share-data' => [
                'title' => '[財務摘要] 每股數據',
                'column_set' => json_encode([
                    ['column' => 'financial_type', 'component' => 'minmax-select'],
                    ['column' => 'share_cash', 'component' => 'minmax-input-text'],
                    ['column' => 'netrevenue', 'component' => 'minmax-input-text'],
                    ['column' => 'eps', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 4, 'active' => 1,
            ],
            'important-ratio' => [
                'title' => '[財務摘要] 重要比率',
                'column_set' => json_encode([
                    ['column' => 'financial_type', 'component' => 'minmax-select'],
                    ['column' => 'EBITDA', 'component' => 'minmax-input-text'],
                    ['column' => 'ROA', 'component' => 'minmax-input-text'],
                    ['column' => 'ROE', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 5, 'active' => 1,
            ],
            'products-proportion' => [
                'title' => '[財務摘要] 產品組合',
                'column_set' => json_encode([
                    ['column' => 'financial_type', 'component' => 'minmax-select'],
                    ['column' => 'iclf', 'component' => 'minmax-input-text'],
                    ['column' => 'resin', 'component' => 'minmax-input-text'],
                    ['column' => 'other', 'component' => 'minmax-input-text'],
                    ['column' => 'ledlf', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 6, 'active' => 1,
            ],
            'financial-monthly' => [
                'title' => '[財務摘要] 每月營收報告',
                'column_set' => json_encode([
                    ['column' => 'editor', 'component' => 'minmax-editor', 'height' => '600px'],

                ]),
                'sort' => 6, 'active' => 1,
            ],
            'financial-quarterly-statements' => [
                'title' => '[財務資訊] 每季財務報告',
                'column_set' => json_encode([
                    ['column' => 'quarterly_statements_file_1', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'quarterly_statements_file_2', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'quarterly_statements_file_3', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'quarterly_statements_file_4', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'quarterly_statements_file_5', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],

                ]),
                'sort' => 6, 'active' => 1,
            ],
            'financial-annual' => [
                'title' => '[財務資訊] 公司年報',
                'column_set' => json_encode([
                    ['column' => 'sub_title', 'component' => 'minmax-input-text'], //
                    ['column' => 'file', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                ]),
                'sort' => 7, 'active' => 1,
            ],
            'financial-law-conference' => [
                'title' => '[財務資訊] 法說會資料',
                'column_set' => json_encode([
                    ['column' => 'file', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'movie_file', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                ]),
                'sort' => 7, 'active' => 1,
            ],




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleColumn', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleCategory()
    {

        DB::table('article_category')->insert($insertData = [

            [
                'id' => 'web-block-investor', 'parent_id' => 'article-block',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-block-investor-financial-information', 'parent_id' => 'web-block-investor',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],

                [
                    'id' => 'web-block-investor-income-statement', 'parent_id' => 'web-block-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-investor-balance-sheet', 'parent_id' => 'web-block-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-investor-cash-flow', 'parent_id' => 'web-block-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-investor-share-data', 'parent_id' => 'web-block-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-investor-important-ratio', 'parent_id' => 'web-block-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-investor-products-proportion', 'parent_id' => 'web-block-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],


            [
                'id' => 'web-intro-investor', 'parent_id' => 'article-intro',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-intro-investor-financial-information', 'parent_id' => 'web-intro-investor',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
                [
                    'id' => 'web-intro-investor-financial-monthly', 'parent_id' => 'web-intro-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],



            [
                'id' => 'web-download-investor', 'parent_id' => 'article-download',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-download-investor-financial-information', 'parent_id' => 'web-download-investor',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
                [
                    'id' => 'web-download-investor-financial-quarterly-statements', 'parent_id' => 'web-download-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-download-investor-financial-annual', 'parent_id' => 'web-download-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-download-investor-financial-law-conference', 'parent_id' => 'web-download-investor-financial-information',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],



        ]);






        DBHelper::insertDistributedData('article_category', [

            'web-block-investor' => [
                'code' => 'web-block-investor',
                'title' => '投資人關係',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-block-investor-financial-information' => [
                'code' => 'web-block-investor-financial-information',
                'title' => '財務摘要',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],
                'web-block-investor-income-statement' => [
                    'code' => 'web-block-investor-income-statement',
                    'title' => '損益表',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'income-statement',
                    'category_page' => null,
                    'article_page' => 'web-investor-income-statement',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 1, 'active' => 1,
                ],
                'web-block-investor-balance-sheet' => [
                    'code' => 'web-block-investor-balance-sheet',
                    'title' => '資產負債表',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'balance-sheet',
                    'category_page' => null,
                    'article_page' => 'web-investor-balance-sheet',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 2, 'active' => 1,
                ],
                'web-block-investor-cash-flow' => [
                    'code' => 'web-block-investor-cash-flow',
                    'title' => '現金流量表',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'cash-flow',
                    'category_page' => null,
                    'article_page' => 'web-investor-cash-flow',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 3, 'active' => 1,
                ],
                'web-block-investor-share-data' => [
                    'code' => 'web-block-investor-share-data',
                    'title' => '每股數據',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'share-data',
                    'category_page' => null,
                    'article_page' => 'web-investor-share-data',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 4, 'active' => 1,
                ],
                'web-block-investor-important-ratio' => [
                    'code' => 'web-block-investor-important-ratio',
                    'title' => '重要比率',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'important-ratio',
                    'category_page' => null,
                    'article_page' => 'web-investor-important-ratio',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 5, 'active' => 1,
                ],
                'web-block-investor-products-proportion' => [
                    'code' => 'web-block-investor-products-proportion',
                    'title' => '產品組合',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'products-proportion',
                    'category_page' => null,
                    'article_page' => 'web-investor-products-proportion',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 6, 'active' => 1,
                ],


            'web-intro-investor' => [
                'code' => 'web-intro-investor',
                'title' => '投資人關係',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-intro-investor-financial-information' => [
                'code' => 'web-intro-investor-financial-information',
                'title' => '財務摘要',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],
                'web-intro-investor-financial-monthly' => [
                'code' => 'web-intro-investor-financial-monthly',
                'title' => '每月營收報告',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'financial-monthly',
                'category_page' => null,
                'article_page' => 'web-investor-financial-monthly',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],


            'web-download-investor' => [
                'code' => 'web-download-investor',
                'title' => '投資人關係',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-download-investor-financial-information' => [
                'code' => 'web-download-investor-financial-information',
                'title' => '財務摘要',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],
                'web-download-investor-financial-quarterly-statements' => [
                'code' => 'web-download-investor-financial-quarterly-statements',
                'title' => '每季財務報告',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'financial-quarterly-statements',
                'category_page' => null,
                'article_page' => 'web-investor-financial-quarterly-statements',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
                ],
                'web-download-investor-financial-annual' => [
                    'code' => 'web-download-investor-financial-annual',
                    'title' => '公司年報',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'financial-annual',
                    'category_page' => null,
                    'article_page' => 'web-investor-financial-annual',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 2, 'active' => 1,
                ],
                'web-download-investor-financial-law-conference' => [
                    'code' => 'web-download-investor-financial-law-conference',
                    'title' => '法說會資料',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => 'financial-law-conference',
                    'category_page' => null,
                    'article_page' => 'web-investor-financial-law-conference',
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 3, 'active' => 1,
                ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleCategory', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleBlock()
    {
        $i = 0;
        DB::table('article_block')->insert($insertData = [
            //損益表
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //資產負債表
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //現金流量表
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //每股數據
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //重要比率
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //產品組合
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

        ]);



        $sort = 0;
		$i = 0;

        DBHelper::insertDistributedData('article_block', [
            //損益表
            $id[++$i] => [
                'title' => '21Q2',
                'financial_type' => 'quarter', //year quarter
                'income' => '4901',
                'grossprofit' => '871',
                'revenue' => '563',
                'netincome' => '593',
                'cpynetincome' => '338',
                'eps10' => '4.9',
                'eps1' => '0.49',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q3',
                'financial_type' => 'quarter', //year quarter

                'income' => '5472',
                'grossprofit' => '1157',
                'revenue' => '747',
                'netincome' => '1143',
                'cpynetincome' => '703',
                'eps10' => '10.2',
                'eps1' => '1.02',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q4',
                'financial_type' => 'quarter', //year quarter

                'income' => '5703',
                'grossprofit' => '1433',
                'revenue' => '846',
                'netincome' => '907',
                'cpynetincome' => '448',
                'eps10' => '6.5',
                'eps1' => '0.65',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q1',
                'financial_type' => 'quarter', //year quarter

                'income' => '5655',
                'grossprofit' => '1313',
                'revenue' => '918',
                'netincome' => '1154',
                'cpynetincome' => '592',
                'eps10' => '8.6',
                'eps1' => '0.86',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q2',
                'financial_type' => 'quarter', //year quarter

                'income' => '5820',
                'grossprofit' => '1343',
                'revenue' => '939',
                'netincome' => '1189',
                'cpynetincome' => '539',
                'eps10' => '7.9',
                'eps1' => '0.79',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => 'QoQ',
                'financial_type' => 'quarter', //year quarter

                'income' => '2.90%',
                'grossprofit' => '2.30%',
                'revenue' => '2.30%',
                'netincome' => '3%",',
                'cpynetincome' => '-9%',
                'eps10' => '-8.10%',
                'eps1' => '-8.10%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => 'YoY',
                'financial_type' => 'quarter', //year quarter

                'income' => '18.80%',
                'grossprofit' => '54.20%',
                'revenue' => '66.80%',
                'netincome' => '100.50%",',
                'cpynetincome' => '59.50%',
                'eps10' => '61.20%',
                'eps1' => '61.20%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //資產負債表
            $id[++$i] => [
                'title' => '2018',
                'financial_type' => 'year', //year quarter

                'cash' => '3050',
                'receiveable' => '3333',
                'currentassets' => '8573',
                'equityinvestments' => '2779',
                'currentliabilities' => '5063',
                'noncurrentliabilities' => '2698',
                'totalequity' => '8156',
                'totalassets' => '15917',
                'netincome10' => '86.24',
                'netincome1' => '8.62',
                'currentratio' => '169%',
                'debtratio' => '49%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2019',
                'financial_type' => 'year', //year quarter

                'cash' => '3820',
                'receiveable' => '3489',
                'currentassets' => '10022',
                'equityinvestments' => '2913',
                'currentliabilities' => '5884',
                'noncurrentliabilities' => '4085',
                'totalequity' => '8047',
                'totalassets' => '18015',
                'netincome10' => '87.52',
                'netincome1' => '8.75',
                'currentratio' => '184%',
                'debtratio' => '46%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020',
                'financial_type' => 'year', //year quarter

                'cash' => '3196',
                'receiveable' => '3646',
                'currentassets' => '11118',
                'equityinvestments' => '3088',
                'currentliabilities' => '6282',
                'noncurrentliabilities' => '8122',
                'totalequity' => '8916',
                'totalassets' => '23320',
                'netincome10' => '101.71',
                'netincome1' => '10.17',
                'currentratio' => '177%',
                'debtratio' => '62%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2021',
                'financial_type' => 'year', //year quarter

                'cash' => '4799',
                'receiveable' => '4775',
                'currentassets' => '14719',
                'equityinvestments' => '3436',
                'currentliabilities' => '8323',
                'noncurrentliabilities' => '7265',
                'totalequity' => '14721',
                'totalassets' => '30309',
                'netincome10' => '158.03',
                'netincome1' => '15.80',
                'currentratio' => '177%',
                'debtratio' => '51%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2022',
                'financial_type' => 'year', //year quarter

                'cash' => '7106',
                'receiveable' => '3894',
                'currentassets' => '15826',
                'equityinvestments' => '3099',
                'currentliabilities' => '9300',
                'noncurrentliabilities' => '7434',
                'totalequity' => '16387',
                'totalassets' => '33121',
                'netincome10' => '167.99',
                'netincome1' => '16.80',
                'currentratio' => '170%',
                'debtratio' => '51%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //現金流量表
            $id[++$i] => [
                'title' => '2017',
                'financial_type' => 'year', //year quarter

                'operate' => '-39341',
                'invest' => '-64990',
                'fund' => '146239',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2018',
                'financial_type' => 'year', //year quarter

                'operate' => '-40156',
                'invest' => '71431',
                'fund' => '118970',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2019',
                'financial_type' => 'year', //year quarter

                'operate' => '248018',
                'invest' => '70584',
                'fund' => '-218095',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020',
                'financial_type' => 'year', //year quarter

                'operate' => '377624',
                'invest' => '34586',
                'fund' => '-25118',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2021',
                'financial_type' => 'year', //year quarter

                'operate' => '-98212',
                'invest' => '-92083',
                'fund' => '24281',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //每股數據
            $id[++$i] => [
                'title' => '2017',
                'financial_type' => 'year', //year quarter

                'share_cash' => '2',
                'netrevenue' => '68',
                'eps' => '8.01',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2018',
                'financial_type' => 'year', //year quarter

                'share_cash' => '4',
                'netrevenue' => '96',
                'eps' => '8.03',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2019',
                'financial_type' => 'year', //year quarter

                'share_cash' => '4.2',
                'netrevenue' => '101',
                'eps' => '8.32',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020',
                'financial_type' => 'year', //year quarter

                'share_cash' => '4',
                'netrevenue' => '106',
                'eps' => '7.34',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2021',
                'financial_type' => 'year', //year quarter

                'share_cash' => '5.2',
                'netrevenue' => '113',
                'eps' => '10.05',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //重要比率
            $id[++$i] => [
                'title' => '20Q4',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '13%',
                'ROA' => '1.24%',
                'ROE' => '3.32%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q1',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '13%',
                'ROA' => '1.41%',
                'ROE' => '3.63%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q2',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '16%',
                'ROA' => '1.83%',
                'ROE' => '4.62%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q3',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '24%',
                'ROA' => '3.6%',
                'ROE' => '8.85%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q4',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '19%',
                'ROA' => '2.4%',
                'ROE' => '5.44%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q1',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '24%',
                'ROA' => '2.97%',
                'ROE' => '6.23%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q2',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '24%',
                'ROA' => '2.90%',
                'ROE' => '6.08%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q3',
                'financial_type' => 'quarter', //year quarter

                'EBITDA' => '32%',
                'ROA' => '3.92%',
                'ROE' => '7.95%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //產品組合
            $id[++$i] => [
                'title' => '20Q4',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '47%',
                'resin' => '28%',
                'other' => '21%',
                'ledlf' => '4%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q1',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '47%',
                'resin' => '29%',
                'other' => '20%',
                'ledlf' => '4%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q2',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '49%',
                'resin' => '28%',
                'other' => '17%',
                'ledlf' => '6%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q3',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '51%',
                'resin' => '27%',
                'other' => '17%',
                'ledlf' => '5%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '21Q4',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '54%',
                'resin' => '25%',
                'other' => '17%',
                'ledlf' => '4%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q1',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '55%',
                'resin' => '25%',
                'other' => '17%',
                'ledlf' => '3%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q2',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '55%',
                'resin' => '25%',
                'other' => '18%',
                'ledlf' => '3%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '22Q3',
                'financial_type' => 'quarter', //year quarter

                'iclf' => '59%',
                'resin' => '22%',
                'other' => '16%',
                'ledlf' => '3%',

                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleBlock', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            //損益表
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-income-statement','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            //資產負債表
            ['category_id' => 'web-block-investor-balance-sheet','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-balance-sheet','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-balance-sheet','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-balance-sheet','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-balance-sheet','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            //現金流量表
            ['category_id' => 'web-block-investor-cash-flow','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-cash-flow','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-cash-flow','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-cash-flow','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-cash-flow','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            //每股數據
            ['category_id' => 'web-block-investor-share-data','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-share-data','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-share-data','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-share-data','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-share-data','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            //重要比率
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-important-ratio','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            //產品組合
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-investor-products-proportion','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],



        ]);


    }


    protected function insertArticleDownload()
    {
        $i = 0;
        DB::table('article_download')->insert($insertData = [
            //每季財務報告
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //公司年報
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //法說會資料
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
        ]);


        $sort = 0;
        $i = 0;

        DBHelper::insertDistributedData('article_download', [
            $id[++$i] => [
                'title' => '2019',
                'quarterly_statements_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_5' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020',
                'quarterly_statements_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'quarterly_statements_file_5' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 2, 'active' => 1,
            ],
            $id[++$i] => [
                    'title' => '2021',
                    'quarterly_statements_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                    'quarterly_statements_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                    'quarterly_statements_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                    'quarterly_statements_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                    'quarterly_statements_file_5' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                    'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                    'sort' => 3, 'active' => 1,
                ],


            $id[++$i] => [
                'title' => '2021',
                'sub_title' => '長華電材2021年報',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020',
                'sub_title' => '長華電材2020年報',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2019',
                'sub_title' => '長華電材2019年報',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2018',
                'sub_title' => '長華電材2018年報',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2017',
                'sub_title' => '長華電材2017年報',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2016',
                'sub_title' => '長華電材2016年報',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],


            $id[++$i] => [
                'title' => '本公司受邀參加臺灣證券交易所舉辦之「2022年半導體暨新上市主題式業績發表會」',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'movie_file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司受邀參加凱基證券舉辦之線上法人說明會',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'movie_file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司受邀參加證交所舉辦之線上主題式業績發表會',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'movie_file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司受邀參加亞洲投資創富論壇',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'movie_file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => null, 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => 1, 'active' => 1,
            ],


        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleDownload', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            [
                'category_id' => 'web-download-investor-financial-quarterly-statements',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-quarterly-statements',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-quarterly-statements',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],



            [
                'category_id' => 'web-download-investor-financial-annual',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-annual',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-annual',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-annual',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-annual',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-annual',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],



            [
                'category_id' => 'web-download-investor-financial-law-conference',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-law-conference',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-law-conference',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-investor-financial-law-conference',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],



        ]);

    }


    protected function insertArticleIntro()
    {
        $i = 0;
        DB::table('article_intro')->insert($insertData = [
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
        ]);

        $editor = <<<HTML
<table>
							<thead>
								<tr>
									<th class="text-center">日期</th>
									<th class="text-center">合併營收 (單位：千元)</th>
									<th class="text-center">MoM</th>
									<th class="text-center">YoY</th>
								</tr>
							</thead>
							<tbody>
																	<tr>
										<td class="FontSub fontWeight500">2021/01</td>
										<td class="FontSub">1,604,399</td>
										<td class="FontSub">5.9 %</td>
										<td class="FontSub">36.6 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/02</td>
										<td class="FontSub">1,332,975</td>
										<td class="FontSub">-16.9 %</td>
										<td class="FontSub">10.5 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/03</td>
										<td class="FontSub">1,657,240</td>
										<td class="FontSub">24.3 %</td>
										<td class="FontSub">17.7 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/04</td>
										<td class="FontSub">1,594,942</td>
										<td class="FontSub">-3.8 %</td>
										<td class="FontSub">14.9 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/05</td>
										<td class="FontSub">1,564,982</td>
										<td class="FontSub">-1.9 %</td>
										<td class="FontSub">13.1 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/06</td>
										<td class="FontSub">1,740,792</td>
										<td class="FontSub">11.2 %</td>
										<td class="FontSub">29.5 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/07</td>
										<td class="FontSub">1,835,015</td>
										<td class="FontSub">5.4 %</td>
										<td class="FontSub">35.2 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/08</td>
										<td class="FontSub">1,821,516</td>
										<td class="FontSub">-0.7 %</td>
										<td class="FontSub">41.3 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/09</td>
										<td class="FontSub">1,815,855</td>
										<td class="FontSub">-0.3 %</td>
										<td class="FontSub">26.5 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/10</td>
										<td class="FontSub">1,836,860</td>
										<td class="FontSub">1.2 %</td>
										<td class="FontSub">33.7 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/11</td>
										<td class="FontSub">1,890,429</td>
										<td class="FontSub">2.9 %</td>
										<td class="FontSub">22 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/12</td>
										<td class="FontSub">1,975,504</td>
										<td class="FontSub">4.5 %</td>
										<td class="FontSub">30.4 %</td>
									</tr>
															</tbody>
						</table>
					</div>

HTML;

        $sort = 0;
        $i = 0;

        DBHelper::insertDistributedData('article_intro', [
            $id[++$i] => [
                'title' => '2019',
                'editor' => $editor,
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020',
                'editor' => $editor,
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2021',
                'editor' => $editor,
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleIntro', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            [
                'category_id' => 'web-intro-investor-financial-monthly',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-investor-financial-monthly',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-investor-financial-monthly',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],



        ]);

    }


    protected function insertTemplate()
    {
        $editor = <<<HTML
<table>
							<thead>
								<tr>
									<th class="text-center">日期</th>
									<th class="text-center">合併營收 (單位：千元)</th>
									<th class="text-center">MoM</th>
									<th class="text-center">YoY</th>
								</tr>
							</thead>
							<tbody>
																	<tr>
										<td class="FontSub fontWeight500">2021/01</td>
										<td class="FontSub">1,604,399</td>
										<td class="FontSub">5.9 %</td>
										<td class="FontSub">36.6 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/02</td>
										<td class="FontSub">1,332,975</td>
										<td class="FontSub">-16.9 %</td>
										<td class="FontSub">10.5 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/03</td>
										<td class="FontSub">1,657,240</td>
										<td class="FontSub">24.3 %</td>
										<td class="FontSub">17.7 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/04</td>
										<td class="FontSub">1,594,942</td>
										<td class="FontSub">-3.8 %</td>
										<td class="FontSub">14.9 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/05</td>
										<td class="FontSub">1,564,982</td>
										<td class="FontSub">-1.9 %</td>
										<td class="FontSub">13.1 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/06</td>
										<td class="FontSub">1,740,792</td>
										<td class="FontSub">11.2 %</td>
										<td class="FontSub">29.5 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/07</td>
										<td class="FontSub">1,835,015</td>
										<td class="FontSub">5.4 %</td>
										<td class="FontSub">35.2 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/08</td>
										<td class="FontSub">1,821,516</td>
										<td class="FontSub">-0.7 %</td>
										<td class="FontSub">41.3 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/09</td>
										<td class="FontSub">1,815,855</td>
										<td class="FontSub">-0.3 %</td>
										<td class="FontSub">26.5 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/10</td>
										<td class="FontSub">1,836,860</td>
										<td class="FontSub">1.2 %</td>
										<td class="FontSub">33.7 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/11</td>
										<td class="FontSub">1,890,429</td>
										<td class="FontSub">2.9 %</td>
										<td class="FontSub">22 %</td>
									</tr>
																	<tr>
										<td class="FontSub fontWeight500">2021/12</td>
										<td class="FontSub">1,975,504</td>
										<td class="FontSub">4.5 %</td>
										<td class="FontSub">30.4 %</td>
									</tr>
															</tbody>
						</table>
					</div>

HTML;

        // Insert to template
        DB::table('template')->insert($insertData = [
            //intro
            ['id' => $id1 = 'editor-financial-monthly', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

        ]);

        DBHelper::insertDistributedData('template', [
            //intro
            $id1 => [
                'guard' => 'admin', 'group' => 'editor',
                'title' => '每月營收報告',
                'description' => null,
                'editor' => $editor,
                'pic' => null,
                'sort' => 1, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],







        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\Template', array_pluck($insertData, 'id'),$this->languages);
    }



    protected function insertSiteParameters()
    {
        DB::table('site_parameter')->insert($insertData = [
            //產業別
            ['id' => $group1 = uuid(), 'parent_id' => null,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $item1_1 = uuid(), 'parent_id' => $group1,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $item1_2 = uuid(), 'parent_id' => $group1,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],


        ]);

        DBHelper::insertDistributedData('site_parameter', [
            $group1 => ['value' => 'financial_type', 'sort' => 1, 'active' => 1,
                'title' => '度別', 'operations' => json_encode(['unmodifiable', 'indelible']),
            ],
            $item1_1 => ['value' => 'year', 'sort' => 1, 'active' => 1,
                'title' => '年度', 'operations' => null,
            ],
            $item1_2 => ['value' => 'quarter', 'sort' => 2, 'active' => 1,
                'title' => '季度', 'operations' => null,
            ],

        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\SiteParameter', array_pluck($insertData, 'id'), $this->languages );
    }


}
