<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class ShareHoldersSeeder extends Seeder
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
            ['id' => 'shareholders-meeting', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],  //股東會
        ]);

        DBHelper::insertDistributedData('article_column', [
            'shareholders-meeting' => [
                'title' => '[股東專區] 股東會',
                'column_set' => json_encode([
                    ['column' => 'meeting_at', 'component' => 'minmax-datetime'],
                    ['column' => 'location', 'component' => 'minmax-input-text'],
                    ['column' => 'meeting_file_1', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'meeting_file_2', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'meeting_file_3', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
                    ['column' => 'meeting_file_4', 'component' => 'minmax-files', 'required' => 'false', 'limit' => '1'],
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
                'id' => 'web-download-shareholders', 'parent_id' => 'article-download',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-download-shareholders-meeting', 'parent_id' => 'web-download-shareholders',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],

        ]);






        DBHelper::insertDistributedData('article_category', [




            'web-download-shareholders' => [
                'code' => 'web-download-shareholders',
                'title' => '股東專區',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-download-shareholders-meeting' => [
                'code' => 'web-download-shareholders-meeting',
                'title' => '股東會',
                'editor' => null,
                'topic' => null,
                'path' => null,
                'column_config' => 'shareholders-meeting',
                'category_page' => null,
                'article_page' => 'web-shareholders-meeting',
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
                'meeting_at' => '2022-07-01 10:00:00',
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
                'meeting_at' => '2021-07-01 10:00:00',
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
                'meeting_at' => '2020-07-01 10:00:00',
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
                'meeting_at' => '2019-07-01 10:00:00',
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
                'meeting_at' => '2018-07-01 10:00:00',
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
