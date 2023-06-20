<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArticleBlockColumnConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
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
        DB::table('model_column_config')->where('table_name','article_block')->update([
            'columns' => json_encode([
                'title' => ['table' => 'data_article_plaintext', 'language' => true],       // 區塊標題
                // <-- 擴充欄位
                'subtitle' => ['table' => 'data_article_plaintext', 'language' => true],    // 副標題
                'description' => ['table' => 'data_article_plaintext', 'language' => true], // 簡短敘述
                'editor' => ['table' => 'data_article_editor', 'language' => true],         // 區塊內容
                'condition' => ['table' => 'data_article_editor', 'language' => true],         // 區塊內容

                'email' => ['table' => 'data_article_plaintext', 'language' => true],       //

                'youtube' => ['table' => 'data_article_plaintext', 'language' => true],    // youtube
                'link' => ['table' => 'data_article_plaintext', 'language' => true],    //

                'city' => ['table' => 'data_article_plaintext', 'language' => true],    //

                'department' => ['table' => 'data_article_plaintext', 'language' => true],    //部門
                'responsibilities' => ['table' => 'data_article_plaintext', 'language' => true],    //權責
                'year' => ['table' => 'data_article_plaintext', 'language' => true],    //年度
                'company' => ['table' => 'data_article_plaintext', 'language' => true],    //公司
                'address' => ['table' => 'data_article_plaintext', 'language' => true],    //地址
                'phone' => ['table' => 'data_article_plaintext', 'language' => true],    //電話
                'fax' => ['table' => 'data_article_plaintext', 'language' => true],    //傳真

                'background' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'icon' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'pic' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'banner' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'pic2' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'pic3' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'index_pic' => ['table' => 'data_article_images', 'language' => true],            // 首頁圖示

                'file' => ['table' => 'data_article_files', 'language' => true],            // 檔案


                // ---------->
                'start_at' => ['table' => 'data_datetime', 'language' => false],            // 開始時間
                'end_at' => ['table' => 'data_datetime', 'language' => false],              // 結束時間
                'roles' => ['table' => 'data_collection', 'language' => false],             // 會員群組
                'operations' => ['table' => 'data_collection', 'language' => false],        // 操作權限
                'sort' => ['table' => 'data_sort', 'language' => false],                    // 排序
                'active' => ['table' => 'data_selection', 'language' => false],             // 啟用狀態
            ])
        ]);
    }
}
