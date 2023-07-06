<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class InsertWebSystemMenus extends Migration
{

    protected $languages = ['zh-TW' => true,'en' => true];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->insertHeader();
        //$this->insertHeaderMobile();
        $this->insertFooter();
        $this->insertSitemap();

        $this->updateMenu();
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

    protected function insertHeader()
    {
        $timestamp = now();
        $rootId = DB::table('data_plaintext')
            ->where('model_type', \Minmax\Base\Models\SystemMenu::class)
            ->where('column_name', 'code')
            ->where('content', 'web-header')
            ->value('model_id');

        DB::table('system_menu')->insert($insertData = [

			//關於我們
            ['id' => $id1 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_1 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_2 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_3 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_4 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_5 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_6 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_7 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_8 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id1_9 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],


			//新聞中心
            ['id' => $id2 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],


			//產品與服務
            ['id' => $id3 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],



			//投資人關係
            ['id' => $id4 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id4_1 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
				['id' => $id4_2 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
				['id' => $id4_3 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
				['id' => $id4_4 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            //企業永續
            ['id' => $id5 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5_1 = uuid(), 'parent_id' => $id5, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5_2 = uuid(), 'parent_id' => $id5, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            //聯絡我們
            ['id' => $id6 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id6_1 = uuid(), 'parent_id' => $id6, 'created_at' => $timestamp, 'updated_at' => $timestamp],


			//員工專區
            ['id' => $id7 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
                ['id' => $id7_1 = uuid(), 'parent_id' => $id7, 'created_at' => $timestamp, 'updated_at' => $timestamp],

        ]);


        DBHelper::insertDistributedData('system_menu', [

            $id1 => [
                'guard' => 'web', 'code' => 'web-header-abouts',
                'title' => '關於我們', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
                $id1_1 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about',
                    'title' => '公司簡介', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 1, 'active' => 1,
                ],
                $id1_2 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-president',
                    'title' => '經營者的話', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-president', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 2, 'active' => 1,
                ],
                $id1_3 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-history',
                    'title' => '大事紀', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-history', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 3, 'active' => 1,
                ],
                $id1_4 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-organization',
                    'title' => '公司組織', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-organization', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 4, 'active' => 1,
                ],
                $id1_5 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-management',
                    'title' => '經營團隊', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-management', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 5, 'active' => 1,
                ],
                $id1_6 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-vision',
                    'title' => '使命與願景', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-vision', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 6, 'active' => 1,
                ],
                $id1_7 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-awards',
                    'title' => '肯定與榮耀', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-awards', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 7, 'active' => 1,
                ],
                $id1_8 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-relationship',
                    'title' => '關係企業', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-relationship', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 8, 'active' => 1,
                ],
                $id1_9 => [
                    'guard' => 'web', 'code' => 'web-header-abouts-about-location',
                    'title' => '全球據點', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>  '/about-location', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 9, 'active' => 1,
                ],


			$id2 => [
                'guard' => 'web', 'code' => 'web-header-news',
                'title' => '新聞中心', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],

            $id3 => [
                'guard' => 'web', 'code' => 'web-header-products',
                'title' => '產品與服務', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],



            $id4 => [
                'guard' => 'web', 'code' => 'web-header-investor',
                'title' => '投資人關係', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, '/target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],

                $id4_1 => [
                    'guard' => 'web', 'code' => 'web-header-investor-financial',
                    'title' => '財務資訊', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>'/financial', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 1, 'active' => 1,
                ],
                $id4_2 => [
                    'guard' => 'web', 'code' => 'web-header-investor-shareholders-meeting',
                    'title' => '股東專區', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>'/shareholders-meeting', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 2, 'active' => 1,
                ],
				$id4_3 => [
                    'guard' => 'web', 'code' => 'web-header-investor-corporate-overview',
                    'title' => '公司治理', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>'/corporate-overview', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 3, 'active' => 1,
                ],
				$id4_4 => [
                    'guard' => 'web', 'code' => 'web-header-investor-service',
                    'title' => '投資人服務窗口', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>'/investor-service', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 4, 'active' => 1,
                ],


            $id5 => [
                'guard' => 'web', 'code' => 'web-header-stakeholder',
                'title' => '企業永續', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, '/target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 5, 'active' => 1,
            ],

                $id5_1 => [
                    'guard' => 'web', 'code' => 'web-header-stakeholder-stakeholder',
                    'title' => '利害關係人專區', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>'/stakeholder', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 1, 'active' => 1,
                ],
                $id5_2 => [
                    'guard' => 'web', 'code' => 'web-header-stakeholder-csr',
                    'title' => 'CSR活動報導', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' =>'/csr', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 2, 'active' => 1,
                ],




            $id6 => [
                'guard' => 'web', 'code' => 'web-header-contact',
                'title' => '聯絡我們', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 6, 'active' => 1,
            ],

                $id6_1 => [
                    'guard' => 'web', 'code' => 'web-header-contact-contact',
                    'title' => '聯絡我們', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' => '/contact', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 1, 'active' => 1,
                ],




            $id7 => [
                'guard' => 'web', 'code' => 'web-header-staff',
                'title' => '員工專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 7, 'active' => 1,
            ],

                $id7_1 => [
                    'guard' => 'web', 'code' => 'web-header-staff-login',
                    'title' => '員工專區登入', 'description' => null, 'editor' => null, 'pic' => null,
                    'url' => '/staff-login', 'target' => '_self',
                    'permission' => null, 'roles' => null, 'options' => null,
                    'operations' => null, 'sort' => 1, 'active' => 1,
                ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\SystemMenu', array_pluck($insertData, 'id') , $this->languages);
    }



    protected function insertFooter()
    {
        $timestamp = now();

        $rootId = DB::table('data_plaintext')
            ->where('model_type', \Minmax\Base\Models\SystemMenu::class)
            ->where('column_name', 'code')
            ->where('content', 'web-footer')
            ->value('model_id');

        DB::table('system_menu')->insert($insertData = [

            //關於我們
            ['id' => $id1 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_1 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_2 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_3 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_4 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_5 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_6 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_7 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_8 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_9 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],


            //新聞中心
            ['id' => $id2 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],


            //產品與服務
            ['id' => $id3 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],



            //投資人關係
            ['id' => $id4 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_1 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_2 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_3 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_4 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            //企業永續
            ['id' => $id5 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5_1 = uuid(), 'parent_id' => $id5, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5_2 = uuid(), 'parent_id' => $id5, 'created_at' => $timestamp, 'updated_at' => $timestamp],



            //員工專區
            ['id' => $id7 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id7_1 = uuid(), 'parent_id' => $id7, 'created_at' => $timestamp, 'updated_at' => $timestamp],

        ]);


        DBHelper::insertDistributedData('system_menu', [

            $id1 => [
                'guard' => 'web', 'code' => 'web-footer-abouts',
                'title' => '關於我們', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id1_1 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about',
                'title' => '公司簡介', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id1_2 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-president',
                'title' => '經營者的話', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-president', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],
            $id1_3 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-history',
                'title' => '大事紀', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-history', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],
            $id1_4 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-organization',
                'title' => '公司組織', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-organization', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],
            $id1_5 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-management',
                'title' => '經營團隊', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-management', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 5, 'active' => 1,
            ],
            $id1_6 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-vision',
                'title' => '使命與願景', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-vision', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 6, 'active' => 1,
            ],
            $id1_7 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-awards',
                'title' => '肯定與榮耀', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-awards', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 7, 'active' => 1,
            ],
            $id1_8 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-relationship',
                'title' => '關係企業', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-relationship', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 8, 'active' => 1,
            ],
            $id1_9 => [
                'guard' => 'web', 'code' => 'web-footer-abouts-about-location',
                'title' => '全球據點', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-location', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 9, 'active' => 1,
            ],


            $id2 => [
                'guard' => 'web', 'code' => 'web-footer-news',
                'title' => '新聞中心', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],

            $id3 => [
                'guard' => 'web', 'code' => 'web-footer-products',
                'title' => '產品與服務', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],



            $id4 => [
                'guard' => 'web', 'code' => 'web-footer-investor',
                'title' => '投資人關係', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, '/target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],

            $id4_1 => [
                'guard' => 'web', 'code' => 'web-footer-investor-financial',
                'title' => '財務資訊', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/financial', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id4_2 => [
                'guard' => 'web', 'code' => 'web-footer-investor-shareholders-meeting',
                'title' => '股東專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/shareholders-meeting', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],
            $id4_3 => [
                'guard' => 'web', 'code' => 'web-footer-investor-corporate-overview',
                'title' => '公司治理', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/corporate-overview', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],
            $id4_4 => [
                'guard' => 'web', 'code' => 'web-footer-investor-service',
                'title' => '投資人服務窗口', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/investor-service', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],


            $id5 => [
                'guard' => 'web', 'code' => 'web-footer-stakeholder',
                'title' => '企業永續', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, '/target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 5, 'active' => 1,
            ],

            $id5_1 => [
                'guard' => 'web', 'code' => 'web-footer-stakeholder-stakeholder',
                'title' => '利害關係人專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/stakeholder', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id5_2 => [
                'guard' => 'web', 'code' => 'web-footer-stakeholder-csr',
                'title' => 'CSR活動報導', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/csr', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],





            $id7 => [
                'guard' => 'web', 'code' => 'web-footer-staff',
                'title' => '員工專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 7, 'active' => 1,
            ],

            $id7_1 => [
                'guard' => 'web', 'code' => 'web-footer-staff-login',
                'title' => '員工專區登入', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => '/staff-login', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\SystemMenu', array_pluck($insertData, 'id') , $this->languages);
    }

    protected function insertSitemap()
    {
        $timestamp = now();
        $rootId = DB::table('data_plaintext')
            ->where('model_type', \Minmax\Base\Models\SystemMenu::class)
            ->where('column_name', 'code')
            ->where('content', 'web-sitemap')
            ->value('model_id');


        DB::table('system_menu')->insert($insertData = [

            //關於我們
            ['id' => $id1 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_1 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_2 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_3 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_4 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_5 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_6 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_7 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_8 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id1_9 = uuid(), 'parent_id' => $id1, 'created_at' => $timestamp, 'updated_at' => $timestamp],


            //新聞中心
            ['id' => $id2 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],


            //產品與服務
            ['id' => $id3 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],



            //投資人關係
            ['id' => $id4 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_1 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_2 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_3 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4_4 = uuid(), 'parent_id' => $id4, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            //企業永續
            ['id' => $id5 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5_1 = uuid(), 'parent_id' => $id5, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5_2 = uuid(), 'parent_id' => $id5, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            //員工專區
            ['id' => $id6 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id6_1 = uuid(), 'parent_id' => $id6, 'created_at' => $timestamp, 'updated_at' => $timestamp],


            //聯絡我們
            ['id' => $id7 = uuid(), 'parent_id' => $rootId, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id7_1 = uuid(), 'parent_id' => $id7, 'created_at' => $timestamp, 'updated_at' => $timestamp],

        ]);


        DBHelper::insertDistributedData('system_menu', [

            $id1 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts',
                'title' => '關於我們', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id1_1 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about',
                'title' => '公司簡介', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id1_2 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-president',
                'title' => '經營者的話', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-president', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],
            $id1_3 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-history',
                'title' => '大事紀', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-history', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],
            $id1_4 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-organization',
                'title' => '公司組織', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-organization', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],
            $id1_5 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-management',
                'title' => '經營團隊', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-management', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 5, 'active' => 1,
            ],
            $id1_6 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-vision',
                'title' => '使命與願景', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-vision', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 6, 'active' => 1,
            ],
            $id1_7 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-awards',
                'title' => '肯定與榮耀', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-awards', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 7, 'active' => 1,
            ],
            $id1_8 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-relationship',
                'title' => '關係企業', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-relationship', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 8, 'active' => 1,
            ],
            $id1_9 => [
                'guard' => 'web', 'code' => 'web-sitemap-abouts-about-location',
                'title' => '全球據點', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>  '/about-location', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 9, 'active' => 1,
            ],


            $id2 => [
                'guard' => 'web', 'code' => 'web-sitemap-news',
                'title' => '新聞中心', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],

            $id3 => [
                'guard' => 'web', 'code' => 'web-sitemap-products',
                'title' => '產品與服務', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],



            $id4 => [
                'guard' => 'web', 'code' => 'web-sitemap-investor',
                'title' => '投資人關係', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, '/target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],

            $id4_1 => [
                'guard' => 'web', 'code' => 'web-sitemap-investor-financial',
                'title' => '財務資訊', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/financial', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id4_2 => [
                'guard' => 'web', 'code' => 'web-sitemap-investor-shareholders-meeting',
                'title' => '股東專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/shareholders-meeting', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],
            $id4_3 => [
                'guard' => 'web', 'code' => 'web-sitemap-investor-corporate-overview',
                'title' => '公司治理', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/corporate-overview', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 3, 'active' => 1,
            ],
            $id4_4 => [
                'guard' => 'web', 'code' => 'web-sitemap-investor-service',
                'title' => '投資人服務窗口', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/investor-service', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 4, 'active' => 1,
            ],


            $id5 => [
                'guard' => 'web', 'code' => 'web-sitemap-stakeholder',
                'title' => '企業永續', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, '/target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 5, 'active' => 1,
            ],

            $id5_1 => [
                'guard' => 'web', 'code' => 'web-sitemap-stakeholder-stakeholder',
                'title' => '利害關係人專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/stakeholder', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],
            $id5_2 => [
                'guard' => 'web', 'code' => 'web-sitemap-stakeholder-csr',
                'title' => 'CSR活動報導', 'description' => null, 'editor' => null, 'pic' => null,
                'url' =>'/csr', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 2, 'active' => 1,
            ],









            $id6 => [
                'guard' => 'web', 'code' => 'web-sitemap-staff',
                'title' => '員工專區', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 6, 'active' => 1,
            ],

            $id6_1 => [
                'guard' => 'web', 'code' => 'web-sitemap-staff-login',
                'title' => '員工專區登入', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => '/staff-login', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],

            $id7 => [
                'guard' => 'web', 'code' => 'web-sitemap-contact',
                'title' => '聯絡我們', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => null, 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 7, 'active' => 1,
            ],

            $id7_1 => [
                'guard' => 'web', 'code' => 'web-sitemap-contact-contact',
                'title' => '聯絡我們', 'description' => null, 'editor' => null, 'pic' => null,
                'url' => '/contact', 'target' => '_self',
                'permission' => null, 'roles' => null, 'options' => null,
                'operations' => null, 'sort' => 1, 'active' => 1,
            ],



        ], false);



        DBHelper::insertLanguageUsage('Minmax\Base\Models\SystemMenu', array_pluck($insertData, 'id') , $this->languages);
    }


    protected function updateMenu()
    {
        $menu = \DB::table('data_plaintext')->where('model_type','Minmax\Base\Models\SystemMenu')
            ->where('language_id','!=','zh-TW')
            ->where('column_name','url')->get();


        foreach($menu as $key => $item){
            if(mb_substr($item->content,'0','1') == '/'){
                \DB::table('data_plaintext')->where('model_type','Minmax\Base\Models\SystemMenu')
                    ->where('model_id',$item->model_id)
                    ->where('language_id',$item->language_id)
                    ->where('column_name',$item->column_name)->update(['content' => '/'.$item->language_id.$item->content]);
            }
        }
    }

}
