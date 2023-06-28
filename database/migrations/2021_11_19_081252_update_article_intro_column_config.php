<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class UpdateArticleIntroColumnConfig extends Migration
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
        DB::table('model_column_config')->where('table_name','article_intro')->update([
            'columns' => json_encode([
                'title' => ['table' => 'data_article_plaintext', 'language' => true],       // 項目標題
                // <-- 擴充欄位
                'serial' => ['table' => 'data_article_plaintext', 'language' => true],       // 序號

                'email' => ['table' => 'data_article_plaintext', 'language' => true],       //

                'sub_title' => ['table' => 'data_article_plaintext', 'language' => true],    // 副標題
                'index_title' => ['table' => 'data_article_plaintext', 'language' => true],    // 首頁標題



                //'product_type' => ['table' => 'data_article_plaintext', 'language' => true],    // 產品類型
                //'product_color' => ['table' => 'data_article_plaintext', 'language' => true],    // 產品顏色
                //'product_specification' => ['table' => 'data_article_plaintext', 'language' => true],    // 產品規格

                'youtube' => ['table' => 'data_article_plaintext', 'language' => true],    // youtube
                'link' => ['table' => 'data_article_plaintext', 'language' => true],    // youtube


                'county' => ['table' => 'data_selection', 'language' => false],    //
                'city' => ['table' => 'data_selection', 'language' => false],    //

                'address' => ['table' => 'data_article_plaintext', 'language' => true],    //
                'phone' => ['table' => 'data_article_plaintext', 'language' => false],    //
                'scale' => ['table' => 'data_article_plaintext', 'language' => false],    //營收佔比

                'notes' => ['table' => 'data_article_plaintext', 'language' => true], // 簡短敘述
                'description' => ['table' => 'data_article_plaintext', 'language' => true], // 簡短敘述
                'editor' => ['table' => 'data_article_editor', 'language' => true],         // 區塊內容
                'application' => ['table' => 'data_article_editor', 'language' => true],         // 區塊內容
                'specification' => ['table' => 'data_article_editor', 'language' => true],         // 區塊內容

                'background' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'icon' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'pic' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'banner' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'pic2' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'pic3' => ['table' => 'data_article_images', 'language' => true],            // 圖片
                'index_pic' => ['table' => 'data_article_images', 'language' => true],            // 首頁圖示

                'file' => ['table' => 'data_article_files', 'language' => true],            // 檔案

                'show_index' => ['table' => 'data_selection', 'language' => false],             // 首頁顯示

                // ---------->
                'start_at' => ['table' => 'data_datetime', 'language' => false],            // 開始時間
                'end_at' => ['table' => 'data_datetime', 'language' => false],              // 結束時間
                'relation_post' => ['table' => 'data_collection', 'language' => false],     // 關聯文章
                'relation_intro' => ['table' => 'data_collection', 'language' => false],    // 關聯項目介紹
                'relation_block' => ['table' => 'data_collection', 'language' => false],    // 關聯區塊內容
                'relation_download' => ['table' => 'data_collection', 'language' => false], // 關聯檔案下載
                'relation_product' => ['table' => 'data_collection', 'language' => false], // 關聯商品
                'relation_category' => ['table' => 'data_collection', 'language' => false], // 關聯內容分類
                'path' => ['table' => 'data_article_path', 'language' => true],             // 自訂網址
                'meta_title' => ['table' => 'data_meta', 'language' => true],               // Meta 標題
                'meta_description' => ['table' => 'data_meta', 'language' => true],         // Meta 敘述
                'meta_keywords' => ['table' => 'data_meta', 'language' => true],            // Meta 關鍵字
                'meta_image' => ['table' => 'data_meta', 'language' => true],               // Meta 代表圖
                'roles' => ['table' => 'data_collection', 'language' => false],             // 會員群組
                'operations' => ['table' => 'data_collection', 'language' => false],        // 操作權限
                'sort' => ['table' => 'data_sort', 'language' => false],                    // 排序
                'active' => ['table' => 'data_selection', 'language' => false],             // 啟用狀態

            ])
        ]);
    }
}
