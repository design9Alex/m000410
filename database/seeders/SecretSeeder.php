<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Minmax\Base\Models\SystemLanguage;

class SecretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->updateAdminUserPassword();

        $this->updateSuperAdmin();
        $this->init();

        //$this->updateSystemParameter();
    }

    /**
     * Please remove this method before give source code
     * to customer or upload to server.
     */
    protected function updateAdminUserPassword()
    {
        $timestamp = date('Y-m-d H:i:s');

        DB::table('admin_user')->where('username', 'sysadmin')->update(['password' => $pwd1 = Hash::make('m24241872@M')]);
        DB::table('admin_user')->where('username', 'admin')->update(['password' => $pwd2 = Hash::make('24241872')]);
        DB::table('admin_user')->where('username', 'test')->update(['password' => $pwd3 = Hash::make('24241872')]);

        $userId1 = DB::table('admin_user')->where('username', 'sysadmin')->value('id');
        $userId2 = DB::table('admin_user')->where('username', 'admin')->value('id');
        $userId3 = DB::table('admin_user')->where('username', 'test')->value('id');

        DB::table('password_history')->insert([
            ['id' => uuid(), 'user_id' => $userId1, 'user_type' => 'Minmax\Base\Models\AdminUser',
                'password' => $pwd1, 'ip' => '127.0.0.1', 'created_at' => $timestamp],
            ['id' => uuid(), 'user_id' => $userId2, 'user_type' => 'Minmax\Base\Models\AdminUser',
                'password' => $pwd2, 'ip' => '127.0.0.1', 'created_at' => $timestamp],
            ['id' => uuid(), 'user_id' => $userId3, 'user_type' => 'Minmax\Base\Models\AdminUser',
                'password' => $pwd3, 'ip' => '127.0.0.1', 'created_at' => $timestamp],
        ]);
    }

    protected function updateSuperAdmin()
    {
        if (app()->environment('local')) {
            DB::table('admin_user')->where('username', 'sysadmin')->update([
                'two_fa' => false
            ]);
        }
    }

    protected function init()
    {
        SystemLanguage::whereIn('id',['ja','zh-CN'])->delete();

        \DB::table('data_sort')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','zh-TW')->where('column_name','sort')->update(['content' => '1']);

        \DB::table('data_sort')->where('model_type','Minmax\Base\Models\SystemLanguage')
            ->where('model_id','en')->where('column_name','sort')->update(['content' => '2']);
    }


    protected function updateSystemParameter()
    {

        $SystemParameterId = DB::table('data_plaintext')
            ->where('model_type','Minmax\Base\Models\SystemParameter')
            ->where('content','product_column_component')->value('model_id');

        $SystemParameter = DB::table('system_parameter')->where('parent_id',$SystemParameterId)->pluck('id')->toArray();

        $model_id = DB::table('data_plaintext')->where('model_type','Minmax\Base\Models\SystemParameter')->whereIn('model_id',$SystemParameter)->where('content','多選')->value('model_id');

        DB::table('data_plaintext')->where('model_id',$model_id)->where('column_name','value')->update(['content' => 'minmax-multi-select']);
    }
}
