<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class CorporateSeeder extends Seeder
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
        $this->insertArticleDownload();
    }


    protected function init(){
        $this->timestamp = date('Y-m-d H:i:s');
    }

    protected function insertArticleColumn()
    {

        DB::table('article_column')->insert($insertData = [
            ['id' => 'corporate-directors-resolutions', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //董事會決議事項
            ['id' => 'corporate-regulations', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //公司重要規章
        ]);

        DBHelper::insertDistributedData('article_column', [
            'corporate-directors-resolutions' => [
                'title' => '[公司治理] 董事會決議事項',
                'column_set' => json_encode([
                    ['column' => 'file', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                ]),
                'sort' => 1, 'active' => 1,
            ],
            'corporate-regulations' => [
                'title' => '[公司治理] 董事會決議事項',
                'column_set' => json_encode([
                    ['column' => 'file', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                ]),
                'sort' => 2, 'active' => 1,
            ],




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleColumn', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleCategory()
    {

        DB::table('article_category')->insert($insertData = [
            [
                'id' => 'web-download-corporate', 'parent_id' => 'article-download',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-download-corporate-directors', 'parent_id' => 'web-download-corporate',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
                [
                    'id' => 'web-download-corporate-directors-resolutions', 'parent_id' => 'web-download-corporate-directors',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],


            [
                'id' => 'web-download-corporate-regulations', 'parent_id' => 'web-download-corporate',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],

        ]);






        DBHelper::insertDistributedData('article_category', [




            'web-download-corporate' => [
                'code' => 'web-download-corporate',
                'title' => '公司治理',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-download-corporate-directors' => [
                'code' => 'web-download-corporate-directors',
                'title' => '董事會',
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
            'web-download-corporate-directors-resolutions' => [
                'code' => 'web-download-corporate-directors-resolutions',
                'title' => '董事會決議事項',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'corporate-directors-resolutions',
                'category_page' => null,
                'article_page' => 'web-corporate-directors-resolutions',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],

            'web-download-corporate-regulations' => [
                'code' => 'web-download-corporate-regulations',
                'title' => '公司重要規章',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'corporate-regulations',
                'category_page' => null,
                'article_page' => 'web-corporate-regulations',
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' =>2, 'active' => 1,
            ],




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleCategory', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleDownload()
    {
        $i = 0;
        DB::table('article_download')->insert($insertData = [
            //董事會決議事項
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

            //公司重要規章
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],


        ]);


        $sort = 0;
        $i = 0;

        DBHelper::insertDistributedData('article_download', [
            //董事會決議事項
            $id[++$i] => [
                'title' => '2021.12.31',
                'location' => '2021 年董事會決議事項',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020.12.31',
                'location' => '2020 年董事會決議事項',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2020.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2019.12.31',
                'location' => '2019 年董事會決議事項',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2019.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2018.12.31',
                'location' => '2018 年董事會決議事項',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2018.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2017.12.31',
                'location' => '2017 年董事會決議事項',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2017.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],

            //公司重要規章
            $id[++$i] => [
                'title' => '董事會議事規範',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '公司治理實務守則',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '取得或處分資產處理程序',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '董事會議事規範',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '董事選舉辦法',
                'file' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021.12.31 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleDownload', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            [
                'category_id' => 'web-download-corporate-directors-resolutions',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-directors-resolutions',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-directors-resolutions',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-directors-resolutions',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-directors-resolutions',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],


            [
                'category_id' => 'web-download-corporate-regulations',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-regulations',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-regulations',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-regulations',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-corporate-regulations',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
        ]);

    }
}
