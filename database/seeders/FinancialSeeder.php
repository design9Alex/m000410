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
        $this->insertArticleColumn();
        $this->insertArticleCategory();
        $this->insertArticleBlock();
        //$this->insertSiteParameters();

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
        ]);

        DBHelper::insertDistributedData('article_column', [
            'income-statement' => [
                'title' => '[財務摘要] 損益表',
                'column_set' => json_encode([
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
                    ['column' => 'department', 'component' => 'minmax-input-text'],
                    ['column' => 'responsibilities', 'component' => 'minmax-textarea'],

                ]),
                'sort' => 2, 'active' => 1,
            ],
            'cash-flow' => [
                'title' => '[財務摘要] 現金流量表',
                'column_set' => json_encode([
                    ['column' => 'year', 'component' => 'minmax-input-text'],
                    ['column' => 'company', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 3, 'active' => 1,
            ],
            'share-data' => [
                'title' => '[財務摘要] 每股數據',
                'column_set' => json_encode([
                    ['column' => 'address', 'component' => 'minmax-input-text'],
                    ['column' => 'phone', 'component' => 'minmax-input-text'],
                    ['column' => 'fax', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 4, 'active' => 1,
            ],
            'important-ratio' => [
                'title' => '[財務摘要] 重要比率',
                'column_set' => json_encode([
                    ['column' => 'address', 'component' => 'minmax-input-text'],
                    ['column' => 'phone', 'component' => 'minmax-input-text'],
                    ['column' => 'fax', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 5, 'active' => 1,
            ],
            'products-proportion' => [
                'title' => '[財務摘要] 產品組合',
                'column_set' => json_encode([
                    ['column' => 'address', 'component' => 'minmax-input-text'],
                    ['column' => 'phone', 'component' => 'minmax-input-text'],
                    ['column' => 'fax', 'component' => 'minmax-input-text'],

                ]),
                'sort' => 6, 'active' => 1,
            ],




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleColumn', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleCategory()
    {

        DB::table('article_category')->insert($insertData = [

            [
                'id' => 'web-block-abouts', 'parent_id' => 'article-block',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-block-abouts-history', 'parent_id' => 'web-block-abouts',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-block-abouts-management', 'parent_id' => 'web-block-abouts',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-block-abouts-awards', 'parent_id' => 'web-block-abouts',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-block-abouts-location', 'parent_id' => 'web-block-abouts',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
                [
                    'id' => 'web-block-abouts-location-location', 'parent_id' => 'web-block-abouts-location',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-abouts-location-other', 'parent_id' => 'web-block-abouts-location',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-block-abouts-location-abroad', 'parent_id' => 'web-block-abouts-location',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],


        ]);






        DBHelper::insertDistributedData('article_category', [

            'web-block-abouts' => [
                'code' => 'web-block-abouts',
                'title' => '關於我們',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-block-abouts-history' => [
                'code' => 'web-block-abouts-history',
                'title' => '大事紀',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'about-history',
                'category_page' => null,
                'article_page' => 'web-about-history',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],
            'web-block-abouts-management' => [
                'code' => 'web-block-abouts-management',
                'title' => '經營團隊',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'about-management',
                'category_page' => null,
                'article_page' => 'web-about-management',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 2, 'active' => 1,
            ],
            'web-block-abouts-awards' => [
                'code' => 'web-block-abouts-awards',
                'title' => '肯定與榮耀',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'about-awards',
                'category_page' => null,
                'article_page' => 'web-about-awards',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 3, 'active' => 1,
            ],

            'web-block-abouts-location' => [
                'code' => 'web-block-abouts-location',
                'title' => '全球據點',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'about-location',
                'category_page' => null,
                'article_page' => 'web-about-location',
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 4, 'active' => 1,
            ],
                'web-block-abouts-location-location' => [
                    'code' => 'web-block-abouts-location-location',
                    'title' => '營業據點',
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
                'web-block-abouts-location-other' => [
                    'code' => 'web-block-abouts-location-other',
                    'title' => '其他營業據點',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 2, 'active' => 1,
                ],
                'web-block-abouts-location-abroad' => [
                    'code' => 'web-block-abouts-location-abroad',
                    'title' => '海外營業據點',
                    'editor' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
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
            //大事紀
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

			['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

			['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

			['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

			['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //經營團隊
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //肯定與榮耀
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //營業據點
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //其他營業據點
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //海外營業據點
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
            //2022
            $id[++$i] => [
                'title' => '黃嘉能董事長獲頒 2022《哈佛商業評論》台灣企業領袖 100 強',
                'pic' => null,
                'start_at' => '2022-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '與日本住友合資新廠動土 擴大封膠樹酯產能',
                'pic' => null,
                'start_at' => '2022-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '董事會決議處分子公司長華科技(股)公司部分持股，截至4月底止，本公司對長華科技(股)公司累積持有股數179,967,970股，持股比例48%。',
                'pic' => null,
                'start_at' => '2022-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '首度冠名主辦高球公開賽',
                'pic' => null,
                'start_at' => '2022-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2021
            $id[++$i] => [
                'title' => '董事會決議取得新應材10.03%股權，聚焦半導體材料。',
                'pic' => null,
                'start_at' => '2021-06-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2020
            $id[++$i] => [
                'title' => '董事會決議取得Silver Connection Co., Ltd. 30%股權，布局電接觸材料。',
                'pic' => null,
                'start_at' => '2020-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司將股票面額由每股新臺幣10元變更為新臺幣1元，並於2020年8月17日恢復交易，上市股數將由原63,879,937股變更為638,799,370股，資本額新臺幣6.39億元維持不變。',
                'pic' => null,
                'start_at' => '2020-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2019
            $id[++$i] => [
                'title' => '本公司為強化在自動化生產設備市場之布局，擴大客戶服務範疇，將攜手天正國際精密機械(股)公司共同進軍被動元件、LED及半導體檢測設備市場，藉此擴大產品組合與客戶基礎，以求取最大的雙贏效益；雙方分階段展開策略合作，期能結合雙方產業資源、業務與技術優勢，進一步擴大產品組合與客戶基礎，以達到擴大營運規模、提升獲利之目的。本公司將視本合作案之後續業務發展需求，於必要時增加對天正國際精密機械(股)公司之持股。惟實際之投資方式及條件，應依照相關法定程序辦理。',
                'pic' => null,
                'start_at' => '2019-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司長華科技(股)公司將股票面額由每股新臺幣10元變更為新臺幣1元，並於2019年9月9日恢復交易，上櫃股數將由原36,413,105股變更為364,131,050股，資本額新臺幣3.64億元維持不變。',
                'pic' => null,
                'start_at' => '2019-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司及子公司長華科技(股)公司經股東常會決議通過修訂公司章程，盈餘分配改為每半年配息一次。',
                'pic' => null,
                'start_at' => '2019-06-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過總額度等值新臺幣72億元整之五年期聯合授信案，用以償還金融負債暨充實中期營運週轉金。',
                'pic' => null,
                'start_at' => '2019-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //2018
            $id[++$i] => [
                'title' => '「蘇州住礦電子有限公司」更名為「蘇州興勝科半導體材料有限公司」、「成都住礦電子有限公司」更名為「成都興勝半導體材料有限公司」、「成都住礦精密製造有限公司」更名為「成都興勝新材料有限公司」、「台灣住礦科技(股)公司」更名為「台灣興勝半導體材料(股)公司」。',
                'pic' => null,
                'start_at' => '2018-07-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //2017
            $id[++$i] => [
                'title' => '本公司認購子公司長華科技(股)公司現金增資股票2,556千股，投資金額新台幣10.22億元。認購股權後，本公司對子公司長華科技(股)持股比例為45%。',
                'pic' => null,
                'start_at' => '2017-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司為配合集團營運策略之考量，將本公司所持有之WSP Electromaterials Limited 100%股權轉讓予子公司SH Asia Pacific Pte. Ltd.。',
                'pic' => null,
                'start_at' => '2017-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司為配合集團營運策略之考量，將本公司所持有之SH Asia Pacific Pte. Ltd. 40%股權轉讓予子公司長華科技(股)公司。',
                'pic' => null,
                'start_at' => '2017-06-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司以新台幣9,000萬元投資成立長華能源科技(股)公司，持股比例100%，該公司主要係發展太陽能發電事業。',
                'pic' => null,
                'start_at' => '2017-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '為因應導線架產業發展趨勢及集團未來策略發展，本公司及子公司長華科技(股)公司以日幣150億元(折合新台幣41億元)向SH Materials Co., Ltd.購買其所持有SH Asia Pacific Pte. Ltd.全部股權，並間接取得其子公司（即Malaysian SH Electronics Sdn. Bhd.、蘇州住礦電子有限公司、成都住礦電子有限公司、成都住礦精密製造有限公司及台灣住礦科技(股)公司）股權。',
                'pic' => null,
                'start_at' => '2017-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司及子公司長華科技(股)公司對SH Asia Pacific Pte. Ltd.持股比例分別為40%及60%。',
                'pic' => null,
                'start_at' => '2017-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之子公司台灣住礦科技(股)公司與子公司長華科技(股)公司皆屬IC基板導線架之生產工廠，為整合二家子公司在台灣之生產基地以增加子公司市場競爭力。本公司將所持有之台灣住礦科技(股)公司30%股權轉讓予子公司長華科技(股)公司。',
                'pic' => null,
                'start_at' => '2017-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司認購子公司長華科技(股)公司現金增資股票1,987千股，投資金額新台幣4.9億元。認購股權後，本公司對子公司長華科技(股)公司持股比例為46%。',
                'pic' => null,
                'start_at' => '2017-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2015
            $id[++$i] => [
                'title' => '本公司之重要子公司How Weih International Ltd.與臺灣銀行等7家銀行簽訂美金23,700千元整聯合授信合約。',
                'pic' => null,
                'start_at' => '2015-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司大陸惠州偉特電機有限公司核准更名為惠州偉特電子有限公司。',
                'pic' => null,
                'start_at' => '2015-06-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司處分易華電子(股)公司計16,500,000股，持股比例從65.38%下降至47%，本公司對易華電子(股)公司已於民國104年6月30日喪失控制能力，是以將易華電子(股)公司自合併個體排除，列入採用權益法之投資。',
                'pic' => null,
                'start_at' => '2015-06-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之子公司CWE Holding Co., Ltd.董事會決議通過設立長華控股(開曼)(股)公司暨調整轉投資架構。',
                'pic' => null,
                'start_at' => '2015-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過變更對吳江斌茂光電有限公司之投資方式： 變更前：本公司 → CWE Holding Co., Ltd. → CWER Co., Ltd. → 吳江斌茂光電有限公司 變更後：本公司 → CWE Holding Co., Ltd. → 長華控股(開曼)(股)公司 → CWER Co., Ltd. → 吳江斌茂光電有限公司',
                'pic' => null,
                'start_at' => '2015-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司How Weih International Ltd.董事會決議通過對大陸惠州偉特電機有限公司辦理現金增資美金670萬元。',
                'pic' => null,
                'start_at' => '2015-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司How Weih International Ltd.董事會決議通過對大陸濠瑋電子科技(惠州)有限公司辦理現金增資美金300萬元。',
                'pic' => null,
                'start_at' => '2015-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之子公司CWER CO., LTD.董事會決議通過對大陸吳江斌茂光電有限公司辦理現金增資美金300萬元。',
                'pic' => null,
                'start_at' => '2015-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過認購子公司易華電子(股)公司現金增資10,142,867股，每股認購金額新台幣20元。',
                'pic' => null,
                'start_at' => '2015-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //2014
            $id[++$i] => [
                'title' => '本公司董事會決議通過認購長華科技(股)公司現金增資，預計認購5,500,000股為上限，每股認購價格新台幣50元。',
                'pic' => null,
                'start_at' => '2014-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司How Weih International Ltd.董事會決議通過辦理現金增資美金670萬元，並經母公司濠瑋控股(開曼)(股)公司(持股比例100%)同日董事會決議全數認購。',
                'pic' => null,
                'start_at' => '2014-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司濠瑋控股(開曼)(股)公司董事會決議通過辦理現金增資新台幣21,000萬元。',
                'pic' => null,
                'start_at' => '2014-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過處分重要子公司濠瑋控股(開曼)(股)公司部分股權7,000,000股。',
                'pic' => null,
                'start_at' => '2014-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過認購子公司易華電子(股)公司現金增資，預計認購33,540,000股為上限，每股面額新台幣10元。',
                'pic' => null,
                'start_at' => '2014-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議處分大陸惠州偉特電機有限公司100%股權予本公司之重要子公司How Weih International Ltd.。',
                'pic' => null,
                'start_at' => '2014-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過處分重要子公司濠瑋控股(開曼)(股)公司部分股權5,710,000股。',
                'pic' => null,
                'start_at' => '2014-06-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司台灣住礦電子(股)公司更名為易華電子(股)公司。',
                'pic' => null,
                'start_at' => '2014-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過對大陸惠州偉特電機有限公司辦理現金增資美金800萬元。',
                'pic' => null,
                'start_at' => '2014-03-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司How Weih International Ltd.董事會決議通過投資設立惠州濠瑋精密科技有限公司。',
                'pic' => null,
                'start_at' => '2014-02-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2013
            $id[++$i] => [
                'title' => '董事會決議通過購買台灣住礦電子(股)公司70%股權。',
                'pic' => null,
                'start_at' => '2013-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之重要子公司How Weih International Ltd.董事會決議通過辦理現金增資美金930萬元。',
                'pic' => null,
                'start_at' => '2013-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過認購濠瑋控股(開曼)(股)公司現金增資新台幣2.142億元。',
                'pic' => null,
                'start_at' => '2013-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '董事會決議向合益實業(亞洲)有限公司購買大陸惠州偉特電機有限公司100%股權。',
                'pic' => null,
                'start_at' => '2013-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過對大陸惠州偉特電機有限公司辦理現金增資美金200萬元。',
                'pic' => null,
                'start_at' => '2013-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司華德光電材料科技(股)公司及云輝科技(股)公司經雙方董事會決議通過收購案，華德光電材料科技(股)公司採股份轉換方式收購云輝科技(股)公司100%股權，並同時取得云輝科技(股)公司旗下轉投資公司Technew Holding Co., Ltd.、Prosper King Limited及廈門云輝興業材料科技有限公司百分之百股權。',
                'pic' => null,
                'start_at' => '2013-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '董事會決議通過與持股達100%之子公司長伯科技(股)公司簡易合併，合併後本公司為存續公司，長伯科技(股)公司為消滅公司。',
                'pic' => null,
                'start_at' => '2013-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '台灣住礦電子(股)公司因其母公司進行集團業務重整，將台灣住礦電子(股)公司分割為台灣住礦電子(股)公司與台灣住礦科技(股)公司，本公司分別持股30%。',
                'pic' => null,
                'start_at' => '2013-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司董事會決議通過修正認購長華科技(股)公司現金增資，預計認購5,000,000股為上限，每股認購價格新台幣30元。',
                'pic' => null,
                'start_at' => '2013-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司Beam Mode Optronics LLC董事會決議通過減資美金2,780,077.08元，減資比率11.14%。',
                'pic' => null,
                'start_at' => '2013-01-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '取得濠瑋控股(開曼)(股)公司股權，持股比率90%。',
                'pic' => null,
                'start_at' => '2013-02-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司How Weih International Ltd.與臺灣銀行等12家銀行簽訂美金3,600萬元整聯合授信合約。',
                'pic' => null,
                'start_at' => '2013-01-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2012
            $id[++$i] => [
                'title' => '本公司董事會決議通過How Weih International Ltd.之股權架構重整，並設立濠瑋控股(開曼)(股)公司。',
                'pic' => null,
                'start_at' => '2012-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司華德光電材料科技(股)公司董事會通過經由WellsTech Optical Holding Co.,Ltd.認購Top Swiss Limited現金增資股份，並同時取得其大陸轉投資之華田光電(成都)有限公司50.82%股權。',
                'pic' => null,
                'start_at' => '2012-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司云輝在大陸地區投資設立廈門云輝興業材料科技有限公司。',
                'pic' => null,
                'start_at' => '2012-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司間接透過子公司How Weih International Ltd.對濠瑋精密科技(深圳)有限公司辦理現金增資美金800萬元。',
                'pic' => null,
                'start_at' => '2012-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司之子公司華德光電材料科技(股)公司經由Wellstech Optical Holding Co.,Ltd. 對Steadfast Enterprise Co., Ltd.及Golden Jo Corp.分別辦理現金增資美金440萬元及美金50萬元。',
                'pic' => null,
                'start_at' => '2012-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '參與望隼科技(股)公司之現金增資，持股比率為42.95%。',
                'pic' => null,
                'start_at' => '2012-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '與玉山商業銀行等9家銀行簽訂新台幣275,000萬元整聯合授信合約。',
                'pic' => null,
                'start_at' => '2012-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司華德光電材料科技(股)公司間接取得豐泰光電(深圳)有限公司及群億光電(深圳)有限公司100%股權。',
                'pic' => null,
                'start_at' => '2012-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2011
            $id[++$i] => [
                'title' => '本公司及子公司長伯科技(股)公司綜合持股達51%之之轉投資公司云輝科技(股)公司經董事會決議設立Technew Holding Co., Ltd.及 Prosper King Limited以完善投資架構。',
                'pic' => null,
                'start_at' => '2011-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '透過子公司How Weih International Ltd.以自有資金取得Hopeful (HK) Enterprise Holdings Limited100%股權，並間接取得濠鈺科技(深圳)有限公司100%股權。',
                'pic' => null,
                'start_at' => '2011-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '成立第一屆審計委員會及薪資報酬委員會。',
                'pic' => null,
                'start_at' => '2011-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2010
            $id[++$i] => [
                'title' => '轉投資云輝科技(股)公司，該公司主要係從事精密化學材料製造、電子零組件製造、工業助劑批發、其他化學製品批發、電子材料批發與零售及國際貿易之公司。',
                'pic' => null,
                'start_at' => '2010-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司濠瑋精密五金(深圳)有限公司更名為濠瑋精密科技(深圳)有限公司。',
                'pic' => null,
                'start_at' => '2010-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司轉讓濠瑋國際有限公司10%之增資後股權予該公司之子公司濠瑋精密科技(深圳)有限公司管理階層，本公司對濠瑋國際有限公司及濠瑋精密科技(深圳)有限公司累計持股比率由100%變更為90%。',
                'pic' => null,
                'start_at' => '2010-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '核准發行國內第三次無擔保可轉換公司債，發行總額新台幣18億元。',
                'pic' => null,
                'start_at' => '2010-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '參與長華科技(股)公司現金增資，持股比率由100%變更為51%。',
                'pic' => null,
                'start_at' => '2010-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2009
            $id[++$i] => [
                'title' => '轉投資長華科技(股)公司，該公司主要係從事工業用塑膠製品與電子零組件之製造及電子零組件與機械器具之零售與批發。',
                'pic' => null,
                'start_at' => '2009-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2008
            $id[++$i] => [
                'title' => '因轉投資公司「華德光電材料科技(股)公司」為特定人韓國MNTech辦理現金增資，本公司持股比率由63.42%調降為48.67%。',
                'pic' => null,
                'start_at' => '2008-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '透過由本公司百分之百轉投資Beam Mode Optronics LLC參與How Weih International Ltd.現金增資取得19%股權，並同時取得其大陸轉投資濠瑋精密五金(深圳)有限公司，該公司主要係從事新型電子製品、精密塑膠五金製品之研發、製造及銷售之公司。',
                'pic' => null,
                'start_at' => '2008-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '完成新台幣20億元五年期聯合授信案之簽約。',
                'pic' => null,
                'start_at' => '2008-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '參與成都住礦電子有限公司增資計畫，持股比率增為30%。',
                'pic' => null,
                'start_at' => '2008-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '參與轉投資公司華德光電材料科技(股)公司之減資及現金增資計畫，持股比率增為63.42%。',
                'pic' => null,
                'start_at' => '2008-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '子公司山田遠東尖端科技服務(股)公司更名為長伯科技(股)公司。',
                'pic' => null,
                'start_at' => '2008-07-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '透過WSP Electromaterials Ltd.轉投資設立成都住礦精密製造有限公司。',
                'pic' => null,
                'start_at' => '2008-02-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2007
            $id[++$i] => [
                'title' => '投資華德光電材料科技(股)公司，主要係生產製造光學膜。',
                'pic' => null,
                'start_at' => '2007-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '12月31日正式上市掛牌。',
                'pic' => null,
                'start_at' => '2007-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '投資華德光電材料科技(股)公司，主要係生產製造光學膜。',
                'pic' => null,
                'start_at' => '2007-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '12月31日正式上市掛牌。',
                'pic' => null,
                'start_at' => '2007-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2006
            $id[++$i] => [
                'title' => '發行國內第二次無擔保可轉換公司債，發行總額新台幣15億元。',
                'pic' => null,
                'start_at' => '2006-12-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '增加對上海長華新技電材有限公司投資，持股比率增為69.375%。',
                'pic' => null,
                'start_at' => '2006-09-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '與住友金屬礦山集團共同投資台灣住礦電子(股)公司，用於TCP/COF基板擴廠，本公司按持股比率30%投資。',
                'pic' => null,
                'start_at' => '2006-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2005
            $id[++$i] => [
                'title' => '本公司取得轉投資山田遠東尖端科技服務(股)公司股權40%，持股比率由60%上升至100%。',
                'pic' => null,
                'start_at' => '2005-07-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '通過兩岸政府審查，於上海設立「上海長華新技電材有限公司」，為台商在中國第一家取得內外貿易權之公司。',
                'pic' => null,
                'start_at' => '2005-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2004
            $id[++$i] => [
                'title' => '新設立CWE holding Co., Ltd.及CWER Co., Ltd.，投資架構為透過CWE holding Co., Ltd.間接投資CWER Co., Ltd.，持股比率100%。',
                'pic' => null,
                'start_at' => '2004-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '本公司向Apic Yamada Corporation購入山田遠東尖端科技服務(股)公司800,000股，持股比率由20%增加為60%。',
                'pic' => null,
                'start_at' => '2004-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '發行國內可轉換公司債新台幣6億元',
                'pic' => null,
                'start_at' => '2004-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '取得日本KYOCERA之覆晶基板材料台灣代理權。',
                'pic' => null,
                'start_at' => '2004-02-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2003
            $id[++$i] => [
                'title' => '10月30日股票正式掛牌上櫃。',
                'pic' => null,
                'start_at' => '2003-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '開始於興櫃市場交易。',
                'pic' => null,
                'start_at' => '2003-02-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2002
            $id[++$i] => [
                'title' => '補辦公開發行。',
                'pic' => null,
                'start_at' => '2002-05-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2001
            $id[++$i] => [
                'title' => '合併華友柏電氣材料(股)公司及華山新技(股)公司以擴大營業規模，提供封裝產業整體服務 (Total Solution)。並取得轉投資公司WSP Electromaterials Ltd.、台灣住礦電子(股)公司及山田遠東尖端科技服務(股)公司，持股比率分別為100%、30%及20%。',
                'pic' => null,
                'start_at' => '2001-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '因合併取得 Apic Yamada Corportion 之自動封膠設備及剪腳整腳設備之代理權。',
                'pic' => null,
                'start_at' => '2001-10-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '促成台住電子材料(股)公司 (Taiwan Sumiko Materials Co. Ltd.) 設立金線工廠，直接供應台灣市場需求。',
                'pic' => null,
                'start_at' => '2001-02-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //2000
            $id[++$i] => [
                'title' => '代理銷售台灣住友培科(股)公司製造之封膠樹酯型材料。',
                'pic' => null,
                'start_at' => '2000-07-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //1998
            $id[++$i] => [
                'title' => '促成台灣住友培科(股)公司 (Taiwan Sumitomo Bakelite Co. Ltd.) 在台灣生產環氧樹酯，直接供應台灣市場。',
                'pic' => null,
                'start_at' => '1998-04-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //1994
            $id[++$i] => [
                'title' => '促成Sumitomo Metal Mining Asia Pacific投資台灣住礦電子(股)公司在台設立導線架工廠，直接供應台灣市場需求。',
                'pic' => null,
                'start_at' => '1994-11-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //1989
            $id[++$i] => [
                'title' => '長華電材(股)公司以資本額新台幣200萬元在台北成立，代理日本住友電木之封膠樹酯材料。',
                'pic' => null,
                'start_at' => '1989-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '代理住工(股)公司之封膠樹酯模封材料。',
                'pic' => null,
                'start_at' => '1989-08-01', 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //經營團隊
            $id[++$i] => [
                'title' => '黃嘉能',
                'department' => '董事長 / 執行長 / 總經理',
                'responsibilities' => "發展、規劃、執行公司短、中、長期營運策略及計畫\n規劃公司重大投資之決策與開發新事業版圖",
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '黃俊勳',
                'department' => '業務總經理暨導線架事業部主管',
                'responsibilities' => "導線架及自動化設備事業部之業務推廣\n管理及督導各事業部業務績效",
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '吳聲濤',
                'department' => '台北分公司 / 總經理',
                'responsibilities' => '管理及督導台北分公司業務績效及行政部門事務執行',
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '陳明軒',
                'department' => '高分子材料事業部 / 協理',
                'responsibilities' => '負責高分子材料事業部之業務推廣',
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '趙芝緯',
                'department' => '高分子材料事業部 / 協理',
                'responsibilities' => '負責高分子材料事業部之業務推廣',
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '蔣華文',
                'department' => '基板事業部 / 協理',
                'responsibilities' => '負責基板事業部之業務推廣',
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '陳子仁',
                'department' => '新產品開發事業部 / 協理',
                'responsibilities' => '負責新產品開發事業部之業務推廣',
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '張振榮',
                'department' => '自動化設備事業部 / 協理',
                'responsibilities' => '負責自動化設備事業部之業務推廣',
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            $id[++$i] => [
                'title' => '陳美琴',
                'department' => '財務及會計部 / 經理',
                'responsibilities' => "財務、帳務及稅務規畫及執行\n合併報表作業之規劃與執行\n董事會、審計委員會及薪資報酬委員會議事之執行",
                'pic' => null,
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //肯定與榮耀
            $id[++$i] => [
                'title' => '熱心公益貢獻獎',
                'year' => '2022',
                'company' => '經濟部加工出口區管理處',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/0.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '感謝贊助肇喜登峰巡廻賽',
                'year' => '2022',
                'company' => '台灣職業高爾夫協會',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/1.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => 'Buiness Award',
                'year' => '2021',
                'company' => 'Sumitomo Bakelite',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/2.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '績優供應商',
                'year' => '2021',
                'company' => '華泰電子',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/3.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => 'Buiness Award',
                'year' => '2020',
                'company' => 'Sumitomo Bakelite',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/4.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '績優供應商',
                'year' => '2020',
                'company' => '華泰電子',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/5.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '成立三十週年誌慶',
                'year' => '2019',
                'company' => '華立集團',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/6.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '績優供應商',
                'year' => '2019',
                'company' => '華泰電子',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/7.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '傑出供應合作廠商',
                'year' => '2018',
                'company' => '矽品精密',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/8.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '熱心公益貢獻獎',
                'year' => '2022',
                'company' => '經濟部加工出口區管理處',
                'pic' => json_encode([
                    ['path' => '/static/web/styles/images/about/awards/0.webp']
                ]),
                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //營業據點
            $id[++$i] => [
                'title' => '高雄總公司',
                'address' => '811 高雄市楠梓區東七街16號6樓',
                'phone' => '886-7-362-2663',
                'fax' => '886-7-362-1490',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '台中營業所',
                'address' => '427 台中市潭子區雅豐街109號',
                'phone' => '886-4-2535-4645',
                'fax' => '886-4-2535-4425',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '台北分公司',
                'address' => '114 台北市內湖區港墘路221巷35號7樓',
                'phone' => '886-2-8751-0696',
                'fax' => '886-2-8751-0689',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //其他營業據點
            $id[++$i] => [
                'title' => '長華科技股份有限公司',
                'address' => '811 高雄市楠梓區開發路24號',
                'phone' => '886-7-962-8202',
                'fax' => '886-7-962-8203',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '長華能源科技股份有限公司',
                'address' => '114 台北市內湖區港墘路221巷35號7樓',
                'phone' => '886-2-8751-0696',
                'fax' => '886-2-8751-0689',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //海外營業據點
            $id[++$i] => [
                'title' => 'SH ASIA PACIFIC PTE. LTD.',
                'address' => '10 Eunos Road 8, #05-04/05 Singapore Post Centre, Singapore 408600',
                'phone' => '+65-6914-7908',
                'fax' => '',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => 'MALAYSIAN SH ELECTRONICS SDN. BHD.',
                'address' => 'Lot 5,7 & 9, Jalan Ragum 15/17 40200 Shah Alam Selangor Darul Ehsan, Malaysia',
                'phone' => '+60-3-5519-8140',
                'fax' => '+60-3-5519-8110',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '蘇州興勝科半導體材料有限公司',
                'address' => '215126 中國江蘇省蘇州工業園區龍潭路123號',
                'phone' => '+86-512-62836501',
                'fax' => '+86-512-62836511',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '成都興勝半導體材料有限公司',
                'address' => '610041 中國四川省成都高新區新加坡工業園新園南二路7號',
                'phone' => '+86-28-85155577',
                'fax' => '+86-28-85180228',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '成都興勝新材料有限公司',
                'address' => '611731 中國四川省成都高新區西部園區科新路8號西區6號廠房',
                'phone' => '+86-28-87958880',
                'fax' => '+86-28-87958581',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '長科實業(上海)有限公司',
                'address' => '中國(上海)自由貿易試驗區富特北路207號2層E01室',
                'phone' => '+86-21-5241-9000',
                'fax' => '+86-21-5241-9100',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '上海長華新技電材有限公司',
                'address' => '200050 上海市長寧路1027號兆豐廣場21F-1',
                'phone' => '+86-21-5241-9000',
                'fax' => '+86-21-5241-9000',

                'start_at' => null, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleBlock', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-history','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-management','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-awards','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            ['category_id' => 'web-block-abouts-location-location','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-location','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-location','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            ['category_id' => 'web-block-abouts-location-other','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-other','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],

            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],
            ['category_id' => 'web-block-abouts-location-abroad','categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleBlock'],


        ]);


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
            ['id' => $item1_3 = uuid(), 'parent_id' => $group1,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //科技
            ['id' => $group2 = uuid(), 'parent_id' => null,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $item2_1 = uuid(), 'parent_id' => $group2,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $item2_2 = uuid(), 'parent_id' => $group2,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $item2_3 = uuid(), 'parent_id' => $group2,
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
        ]);

        DBHelper::insertDistributedData('site_parameter', [
            $group1 => ['value' => 'industry', 'sort' => 1, 'active' => 1,
                'title' => '科系', 'operations' => json_encode(['unmodifiable', 'indelible']),
            ],
            $item1_1 => ['value' => '科技業', 'sort' => 1, 'active' => 1,
                'title' => '科技業', 'operations' => null,
            ],
            $item1_2 => ['value' => '製造業', 'sort' => 2, 'active' => 1,
                'title' => '製造業', 'operations' => null,
            ],
            $item1_3 => ['value' => '電子業', 'sort' => 3, 'active' => 1,
                'title' => '電子業', 'operations' => null,
            ],

            $group2 => ['value' => 'department', 'sort' => 1, 'active' => 1,
                'title' => '產業別', 'operations' => json_encode(['unmodifiable', 'indelible']),
            ],
            $item2_1 => ['value' => '資訊工程系', 'sort' => 1, 'active' => 1,
                'title' => '資訊工程系', 'operations' => null,
            ],
            $item2_2 => ['value' => '資訊管理系', 'sort' => 2, 'active' => 1,
                'title' => '資訊管理系', 'operations' => null,
            ],
            $item2_3 => ['value' => '電子系', 'sort' => 3, 'active' => 1,
                'title' => '電子系', 'operations' => null,
            ],
        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\SiteParameter', array_pluck($insertData, 'id'), $this->languages );
    }
}
