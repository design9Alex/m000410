<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class UpdateArticleDownloadColumnConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updateModelColumnConfig();
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

    protected function updateModelColumnConfig()
    {
        DB::table('model_column_config')->where('table_name','article_download')->update([
            'columns' => json_encode([
                'title' => ['table' => 'data_article_plaintext', 'language' => true],       // 下載標題

                // <-- 擴充欄位
                'title2' => ['table' => 'data_article_plaintext', 'language' => true],       // 下載標題
                'title3' => ['table' => 'data_article_plaintext', 'language' => true],       // 下載標題
                'year' => ['table' => 'data_article_plaintext', 'language' => true],       // 下載標題

                'sub_title' => ['table' => 'data_article_plaintext', 'language' => true],    // 副標題
                'description' => ['table' => 'data_article_plaintext', 'language' => true], // 簡短敘述

                'location' => ['table' => 'data_article_plaintext', 'language' => true], // 會場
                'meeting_at' => ['table' => 'data_article_plaintext', 'language' => true], // 會場


                'editor' => ['table' => 'data_article_editor', 'language' => true],         // 區塊內容
                'pic' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'file' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'movie_file' => ['table' => 'data_article_files', 'language' => true],            // 檔案

                'quarterly_statements_file_1' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'quarterly_statements_file_2' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'quarterly_statements_file_3' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'quarterly_statements_file_4' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'quarterly_statements_file_5' => ['table' => 'data_article_files', 'language' => true],            // 檔案

                'meeting_file_1' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'meeting_file_2' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'meeting_file_3' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                'meeting_file_4' => ['table' => 'data_article_files', 'language' => true],            // 檔案
                // ---------->

                'start_at' => ['table' => 'data_datetime', 'language' => false],            // 開始時間
                'end_at' => ['table' => 'data_datetime', 'language' => false],              // 結束時間
                'relation_post' => ['table' => 'data_collection', 'language' => false],     // 關聯文章
                'relation_intro' => ['table' => 'data_collection', 'language' => false],    // 關聯項目介紹
                'relation_block' => ['table' => 'data_collection', 'language' => false],    // 關聯區塊內容
                'relation_download' => ['table' => 'data_collection', 'language' => false], // 關聯檔案下載
                'relation_category' => ['table' => 'data_collection', 'language' => false], // 關聯內容分類
                'roles' => ['table' => 'data_collection', 'language' => false],             // 會員群組
                'sort' => ['table' => 'data_sort', 'language' => false],                    // 排序
                'active' => ['table' => 'data_selection', 'language' => false],             // 啟用狀態
            ])
        ]);
    }
}
