<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Minmax\Foundation\Helpers\Database as DBHelper;

class CsrSeeder extends Seeder
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
        $this->init();
        $this->insertArticleColumn();
        $this->insertArticleCategory();
        $this->insertArticlePost();
        $this->insertTemplate();
    }


    protected function init(){
        $this->timestamp = date('Y-m-d H:i:s');
    }

    protected function insertArticleColumn()
    {
        $timestamp = now();

        DB::table('article_column')->insert($insertData = [
            ['id' => 'csr-default', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        DBHelper::insertDistributedData('article_column', [
            'csr-default' => [
                'title' => '[CSR] 活動報導',
                'column_set' => json_encode([
                    ['column' => 'description', 'component' => 'minmax-textarea'],
                    ['column' => 'editor', 'component' => 'minmax-editor', 'height' => '600px'],
                    ['column' => 'pic', 'component' => 'minmax-images'],
                    //['column' => 'file', 'component' => 'minmax-files', 'required' => 'true', 'limit' => '1'],
                ]),
                'sort' => 1, 'active' => 1,
            ],
        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleColumn', array_pluck($insertData, 'id') , $this->languages);
    }

    protected function insertArticleCategory()
    {
        $timestamp = now();

        DB::table('article_category')->insert($insertData = [
            ['id' => 'web-csr', 'parent_id' => 'article-post',
                'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['id' => 'web-csr-activities', 'parent_id' => 'web-csr',
                'created_at' => $timestamp, 'updated_at' => $timestamp],



        ]);

        DBHelper::insertDistributedData('article_category', [
            'web-csr' => [
                'code' => 'web-csr',
                'title' => '企業永續',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => null,
                'category_page' => null,
                'article_page' => null,
                'role_operations' => null,
                'operations' => json_encode(['unmodifiable',  'indelible']),
                'sort' => 10, 'active' => 1,
            ],
            'web-csr-activities' => [
                'code' => 'web-csr-activities',
                'title' => 'CSR活動報導',
                'pic' => null, 'topic' => null, 'description' => null, 'editor' => null,
                'path' => null,
                'column_config' => 'csr-default',
                'category_page' => null,
                'article_page' => 'web-csr',
                'role_operations' => null,
                'operations' => json_encode(['infertile', 'indelible']),
                'sort' => 1, 'active' => 1,
            ],

        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticleCategory', array_pluck($insertData, 'id'),$this->languages);
    }

    protected function insertArticlePost()
    {
        $timestamp = now();

        DB::table('article_post')->insert($insertData = [
            ['id' => $id1 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id2 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id3 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id4 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id5 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id6 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id7 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id8 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => $id9 = uuid(), 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        $editor = <<<HTML
<div class="ArticledtlContent editor" data-aos="fade-up" data-aos-duration="1000">
							<div class="ArticledtlImgBox">
								<div class="ArticledtlImg mx-auto">
									<img data-src="/static/web/styles/images/news/detail1.webp" alt="" class="defaultImg lazyload">
								</div>
							</div>
							<div class="Para4 first">
								<div>
									<p class="mb-0">發稿單位：長華電材股份有限公司</p>
									<p>發稿時間：2023年1月8日</p>
								</div>
								<p>長華電材（長華*，8070）2022年12月合併營收為新台幣15.65億元，較上月減少1.46%，較去年同期減少20.78%。第4季合併營收為48.71億元，季減11.65%，年減14.59%。累計2022年合併營收為新台幣218.59億元，與去年同期相比，成長5.75%，創歷年新高紀錄。</p>
							</div>
							<h3 class="Para2">每月營收報告</h3>
							<p class="Para4 unit text-end">單位：新台幣佰萬元</p>
							<div class="DataTable2 first">
								<table>
									<thead>
										<tr>
											<th class="text-center" rowspan="2">公司/期別</th>
											<th class="plus text-center" colspan="3">合併營收</th>
											<th class="text-center" rowspan="2">與前期比較 </th>
											<th class="text-center" rowspan="2">
												<div>與前一年度</div>
												<div>同期比較</div>
											</th>
										</tr>
										<tr>
											<th class="special text-center">2022年12月</th>
											<th class="special text-center">2022年11月</th>
											<th class="special text-center">2021年12月</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="same0 fontWeight500">長華*(8070)</td>
											<td class="same1">1,565</td>
											<td class="same1">1,588</td>
											<td class="same1">1,976</td>
											<td class="same0">-1.46%</td>
											<td class="same0">-20.78%</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="DataTable2">
								<table>
									<thead>
										<tr>
											<th class="text-center" rowspan="2">公司/期別</th>
											<th class="plus text-center" colspan="2">累計合併營收</th>
											<th class="text-center" rowspan="2">
												<div>與前一年度</div>
												<div>同期比較</div>
											</th>
										</tr>
										<tr>
											<th class="special text-center">2022年</th>
											<th class="special text-center">2021年</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="same0 fontWeight500">長華*(8070)</td>
											<td class="same2">21,859</td>
											<td class="same2">20,671 </td>
											<td class="same0">5.75%</td>
										</tr>
									</tbody>
								</table>
							</div>
							<p class="Para4 notice">註：所提供之合併營收數字係內部結算，未經會計師核閱。</p>
							<div class="Para4 decro text-center"># # #</div>
							<div class="Para4">
								<p class="mb-0">長華*股票面額由每股 10 元改為 1 元之相關說明，請連結官網：<a href="https://www.cwei.com.tw/" target="_blank">www.cwei.com.tw</a></p>
							</div>
						</div>
						<div class="ArticledtlContactBox">
							<p class="ArticledtlContactFore Para4 ColorMain" data-aos="fade-left" data-aos-duration="1500">若需要更進一步訊息，請聯絡</p>
							<ul class="Para4 list-unstyled mb-0">
								<li data-aos="fade-left" data-aos-duration="1500">
									<div class="fontWeight500">【投資人關係窗口】</div>
									<div>董事長室 經理 蘇雙富 Richie  /  電話：<a href="tel:886-2-87510696">(02) 8751-0696 分機 206</a> /  E-mail：<a href="mailto:cwe-ir@cwei.com.tw">cwe-ir@cwei.com.tw</a></div>
								</li>
								<li data-aos="fade-left" data-aos-duration="1500">
									<div class="fontWeight500">【媒體關係窗口】</div>
									<div>董事長室 特助 李洵穎 Ingrid  /  電話：<a href="tel:886-2-87510696">(02) 8751-0696 分機 205</a> /  E-mail：<a href="mailto:cwe-ir@cwei.com.tw">cwe-ir@cwei.com.tw</a></div>
								</li>
							</ul>
						</div>
HTML;


        DBHelper::insertDistributedData('article_post', [
            $id1 => [
                'title' => '長華集團子公司長華科技獎勵並補助員工換購電動機車，尋求國內知名電動機車業者Gogoro支持，雙方於2022年10月6日舉行簽約儀式',
                'description' => '為了善盡保護環境之責，長華集團子公司長華科技獎勵並補助員工換購電動機車，尋求國內知名電動機車業者Gogoro支持，雙方於2022年10月6日舉行簽約儀式，由長華科技董事長黃嘉能與總經理洪全成聯袂出席，以實際行動共同響應節能減碳。',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/1.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id1, 'roles' => null, 'pinned' => 1, 'active' => 1,
            ],
            $id2 => [
                'title' => '長華*(每股面額1元)董事會',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/2.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id2, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id3 => [
                'title' => '長華與日本住友合資新廠9/5動土 擴大封膠樹酯產能',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/3.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id3, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id4 => [
                'title' => '黃嘉能董事長獲頒 2022《哈佛商業評論》台灣企業領袖 100 強名列 62',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/4.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id4, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id5 => [
                'title' => '長華集團首度冠名主辦高球公開賽',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/5.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id5, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id6 => [
                'title' => '2022年12月合併營收為新台幣15.65億元',
                'description' => '長華電材（長華*，8070）2022年12月合併營收為新台幣15.65億元，較上月減少1.46%，較去年同期減少20.78%。第4季合併營收為48.71億元，季減11.65%，年減14.59%。',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/1.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id6, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id7 => [
                'title' => '長華*(每股面額1元)董事會',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/2.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id7, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id8 => [
                'title' => '長華與日本住友合資新廠9/5動土 擴大封膠樹酯產能',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/3.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id8, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],
            $id9 => [
                'title' => '黃嘉能董事長獲頒 2022《哈佛商業評論》台灣企業領袖 100 強名列 62',
                'editor' => $editor,
                'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/4.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),

                'posted_at' => now(), 'start_at' => now(), 'end_at' => null,
                'path' => $id9, 'roles' => null, 'pinned' => 0, 'active' => 1,
            ],




        ], false);

        DBHelper::insertLanguageUsage('Minmax\Article\Models\ArticlePost' , array_pluck($insertData, 'id') , $this->languages );

        DB::table('article_categorical')->insert([
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id1, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id2, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id3, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id4, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id5, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id6, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id7, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id8, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],
            ['category_id' => 'web-csr-activities',
                'categorical_id' => $id9, 'categorical_type' => 'Minmax\Article\Models\ArticlePost'],


        ]);
    }



    protected function insertTemplate()
    {
        $timestamp = now();

        // Insert to template
        DB::table('template')->insert($insertData = [
            ['id' => $id1 = 'editor-csr-post', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);

        $editor = <<<HTML
<div class="ArticledtlContent editor" data-aos="fade-up" data-aos-duration="1000">
							<div class="ArticledtlImgBox">
								<div class="ArticledtlImg mx-auto">
									<img data-src="/static/web/styles/images/news/detail1.webp" alt="" class="defaultImg lazyload">
								</div>
							</div>
							<div class="Para4 first">
								<div>
									<p class="mb-0">發稿單位：長華電材股份有限公司</p>
									<p>發稿時間：2023年1月8日</p>
								</div>
								<p>長華電材（長華*，8070）2022年12月合併營收為新台幣15.65億元，較上月減少1.46%，較去年同期減少20.78%。第4季合併營收為48.71億元，季減11.65%，年減14.59%。累計2022年合併營收為新台幣218.59億元，與去年同期相比，成長5.75%，創歷年新高紀錄。</p>
							</div>
							<h3 class="Para2">每月營收報告</h3>
							<p class="Para4 unit text-end">單位：新台幣佰萬元</p>
							<div class="DataTable2 first">
								<table>
									<thead>
										<tr>
											<th class="text-center" rowspan="2">公司/期別</th>
											<th class="plus text-center" colspan="3">合併營收</th>
											<th class="text-center" rowspan="2">與前期比較 </th>
											<th class="text-center" rowspan="2">
												<div>與前一年度</div>
												<div>同期比較</div>
											</th>
										</tr>
										<tr>
											<th class="special text-center">2022年12月</th>
											<th class="special text-center">2022年11月</th>
											<th class="special text-center">2021年12月</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="same0 fontWeight500">長華*(8070)</td>
											<td class="same1">1,565</td>
											<td class="same1">1,588</td>
											<td class="same1">1,976</td>
											<td class="same0">-1.46%</td>
											<td class="same0">-20.78%</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="DataTable2">
								<table>
									<thead>
										<tr>
											<th class="text-center" rowspan="2">公司/期別</th>
											<th class="plus text-center" colspan="2">累計合併營收</th>
											<th class="text-center" rowspan="2">
												<div>與前一年度</div>
												<div>同期比較</div>
											</th>
										</tr>
										<tr>
											<th class="special text-center">2022年</th>
											<th class="special text-center">2021年</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="same0 fontWeight500">長華*(8070)</td>
											<td class="same2">21,859</td>
											<td class="same2">20,671 </td>
											<td class="same0">5.75%</td>
										</tr>
									</tbody>
								</table>
							</div>
							<p class="Para4 notice">註：所提供之合併營收數字係內部結算，未經會計師核閱。</p>
							<div class="Para4 decro text-center"># # #</div>
							<div class="Para4">
								<p class="mb-0">長華*股票面額由每股 10 元改為 1 元之相關說明，請連結官網：<a href="https://www.cwei.com.tw/" target="_blank">www.cwei.com.tw</a></p>
							</div>
						</div>
						<div class="ArticledtlContactBox">
							<p class="ArticledtlContactFore Para4 ColorMain" data-aos="fade-left" data-aos-duration="1500">若需要更進一步訊息，請聯絡</p>
							<ul class="Para4 list-unstyled mb-0">
								<li data-aos="fade-left" data-aos-duration="1500">
									<div class="fontWeight500">【投資人關係窗口】</div>
									<div>董事長室 經理 蘇雙富 Richie  /  電話：<a href="tel:886-2-87510696">(02) 8751-0696 分機 206</a> /  E-mail：<a href="mailto:cwe-ir@cwei.com.tw">cwe-ir@cwei.com.tw</a></div>
								</li>
								<li data-aos="fade-left" data-aos-duration="1500">
									<div class="fontWeight500">【媒體關係窗口】</div>
									<div>董事長室 特助 李洵穎 Ingrid  /  電話：<a href="tel:886-2-87510696">(02) 8751-0696 分機 205</a> /  E-mail：<a href="mailto:cwe-ir@cwei.com.tw">cwe-ir@cwei.com.tw</a></div>
								</li>
							</ul>
						</div>
HTML;

        DBHelper::insertDistributedData('template', [

            $id1 => [
                'guard' => 'admin', 'group' => 'editor',
                'title' => 'CSR活動報導-內文',
                'description' => null,
                'editor' => $editor,'pic' => json_encode([
                    [
                        'path' => '/static/web/styles/images/news/1.webp',
                        'title' => null, 'media' => null, 'autoplay' => '0', 'cover' => '0', 'device' => 'all',
                    ],
                ]),
                'sort' => 1, 'operations' => json_encode(['unmodifiable', 'indelible']), 'active' => 1,
            ],

        ], false);

        DBHelper::insertLanguageUsage('Minmax\Base\Models\Template', array_pluck($insertData, 'id'),$this->languages);
    }
}
