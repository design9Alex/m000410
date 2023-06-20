<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class CreateSampleTable extends Migration
{
    protected $languages = ['zh-TW' => true,'en' => true];
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        //Schema::create('sample', function (Blueprint $table) {
        //    $table->increments('id');
        //    $table->timestamps();
        //});
        $this->updateSystemLanguage();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        //Schema::dropIfExists('sample');
    }


    protected function updateSystemLanguage()
    {
        DB::table('language_usage')->where('multilingualism_type','Minmax\Base\Models\WebData')->update(['languages' => $this->languages]);

        DB::table('language_usage')->where('multilingualism_type','Minmax\Article\Models\ArticlePage')
            ->where('multilingualism_id','web-home')->update(['languages' => $this->languages]);

        DB::table('data_selection')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','en')->where('column_name','active')->update(['content' => true]);






        //DB::table('data_selection')->where('model_type','Minmax\Base\Models\SystemLanguage')
            //->where('model_id','zh-CN')->where('column_name','active')->update(['content' => true]);


        /*
         DB::table('data_collection')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','en')->where('column_name','guards')->update(['content' => ['web']]);

        DB::table('data_collection')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','zh-TW')->where('column_name','guards')->update(['content' => ['web']]);

        DB::table('data_collection')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','zh-CN')->where('column_name','guards')->update(['content' => ['web']]);

        */

        $model_id = DB::table('data_plaintext')->where('model_type','Minmax\Base\Models\SystemMenu')
            ->where('column_name','code')->where('content','site-keyword')->value('model_id');

        $data_collection = DB::table('data_selection')->where('model_type','Minmax\Base\Models\SystemMenu')
            ->where('column_name','active')->where('model_id',$model_id)
            //->first();
            ->update(['content' => false]);

        $model_id = DB::table('data_plaintext')->where('model_type','Minmax\Base\Models\SystemMenu')
            ->where('column_name','code')->where('content','department')->value('model_id');

        $data_collection = DB::table('data_selection')->where('model_type','Minmax\Base\Models\SystemMenu')
            ->where('column_name','active')->where('model_id',$model_id)
            //->first();
            ->update(['content' => false]);

        //DB::table('system_language')->where('id','ja')->delete();

        DB::table('data_sort')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','en')->where('column_name','sort')->update(['content' => '1']);

        DB::table('data_sort')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','zh-TW')->where('column_name','sort')->update(['content' => '2']);

        /*
        DB::table('data_sort')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','zh-CN')->where('column_name','sort')->update(['content' => '3']);
        */
    }
}
