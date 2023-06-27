<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 平臺前綴網址
    |--------------------------------------------------------------------------
    |
    | 設定使用 siteUri() 時取得平臺網址的規則.
    |
    | start - 開始字元
    | length - 擷取長度
    | name - 指定平臺網址 (將不會由系統自動產生)
    | dev - 開發模式下的指定平臺網址 (僅供 local, development)
    |
    */

    'site_uri' => [
        'admin' => [
            'start' => 9,
            'length' => 8,
            'dev' => 'siteadmin',
        ],
        'web' => [
            'name' => '',
            'dev' => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 階層數設定
    |--------------------------------------------------------------------------
    |
    | 依資料表 (後臺功能) 設定層數限制.
    |
    */

    'layer_limit' => [
        'system_menu' => 3,
        'site_parameter' => 2,
        'system_parameter' => 3,
        'article_category' => 4,
        'inbox_category' => 2,
        'product_category' => 3,
    ],

    /*
    |--------------------------------------------------------------------------
    | 預設資料語系
    |--------------------------------------------------------------------------
    |
    | 不論介面當前語系，此處可設定相對應平臺預設使用的資料語系.
    | 若設定為 null，資料預設語系將會跟隨介面語系.
    |
    */

    'data_language' => [
        'admin' => null,
        'web' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | 草稿數量限制
    |--------------------------------------------------------------------------
    |
    | 設定後臺功能各自保留草稿最大數量. (不計入系統自動儲存的草稿)
    |
    */

    'draft_limit' => 5,

    /*
    |--------------------------------------------------------------------------
    | 客戶端追蹤類型
    |--------------------------------------------------------------------------
    |
    | 代碼與對應的 Model 類別，該 Model 必須有與 TrackCounter 建立關聯
    | (通常有應用 TrackableModel 這個 Trait)
    |
    */

    'page_tracker_list' => [
        'ArticlePage' => \Minmax\Article\Models\ArticlePage::class,
        'ArticlePost' => \Minmax\Article\Models\ArticlePost::class,
        'ArticleIntro' => \Minmax\Article\Models\ArticleIntro::class,
        'ArticleBlock' => \Minmax\Article\Models\ArticleBlock::class,
        'ArticleDownload' => \Minmax\Article\Models\ArticleDownload::class,
        'ArticleCategory' => \Minmax\Article\Models\ArticleCategory::class,
        'ProductIntro' => \Minmax\Product\Models\ProductIntro::class,
        'ProductClass' => \Minmax\Product\Models\ProductClass::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | 客戶端識別碼生命週期 (分鐘)
    |--------------------------------------------------------------------------
    |
    | 30 天 = 43200
    | 1 天 = 1440
    |
    */

    'page_tracker_life' => 43200,

    /*
    |--------------------------------------------------------------------------
    | 系統登入參數
    |--------------------------------------------------------------------------
    |
    | max_attempts - 指定時間內錯誤次數上限
    | decay_minutes - 達到錯誤上限後須等待間隔時間 (分鐘)
    | two_fa_expire - 兩段式驗證碼有效時間 (分鐘)
    | lso - 除帳號外，可用來登入的資料欄位
    | sso - 第三方登入可使用的平臺服務
    |
    */

    'login' => [
        'max_attempts' => [
            'admin' => 5,
            'web' => 5,
        ],
        'decay_minutes' => [
            'admin' => 1,
            'web' => 3,
        ],
        'two_fa_expire' => [
            'admin' => 5,
            'web' => 5,
        ],
        'lso' => [
            'web' => ['email', 'mobile'],
        ],
        'sso' => [
            'web' => [
                'facebook' => ['label' => 'Facebook', 'color' => '#3b579d'],
                'google' => ['label' => 'Google', 'color' => '#e33e2b'],
                //'instagram' => ['label' => 'Instagram', 'color' => '#e33e2b'],
                //'yahoo' => ['label' => 'Yahoo!', 'color' => '#65106e'],
                'line' => ['label' => 'Line', 'color' => '#2ba14b'],
                //'telegram' => ['label' => 'Telegram', 'color' => '#2298d5'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 系統 Log 紀錄設定
    |--------------------------------------------------------------------------
    |
    | 若天數設定為 null 表示紀錄資料無限保留.
    |
    | activity_days - 操作紀錄保留天數
    | data_days - 資料異動紀錄保留天數
    | data_limit - 資料異動紀錄保留筆數 (超過此數量才會算天數)
    | login_days - 登入紀錄保留天數
    |
    */

    'log' => [
        'activity_days' => 90,
        'data_days' => 30,
        'data_limit' => 30,
        'login_days' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Controller 指定注入程式庫
    |--------------------------------------------------------------------------
    |
    | 模組皆有預設 Controller 注入對應之 Repository，可以此處強制更改注入對應.
    |
    */

    'repository_injections' => [
        // ['Minmax\Base\Admin\DemoController', 'App\Repositories\Admin\DemoRepository'],
    ],

    /*
    |--------------------------------------------------------------------------
    | CDN 資源設定
    |--------------------------------------------------------------------------
    |
    | 若使用 cdnAsset() 取得資源網址，則會參照此處設定提供 CDN 網址.
    | 可針對不同資源類型(副檔名)指定不同的 CDN 服務來源.
    |
    */

    'cdn' => [
        // 'cdnjs.cloudflare.com' => 'css|js|jpg|png|gif|svg',
    ],

    /*
    |--------------------------------------------------------------------------
    | 頁面內容建立服務
    |--------------------------------------------------------------------------
    |
    | 指定內容建立服務類別，進行頁面 HTML 置換.
    |
    */

    'page_builder' => \Minmax\Article\Services\PageSample::class,

    /*
    |--------------------------------------------------------------------------
    | 頁面快取中介層
    |--------------------------------------------------------------------------
    |
    | 指定頁面快取的中介服務，處理頁面快取邏輯.
    |
    */

    'page_cache_middleware' => [
        'web' => \Minmax\Article\Middleware\CacheWebPage::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | 網址快速取用服務
    |--------------------------------------------------------------------------
    |
    | 依據給予的特定名稱回傳對應網址. (多數用於系統通知信)
    |
    */

    'url_helper' => \Minmax\Foundation\Helpers\Url::class,

    /*
    |--------------------------------------------------------------------------
    | 動態關聯設定
    |--------------------------------------------------------------------------
    |
    | 設定關聯名稱對應的對象類別與設定.
    |
    | target - 關聯對象 Model 類別.
    | uri - 關聯對象提示建議所對應的路由 uri 名稱.
    | excepts - 你可以指定不建立動態關聯的主體 Model 類別.
    |
    | 關聯名稱 (鍵值) 建議以 related 作為開頭.
    |
    */

    'relative_connection' => [
        'relatedArticlePosts' => [
            'target' => \Minmax\Article\Models\ArticlePost::class,
            'uri' => 'article-post',
            'excepts' => [
                \Minmax\Product\Models\ProductIntro::class
            ],
        ],
        'relatedArticleIntros' => [
            'target' => \Minmax\Article\Models\ArticleIntro::class,
            'uri' => 'article-intro',
            'excepts' => [
                \Minmax\Product\Models\ProductIntro::class
            ],
        ],
        'relatedArticleBlocks' => [
            'target' => \Minmax\Article\Models\ArticleBlock::class,
            'uri' => 'article-block',
            'excepts' => [
                \Minmax\Product\Models\ProductIntro::class
            ],
        ],
        'relatedArticleDownloads' => [
            'target' => \Minmax\Article\Models\ArticleDownload::class,
            'uri' => 'article-download',
            'excepts' => [],
        ],
        'relatedArticleCategories' => [
            'target' => \Minmax\Article\Models\ArticleCategory::class,
            'uri' => 'article-category',
            'excepts' => [
                \Minmax\Product\Models\ProductIntro::class
            ],
        ],
        'relatedProductClasses' => [
            'target' => \Minmax\Product\Models\ProductClass::class,
            'uri' => 'product-class',
            'excepts' => [
                \Minmax\Product\Models\ProductIntro::class
            ],
        ],
        'relatedProductIntros' => [
            'target' => \Minmax\Product\Models\ProductIntro::class,
            'uri' => 'product-intro',
            'excepts' => [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 簽核功能設定
    |--------------------------------------------------------------------------
    |
    | 該設定僅用於 migrate 動作時判斷
    | true - 後臺會啟用簽核功能選單
    | false - 後臺會停用簽核功能選單
    |
    */

    'approval' => false,

    /*
    |--------------------------------------------------------------------------
    | 電子商務設定
    |--------------------------------------------------------------------------
    |
    | cashier_service - 收銀臺服務
    | cart_service - 購物車服務
    | product_service - 商品服務
    | bonus_calculator - 點數計算機
    |
    | sale_page - 設定前臺有獨立活動頁面的優惠類型
    |
    */

    'ecommerce' => [
        'cashier_service' => \Minmax\Commerce\Services\Cashier::class,
        'cart_service' => \Minmax\Commerce\Services\Cart::class,
        'product_service' => \Minmax\Commerce\Services\Product::class,
        'bonus_calculator' => \Minmax\Commerce\Services\BonusCalculator::class,

        'sale_page' => ['discount', 'gift', 'collect'],
    ],

    /*
    |--------------------------------------------------------------------------
    | 系統序號產生服務
    |--------------------------------------------------------------------------
    |
    | 設定系統自動產生流水序號時使用的服務.
    |
    */

    'serial_service' => '\Minmax\Foundation\Helpers\Serial',

    /*
    |--------------------------------------------------------------------------
    | 系統序號產生前綴字元
    |--------------------------------------------------------------------------
    |
    | 設定系統自動產生流水序號時使用的開頭文字.
    |
    */

    'serial_prefix' => [
        'approval_case' => 'R',
        'inbox_received' => 'Q',
        'inbox_reply' => 'E',
        'order_form' => 'C',
        'order_payment' => 'P',
        'order_delivery' => 'S',
        'order_return' => 'R',
        'receipt' => 'V',
        'allowance' => 'A',
    ],

    /*
    |--------------------------------------------------------------------------
    | 行銷模組設定
    |--------------------------------------------------------------------------
    |
    | short_char - 短網址前置 URI 字元
    |
    */

    'marcom' => [
        'short_char' => 's',
    ],

];
