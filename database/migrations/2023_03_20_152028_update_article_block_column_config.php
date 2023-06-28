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

                //損益表
                'income' => ['table' => 'data_article_plaintext', 'language' => true],    //營業收入
                'grossprofit' => ['table' => 'data_article_plaintext', 'language' => true],    //營業毛利
                'revenue' => ['table' => 'data_article_plaintext', 'language' => true],    //營業利益
                'netincome' => ['table' => 'data_article_plaintext', 'language' => true],    //稅前淨利
                'cpynetincome' => ['table' => 'data_article_plaintext', 'language' => true],    //歸屬於母公司淨利
                'eps10' => ['table' => 'data_article_plaintext', 'language' => true],    //股票面額10元計稅後EPS(元)
                'eps1' => ['table' => 'data_article_plaintext', 'language' => true],    //股票面額1元計稅後EPS(元)

                //資產負債表
                'cash' => ['table' => 'data_article_plaintext', 'language' => true],    //現金及約當現金
                'receiveable' => ['table' => 'data_article_plaintext', 'language' => true],    //應收帳款淨額
                'currentassets' => ['table' => 'data_article_plaintext', 'language' => true],    //流動資產
                'equityinvestments' => ['table' => 'data_article_plaintext', 'language' => true],    //採用權益法之投資
                'currentliabilities' => ['table' => 'data_article_plaintext', 'language' => true],    //流動負債
                'noncurrentliabilities' => ['table' => 'data_article_plaintext', 'language' => true],    //非流動負債
                'totalequity' => ['table' => 'data_article_plaintext', 'language' => true],    //權益總計
                'totalassets' => ['table' => 'data_article_plaintext', 'language' => true],    //總資產
                'netincome10' => ['table' => 'data_article_plaintext', 'language' => true],    //股票面額 10元計每股淨值 (元)
                'netincome1' => ['table' => 'data_article_plaintext', 'language' => true],    //股票面額 1元計每股淨值 (元)
                'currentratio' => ['table' => 'data_article_plaintext', 'language' => true],    //流動比率
                'debtratio' => ['table' => 'data_article_plaintext', 'language' => true],    //負債比率

                //現金流量表
                'operate' => ['table' => 'data_article_plaintext', 'language' => true],    //營業活動現金流
                'invest' => ['table' => 'data_article_plaintext', 'language' => true],    //投資活動現金流
                'fund' => ['table' => 'data_article_plaintext', 'language' => true],    //籌資活動現金流

                //每股數據

                'share_cash' => ['table' => 'data_article_plaintext', 'language' => true],    //現金股利
                'netrevenue' => ['table' => 'data_article_plaintext', 'language' => true],    //每股淨資產
                'eps' => ['table' => 'data_article_plaintext', 'language' => true],    //eps

                //重要比率
                'EBITDA' => ['table' => 'data_article_plaintext', 'language' => true],    //EBITDA
                'ROA' => ['table' => 'data_article_plaintext', 'language' => true],    //ROA
                'ROE' => ['table' => 'data_article_plaintext', 'language' => true],    //ROE

                //產品組合
                'iclf' => ['table' => 'data_article_plaintext', 'language' => true],    //IC L/F
                'resin' => ['table' => 'data_article_plaintext', 'language' => true],    //封裝樹脂
                'other' => ['table' => 'data_article_plaintext', 'language' => true],    //其他(含基板)
                'ledlf' => ['table' => 'data_article_plaintext', 'language' => true],    //LED L/F



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
