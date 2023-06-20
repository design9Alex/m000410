<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class UpdateNotifyLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $this->updateNotifyContent();
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

    protected function updateNotifyContent()
    {
        $modelType = \Minmax\Notify\Models\SystemNotify::class;
        $defaultLogo = trim(json_encode(asset('static/admin/images/common/logo1.svg')), '"');
        $projectLogo = trim(json_encode(asset('static/web/styles/static/logo1.svg')), '"');

        $mails = DB::table('data_complex')
            ->where('model_type', $modelType)
            ->where('column_name', 'mail_contents')
            ->get();

        foreach ($mails as $mail) {
            DB::table('data_complex')
                ->where('model_type', $modelType)
                ->where('model_id', $mail->model_id)
                ->where('language_id', $mail->language_id)
                ->where('column_name', 'mail_contents')
                ->update(['content' => str_replace($defaultLogo, $projectLogo, $mail->content)]);
        }
    }
}
