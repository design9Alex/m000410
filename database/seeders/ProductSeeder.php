<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Minmax\Article\Models\ArticleIntro;
use Minmax\Foundation\Helpers\Database as DBHelper;

class ProductSeeder extends Seeder
{
    protected $languages = ['zh-TW' => true,'en' => true];
    protected $timestamp;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->init();
        $this->insertArticleColumn();
        $this->insertArticleCategory();
        $this->insertArticleIntro();
        $this->insertTemplate();
    }

    protected function init(){
        $this->timestamp = date('Y-m-d H:i:s');
    }

    protected function insertArticleColumn()
    {

        DB::table('article_column')->insert($insertData = [
            ['id' => 'product-default', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
        ]);

        DBHelper::insertDistributedData('article_column', [
            'product-default' => [
                'title' => '[Product] 預設頁面',
                'column_set' => json_encode([

                    ['column' => 'notes', 'component' => 'minmax-textarea'],
                    ['column' => 'description', 'component' => 'minmax-textarea'],
                    ['column' => 'scale', 'component' => 'minmax-input-text'],
                    ['column' => 'editor', 'component' => 'minmax-editor', 'height' => '600px'],
                    ['column' => 'application', 'component' => 'minmax-editor', 'height' => '600px'],
                    ['column' => 'pic', 'component' => 'minmax-images'],
                    //['column' => 'pic2', 'component' => 'minmax-images'],
                    //['column' => 'relatedProductIntros', 'component' => 'minmax-data-relation', 'uri' => 'product-intro', 'group' => 'relation'],
                    //['column' => 'relatedArticleBlocks', 'component' => 'minmax-data-relation', 'uri' => 'article-block', 'group' => 'relation'],


                ]),
                'sort' => 1, 'active' => 1,
            ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleColumn', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleCategory()
    {

        DB::table('article_category')->insert($insertData = [
            [
                'id' => 'web-intro-products', 'parent_id' => 'article-intro',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-intro-product-1', 'parent_id' => 'web-intro-products',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
                [
                    'id' => 'web-intro-product-1-1', 'parent_id' => 'web-intro-product-1',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-intro-product-1-2', 'parent_id' => 'web-intro-product-1',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-intro-product-1-3', 'parent_id' => 'web-intro-product-1',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-intro-product-1-4', 'parent_id' => 'web-intro-product-1',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],
                [
                    'id' => 'web-intro-product-1-5', 'parent_id' => 'web-intro-product-1',
                    'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
                ],

            [
                'id' => 'web-intro-product-2', 'parent_id' => 'web-intro-products',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],
            [
                'id' => 'web-intro-product-3', 'parent_id' => 'web-intro-products',
                'created_at' => $this->timestamp, 'updated_at' => $this->timestamp
            ],

        ]);





        DBHelper::insertDistributedData('article_category', [

            'web-intro-products' => [
                'code' => 'web-intro-products',
                'title' => '產品與服務',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => 'product-default',
                'category_page' => 'web-products',
                'article_page' => 'web-products-post',
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 1, 'active' => 1,
            ],
            'web-intro-product-1' => [
                'code' => 'web-intro-product-1',
                'title' => '產品',
                'pic' => null,
                'topic' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 1, 'active' => 1,
            ],

                'web-intro-product-1-1' => [
                    'code' => 'web-intro-product-1-1',
                    'title' => 'IC封裝材料',
                    'pic' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 1, 'active' => 1,
                ],
                'web-intro-product-1-2' => [
                    'code' => 'web-intro-product-1-2',
                    'title' => 'IC/LED 封裝設備',
                    'pic' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 2, 'active' => 1,
                ],
                'web-intro-product-1-3' => [
                    'code' => 'web-intro-product-1-3',
                    'title' => 'EMC LED 導線架',
                    'pic' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 3, 'active' => 1,
                ],
                'web-intro-product-1-4' => [
                    'code' => 'web-intro-product-1-4',
                    'title' => '液晶面板材料',
                    'pic' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 4, 'active' => 1,
                ],
                'web-intro-product-1-5' => [
                    'code' => 'web-intro-product-1-5',
                    'title' => '綠能產業',
                    'pic' => null,
                    'topic' => null,
                    'path' => null,
                    'column_config' => null,
                    'category_page' => null,
                    'article_page' => null,
                    'role_operations' => null,
                    'operations' => json_encode(['infertile']),
                    'sort' => 5, 'active' => 1,
                ],


            'web-intro-product-2' => [
                'code' => 'web-intro-product-2',
                'title' => '應用領域',
                'pic' => null,
                'topic' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 2, 'active' => 1,
            ],
            'web-intro-product-3' => [
                'code' => 'web-intro-product-3',
                'title' => '代理品牌',
                'pic' => null,
                'topic' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['infertile']),
                'sort' => 3, 'active' => 1,
            ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleCategory', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticleIntro()
    {
        DB::table('article_intro')->insert($insertData = [
            ['id' => $id[1] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[2] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[3] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[4] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[5] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[6] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[7] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[8] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[9] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[10] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id[11] = uuid(), 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
        ]);

        $editor = <<<HTML
<p class="productdtlIntroText">長華電材代理住友電木株式會社的封膠樹酯（EME），全球市佔率第一。該產品提供出色的性能和易用性，具備低應力、低吸濕性的特性，且不含鹵素，並與無鉛製程兼容，符合 RoHS / SONY GP等環保需求，具備卓越的性能。產品線完整，對於導線架類、塑膠基板類、晶圓級晶片尺吋封裝及扇出型晶圓級封裝，皆能提供完整優異的材料解決方案。</p>
									<ul class="productdtlIntroListBox list-unstyled mb-0">
																					<li class="productdtlIntroList">
												<h4 class="productdtlIntroListTitle mb-0">《產品用途》</h4>
												<p class="productdtlIntroListText">晶片封裝</p>
											</li>
																															<li class="productdtlIntroList">
												<h4 class="productdtlIntroListTitle mb-0">《供應商》</h4>
												<p class="productdtlIntroListText">住友電木株式會社</p>
											</li>
																				<li class="productdtlIntroList pro">
											<h4 class="productdtlIntroListTitle mb-0">《營收佔比》</h4>
											<p class="productdtlIntroListText">17% (2023/q2)、17% (2023/q1)、17% (2022)</p>
										</li>
																			</ul>

HTML;

        $application = <<<HTML
<div class="productdtlIntroItemBox">
										<p class="productdtlIntroItem mb-0">應用產業：PC週邊、消費性電子、網通電信、行動裝置、車用</p>
									</div>
									<ul class="productdtlIntroIconBox d-flex align-items-center justify-content-start flex-wrap flex-lg-nowrap list-unstyled mb-0">
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/pc.svg" alt="PC週邊" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">PC週邊</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/electronic.svg" alt="消費性電子" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">消費性電子</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/telecommunications.svg" alt="網通電信" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">網通電信</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/mobile.svg" alt="行動裝置" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">行動裝置</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/car.svg" alt="車用" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">車用</div>
											</li>
																			</ul>
HTML;


        $sort = 0;
        $i = 0;

        DBHelper::insertDistributedData('article_intro', [
            $id[++$i] => [
                'title' => '封膠樹酯',
                'notes' => '長華電材代理住友電木株式會社的封膠樹酯（EME），全球市佔率第一。該產品提供出色的性能和易用性，具備低應力、低吸濕性的特性，且不含鹵素，並與無鉛製程兼容，符合 RoHS / SONY GP等環保需求，具備卓越的性能。產品線完整，對於導線架類、塑膠基板類、晶圓級晶片尺吋封裝及扇出型晶圓級封裝，皆能提供完整優異的材料解決方案。',
                'description' => "供應商：住友電木株式會社\n負責窗口：Kevin Chao / kevin@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/0.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                    [
                        'path' => '/static/web/styles/images/product/0/0.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                    [
                        'path' => '/static/web/styles/images/product/0/0.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                    [
                        'path' => '/static/web/styles/images/product/0/0.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '導線架',
                'notes' => '長華科技為世界領導的導線架供應商，提供所有類別的金屬導線架，包含全方位的引腳數和矩陣設計。',
                'description' => "供應商：長華科技股份有限公司\n負責窗口：Gary Huang / gary.huang@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/1.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],
            $id[++$i] => [
                'title' => '金屬基板',
                'notes' => '日月光電子股份有限公司擁有同業間最先進的金屬基板製程能力，提供單面、雙面、四層及六層的 IC載板，符合電子、電腦週邊、消費性電子、無線通訊及網路設備等產品的需求。',
                'description' => "供應商：日月光電子股份有限公司\n負責窗口：Ivan Chiang / ivan@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/2.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //3
            $id[++$i] => [
                'title' => '導電/非導電膠',
                'notes' => '長華電材代理住友電木株式會社的導電/非導電膠，提供出色的性能和易用性，適用於晶片黏著、散熱、導電及吸收熱應力等用途，廣泛應用於半導體晶片、二極體、散熱片以及LED晶片等各式應用。',
                'description' => "供應商：住友電木株式會社\n負責窗口：Eric Chen / ericchen@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/3.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //4
            $id[++$i] => [
                'title' => '覆晶基板',
                'notes' => '京瓷擁有同業間最先進的FLIP CHIP SUBSTRATE製程能力，長華代理京瓷之覆晶基板係用於FC-BGA（ up to 6-n-6 Layer）的 IC 載板，能符合3000個 I/O以上的 IC 產品需求。',
                'description' => "供應商：京瓷\n負責窗口：Ivan Chiang / ivan@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/4.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //5
            $id[++$i] => [
                'title' => '離型膜',
                'notes' => '長華電材負責銷售旭硝子玻璃之離型膜，主要應用於半導體領域，包括HDI、BGA、CSP 和 WLP晶圓封裝等產品。AGC離型膜原材質為鐵氟龍，在高溫下具有適當的撓性，可以吸收銅和分離成層上不均勻性，使樹脂可以完全覆蓋材料，而不會有任何空氣間隙。反之，如果使用生硬型式的離型膜，它會導致銅層邊緣及附近的空間產生脫層現象。AGC 離型膜具有優良的抗拉強度，在高溫下拉伸，可以有效阻隔樹脂溢出，也可避免毛邊或模留痕跡。',
                'description' => "供應商：旭硝子玻璃\n負責窗口：Alex Chang / alex@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/5.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //6
            $id[++$i] => [
                'title' => '電子元器件包裝材料',
                'notes' => '長華電材代理住友電木株式會社的上封帶，符合業界環保需求（ROHS / SONY GP），廣泛用於半導體晶片、封裝後成品、二極體成品、被動元件等包裝保護需求，具備防靜電等特性，並可適用於終端客戶高速 SMT 表面黏著製程的需求。',
                'description' => "供應商：住友電木株式會社\n負責窗口：Eric Chen / ericchen@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/6.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //7
            $id[++$i] => [
                'title' => '紫外線可硬化膠帶',
                'notes' => '住友電木株式會社提供一般等級以及具備抗靜電功能的紫外線可硬化膠帶膠帶 ，可用於半導體及電子產品的切割、乘載用途，除用於切割時，具備良好的製程操作特性以及切割的成效，亦可用於晶片成品的乘載，可應用於絕多數的晶片種類。',
                'description' => "供應商：住友電木株式會社\n負責窗口：Eric Chen / ericchen@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/7.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //8
            $id[++$i] => [
                'title' => '塑膠基板介電絕緣材料',
                'notes' => '長華電材代理住友電木株式會社的低熱膨脹係數塑膠基板原材料、CORE芯板和PRE-PREG預浸材料，為應用於生產低翹曲需求塑膠基板。著眼於電子產品朝輕薄短小發展，使用CORE 芯板和PRE-PREG預浸材料做成的基板，能針對電子產品提供最優良的低翹曲特性及符合半導體相關的可靠度解決需求，並應用在各種電子產品上。',
                'description' => "供應商：住友電木株式會社\n負責窗口：陳智傑 / Jay.Chen@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/8.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],

            //9
            $id[++$i] => [
                'title' => '再生晶圓片',
                'notes' => '長華電材銷售艾爾斯半導體之12吋控片晶圓、12吋擋片晶圓及12吋測式晶圓，亦提供2吋晶圓再生加工服務。艾爾斯擁有最新先進的設備以及高水準的研磨、洗淨技術，提供高品質的再生晶片，可根據客戶的需求提供12吋控片晶圓、12吋擋片晶圓及12吋測試晶圓。',
                'description' => "供應商：艾爾斯半導體\n負責窗口：Eason Wang / eason.wang@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/9.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],


            //10
            $id[++$i] => [
                'title' => '封膠樹酯',
                'notes' => '長華電材代理住友電木株式會社的封膠樹酯（EME），全球市佔率第一。該產品提供出色的性能和易用性，具備低應力、低吸濕性的特性，且不含鹵素，並與無鉛製程兼容，符合 RoHS / SONY GP等環保需求，具備卓越的性能。產品線完整，對於導線架類、塑膠基板類、晶圓級晶片尺吋封裝及扇出型晶圓級封裝，皆能提供完整優異的材料解決方案。',
                'description' => "供應商：住友電木株式會社\n負責窗口：Kevin Chao / kevin@cwei.com.tw",
                'scale' => null,
                'editor' => $editor,
                'application' => $application,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/product/0/0.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'start_at' => $this->timestamp, 'end_at' => null,
                'path' => null,
                'roles' => null, 'sort' => ++$sort, 'active' => 1,
            ],



        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleIntro', array_pluck($insertData, 'id'),$this->languages);

        $i = 0;

        DB::table('article_categorical')->insert([
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],
            [
                'category_id' => 'web-intro-product-1-1',
                'categorical_id' => $id[++$i], 'categorical_type' => 'Minmax\Article\Models\ArticleIntro'
            ],



        ]);

    }

    protected function insertTemplate()
    {


        $editor = <<<HTML
<p class="productdtlIntroText">長華電材代理住友電木株式會社的封膠樹酯（EME），全球市佔率第一。該產品提供出色的性能和易用性，具備低應力、低吸濕性的特性，且不含鹵素，並與無鉛製程兼容，符合 RoHS / SONY GP等環保需求，具備卓越的性能。產品線完整，對於導線架類、塑膠基板類、晶圓級晶片尺吋封裝及扇出型晶圓級封裝，皆能提供完整優異的材料解決方案。</p>
									<ul class="productdtlIntroListBox list-unstyled mb-0">
																					<li class="productdtlIntroList">
												<h4 class="productdtlIntroListTitle mb-0">《產品用途》</h4>
												<p class="productdtlIntroListText">晶片封裝</p>
											</li>
																															<li class="productdtlIntroList">
												<h4 class="productdtlIntroListTitle mb-0">《供應商》</h4>
												<p class="productdtlIntroListText">住友電木株式會社</p>
											</li>
																				<li class="productdtlIntroList pro">
											<h4 class="productdtlIntroListTitle mb-0">《營收佔比》</h4>
											<p class="productdtlIntroListText">17% (2023/q2)、17% (2023/q1)、17% (2022)</p>
										</li>
																			</ul>

HTML;

        $application = <<<HTML
<div class="productdtlIntroItemBox">
										<p class="productdtlIntroItem mb-0">應用產業：PC週邊、消費性電子、網通電信、行動裝置、車用</p>
									</div>
									<ul class="productdtlIntroIconBox d-flex align-items-center justify-content-start flex-wrap flex-lg-nowrap list-unstyled mb-0">
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/pc.svg" alt="PC週邊" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">PC週邊</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/electronic.svg" alt="消費性電子" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">消費性電子</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/telecommunications.svg" alt="網通電信" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">網通電信</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/mobile.svg" alt="行動裝置" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">行動裝置</div>
											</li>
																					<li class="productdtlIntroIcon">
												<div class="productdtlIntroIconImg">
													<img data-src="/static/web/styles/images/product/car.svg" alt="車用" class="defaultImg lazyload">
												</div>
												<div class="productdtlIntroIconText">車用</div>
											</li>
																			</ul>
HTML;


        // Insert to template
        DB::table('template')->insert($insertData = [
            //intro
            ['id' => $id1 = 'editor-product', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
            ['id' => $id2 = 'editor-product-application', 'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],

        ]);

        DBHelper::insertDistributedData('template', [
            //intro
            $id1 => [
                'guard' => 'admin', 'group' => 'editor',
                'title' => '產品說明',
                'description' => null,
                'editor' => $editor,
                'pic' => null,
                'sort' => 1, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],
            $id2 => [
                'guard' => 'admin', 'group' => 'editor',
                'title' => '應用產業',
                'description' => null,
                'editor' => $application,
                'pic' => null,
                'sort' => 2, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],






        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\Template', array_pluck($insertData, 'id'),$this->languages);
    }
}
