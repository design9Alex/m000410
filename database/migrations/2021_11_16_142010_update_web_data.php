<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class UpdateWebData extends Migration
{
    protected $languages = ['zh-TW' => true,'en' => true];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $this->updateModelWebDataConfig();
        $this->updateWebDataForWeb();
        $this->updateWebDataForAdmin();
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


    protected function updateModelWebDataConfig(){
        DB::table('model_column_config')->where('table_name','web_data')->update([
            'columns' => json_encode([

                'site_title' => ['table' => 'data_plaintext' , 'language' => true],
                'system_language' => ['table' => 'data_selection' , 'language' => false],
                'system_email' => ['table' => 'data_plaintext' , 'language' => false],
                'system_mobile' => ['table' => 'data_plaintext' , 'language' => false],
                'system_url' => ['table' => 'data_plaintext' , 'language' => false],
                'system_logo' => ['table' => 'data_images' , 'language' => true],
                'company_name' => ['table' => 'data_plaintext' , 'language' => true],
                'company_nickname' => ['table' => 'data_plaintext' , 'language' => true],
                'company_vat' => ['table' => 'data_plaintext' , 'language' => false],
                'contact_phone' => ['table' => 'data_plaintext' , 'language' => true],
                'contact_fax' => ['table' => 'data_plaintext' , 'language' => true],
                'contact_email' => ['table' => 'data_plaintext' , 'language' => true],
                'sale_email' => ['table' => 'data_plaintext' , 'language' => true],
                'contact_address' => ['table' => 'data_plaintext' , 'language' => true],
                'contact_map' => ['table' => 'data_plaintext' , 'language' => false],

                //'social_facebook' => ['table' => 'data_plaintext' , 'language' => false],
                //'social_instagram' => ['table' => 'data_plaintext' , 'language' => false],
                //'social_youtube' => ['table' => 'data_plaintext' , 'language' => false],
                //'social_line' => ['table' => 'data_plaintext' , 'language' => false],
                //'social_linkedIn' => ['table' => 'data_plaintext' , 'language' => false],

                'meta_description' => ['table' => 'data_plaintext' , 'language' => true],
                'meta_keywords' => ['table' => 'data_plaintext' , 'language' => true],
                'custom_head' => ['table' => 'data_plaintext' , 'language' => true],
                'custom_body' => ['table' => 'data_plaintext' , 'language' => true],
                'custom_foot' => ['table' => 'data_plaintext' , 'language' => true],
                'cookie_eula' => ['table' => 'data_editor' , 'language' => true],
                'offline_text' => ['table' => 'data_plaintext' , 'language' => true],
                'active' => ['table' => 'data_selection' , 'language' => false]
                ])
        ]);
    }

    protected function updateWebDataForWeb()
    {
        $modelType = \Minmax\Base\Models\WebData::class;

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'site_title')->update(['content' => '長華電材股份有限公司']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'system_email')->update(['content' => 'cwei@cwei.com.tw']);

        DB::table('data_selection')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'system_language')->update(['content' => 'zh-TW']);

        DB::table('data_selection')->where('model_type', $modelType)->where('model_id', 'admin')
            ->where('column_name', 'system_language')->update(['content' => 'zh-TW']);


        DB::table('data_images')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'system_logo')->update(['content' => json_encode([
                ['path' => '/static/web/styles/images/logo.png'],
                ['path' => '/static/web/styles/images/logo-w.png'],
            ])]);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'company_name')->update(['content' => '長華電材股份有限公司']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'company_nickname')->update(['content' => '長華電材股份有限公司']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'company_vat')->update(['content' => null]);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'contact_phone')->update(['content' => '07-3622663']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'contact_email')->update(['content' => 'cwei@cwei.com.tw']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'contact_fax')->update(['content' => '']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'contact_address')->update(['content' => '811 高雄市楠梓區東七街16號6樓']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'contact_map')->update(['content' => '']);

        /*
        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'social_facebook')->update(['content' => 'https://www.facebook.com/']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'social_instagram')->update(['content' => 'https://www.instagram.com/']);


        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'social_youtube')->update(['content' => 'https://www.youtube.com/']);

        DB::table('data_plaintext')->where('model_type', $modelType)->where('model_id', 'web')
            ->where('column_name', 'social_line')->update(['content' => 'https://line.me/zh-hant/']);


        DB::table('data_plaintext')
            ->insert([
                'model_type' => 'Minmax\Base\Models\WebData',
                'model_id' => 'web',
                'column_name' => 'social_linkedIn',
                'content' => 'https://tw.linkedin.com/',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('data_plaintext')
            ->insert([
                'model_type' => 'Minmax\Base\Models\WebData',
                'model_id' => 'admin',
                'column_name' => 'social_linkedIn',
                'content' => 'https://tw.linkedin.com/',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        */

    }

    protected function updateWebDataForAdmin()
    {
        $modelType = \Minmax\Base\Models\WebData::class;

        DB::table('data_images')->where('model_type', $modelType)->where('model_id', 'admin')
            ->where('column_name', 'system_logo')->update(['content' => json_encode([
                ['path' => '/static/web/styles/images/logo.png'],
                ['path' => '/static/admin/images/demo/example/01.jpg'],
                ['path' => '/static/admin/images/demo/example/02.jpg'],
                ['path' => '/static/admin/images/demo/example/03.jpg'],
            ])]);

        DB::table('data_selection')->where('model_type', $modelType)->where('model_id', 'admin')
            ->where('column_name', 'system_language')->update(['content' => 'zh-TW']);
    }
}
