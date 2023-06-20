<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class UpdateInboxReceivedColumnConfig extends Migration
{
    protected $languages = ['zh-TW' => true,'en' => true,'zh-CN' => true];
    protected $timestamp;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->init();
        $this->updateModelColumnConfig();
        $this->updateInboxColumn();
        //$this->insertInboxColumn();
        //$this->insertInboxCategory();
    }


    protected function init(){
        $this->timestamp = date('Y-m-d H:i:s');
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
        $columnSet = json_decode(optional(DB::table('model_column_config')
                ->where('table_name', 'inbox_received')
                ->first())->columns ?? '{}', true);


        $columnSet['name'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        $columnSet['company'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        $columnSet['phone'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        $columnSet['email'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        $columnSet['subject'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        $columnSet['inquiry'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        $columnSet['content'] = ['table' => 'data_inbox_plaintext', 'language' => false];




        //$columnSet['account'] = ['table' => 'data_inbox_plaintext', 'language' => false];
        //$columnSet['store'] = ['table' => 'data_inbox_plaintext', 'language' => false];

        DB::table('model_column_config')
            ->where('table_name', 'inbox_received')
            ->update([
                'columns' => json_encode($columnSet)
            ]);
    }


    protected function updateInboxColumn()
    {
        DB::table('data_complex')
            ->where('model_type', \Minmax\Inbox\Models\InboxColumn::class)
            ->where('model_id', 'default')
            ->where('column_name', 'column_set')
            ->update([
                'content' => json_encode([
                    ['column' => 'name', 'component' => 'minmax-input-text'],
                    ['column' => 'gender', 'component' => 'minmax-input-text'],
                    ['column' => 'county', 'component' => 'minmax-input-text'],
                    ['column' => 'company', 'component' => 'minmax-input-text'],
                    ['column' => 'phone', 'component' => 'minmax-input-text'],
                    ['column' => 'email', 'component' => 'minmax-input-text'],
                    ['column' => 'inquiry', 'component' => 'minmax-input-text'],

                    ['column' => 'subject', 'component' => 'minmax-input-text'],
                    ['column' => 'account', 'component' => 'minmax-input-text'],
                    //['column' => 'store', 'component' => 'minmax-input-text'],
                ])
            ]);
    }





    /**
     * Insert inbox_category data with distributed columns.
     */
    protected function insertInboxCategory()
    {
        $timestamp = now();

        DB::table('inbox_category')->insert($insertData = [
            ['id' => $id1_1 = 'web-contact-1', 'parent_id' => 'service-contact','created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_2 = 'web-contact-2', 'parent_id' => 'service-contact','created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => $id2 = 'web-recruit', 'parent_id' => null,'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        DBHelper::insertDistributedData('inbox_category', [
            $id1_1 => [

                'title' => ['en' => 'Products', 'zh-TW' => 'Products', 'zh-CN' => 'Products', ],
                'notify_customer' => 1,
                'notify_admin' => 1,
                'notify_emails' => null,
                'column_config' => 'recruit-default',
                'operations' => json_encode(['unmodifiable', 'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            $id1_2 => [

                'title' => ['en' => 'Industry', 'zh-TW' => 'Industry', 'zh-CN' => 'Industry', ],
                'notify_customer' => 1,
                'notify_admin' => 1,
                'notify_emails' => null,
                'column_config' => 'recruit-default',
                'operations' => json_encode(['unmodifiable', 'indelible']),
                'sort' => 2, 'active' => 1,
            ],
            $id2 => [

                'title' => ['en' => 'Talent Recruit', 'zh-TW' => '線上履歷', 'zh-CN' => '線上履歷', ],
                'notify_customer' => 1,
                'notify_admin' => 1,
                'notify_emails' => null,
                'column_config' => 'recruit-default',
                'operations' => json_encode(['unmodifiable', 'indelible']),
                'sort' => 1, 'active' => 1,
            ],
        ]);

        DBHelper::insertLanguageUsage('Minmax\Inbox\Models\InboxCategory', array_pluck($insertData, 'id'),$this->languages);
    }

}
