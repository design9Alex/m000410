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
        ]);

        DBHelper::insertDistributedData('article_column', [
            'corporate-directors-resolutions' => [
                'title' => '[公司治理] 董事會決議事項',
                'column_set' => json_encode([
                    ['column' => 'file', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                ]),
                'sort' => 1, 'active' => 1,
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




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleCategory', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleDownload()
    {
        $i = 0;
        DB::table('article_download')->insert($insertData = [
            //股東會
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[++$i] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],


        ]);


        $sort = 0;
        $i = 0;

        DBHelper::insertDistributedData('article_download', [
            $id[++$i] => [
                'title' => '2022年股東會',
                'location' => '高雄市楠梓區經二路15號(從業員工服務中心)',
                'meeting_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2022-06-17 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2021年股東會',
                'location' => '高雄市楠梓區經二路15號(從業員工服務中心)',
                'meeting_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2021-06-17 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2020年股東會',
                'location' => '高雄市楠梓區經二路15號(從業員工服務中心)',
                'meeting_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2020-06-17 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2019年股東會',
                'location' => '高雄市楠梓區經二路15號(從業員工服務中心)',
                'meeting_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2019-06-17 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '2018年股東會',
                'location' => '高雄市楠梓區經二路15號(從業員工服務中心)',
                'meeting_file_1' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_2' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_3' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'meeting_file_4' => json_encode([['path' => '/files/uploads/test.pdf',],]),
                'start_at' => '2018-06-17 10:00:00', 'end_at' => null, 'roles' => null, 'operations' => null,
                'sort' => ++$sort, 'active' => 1,
            ],


        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleDownload', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            [
                'category_id' => 'web-download-shareholders-meeting',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-shareholders-meeting',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-shareholders-meeting',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-shareholders-meeting',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],
            [
                'category_id' => 'web-download-shareholders-meeting',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleDownload'
            ],




        ]);

    }
}
