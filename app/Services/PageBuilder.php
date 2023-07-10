<?php

namespace App\Services;

use App\Repositories\Admin\ProductIntroRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Minmax\Article\Contracts\PageBuilder as ParentBuilder;
use Minmax\Article\Models\ArticleBlock;
use Minmax\Article\Models\ArticleCategory;
use Minmax\Article\Models\ArticleDownload;
use Minmax\Article\Models\ArticleIntro;
use Minmax\Article\Models\ArticlePage;
use Minmax\Article\Models\ArticlePost;
use Minmax\Article\Web\ArticleBlockRepository;
use Minmax\Article\Web\ArticleDownloadRepository;
use Minmax\Article\Web\ArticleIntroRepository;
use Minmax\Article\Web\ArticlePageRepository;
use Minmax\Article\Web\ArticlePostRepository;
use Minmax\Base\Models\SystemMenu;
use Minmax\Inbox\Models\InboxCategory;
use Minmax\Product\Models\ProductClass;
use Minmax\Product\Models\ProductIntro;
use Minmax\World\Admin\WorldCountryRepository;
use Minmax\World\Admin\WorldCountyRepository;
use Minmax\World\Models\WorldCounty;

/**
 * Class PageSample
 *
 * @package Minmax\Article\Services
 */
class PageBuilder extends ParentBuilder
{
    public function __construct($page)
    {
        parent::__construct($page);

        if (filled($page)) {
            $this->setSeo('schema', [
                "@context" => "https://schema.org",
                "@type" => "Organization",
                "url" => request()->fullUrl(),
                "name" => webData('site_title'),
                "legalName" => webData('company_name'),
                "logo" => asset('static/web/styles/images/web-icon.ico'),
                "contactPoint" => [
                    "@type" => "ContactPoint",
                    "telephone" => webData('contact_phone'),
                    "contactType" => "customer service",
                    "areaServed" => "TW",
                    "availableLanguage" => app()->getLocale(),
                ],
            ]);
        }

    }


    public function settingSeo(...$models)
    {
        $seoTitle = null;
        $seoDescription = null;
        $seoKeywords = null;
        $seoImage = null;

        foreach ($models as $model) {
            if (blank($model)) {
                continue;
            }

            if (filled($title = array_get($model, 'meta_title'))) {
                $seoTitle = $title;
            } elseif (filled($title = array_get($model, 'title'))) {
                $seoTitle = $title . ' | ' . webData('site_title');
            }
            if (filled($description = array_get($model, 'meta_description'))) {
                $seoDescription = $description;
            }
            if (filled($keywords = array_get($model, 'meta_keywords'))) {
                $seoKeywords = $keywords;
            }
            if (filled($images = array_get($model, 'meta_image') ?? array_get($model, 'pic'))
                && filled($image = getCoverImage($images))) {
                $seoImage = $image;
            }
        }

        if (filled($seoTitle)) {
            $this->setSeo('title', $seoTitle);
        }
        if (filled($seoDescription)) {
            $this->setSeo('description', $seoDescription);
        }
        if (filled($seoKeywords)) {
            $this->setSeo('keywords', $seoKeywords);
        }
        if (filled($seoImage)) {
            $this->setSeo('image', $seoImage);
        }
    }

    public function build()
    {
        $this->prepareMenus();

        $this->newsCategories();
        $this->productsCategories();

        if(request()->route()->getName() == 'web.home'){
            //$this->getHomeBanner();
            //$this->getHomeNews();
            //$this->getHomeIndustry();
        }


        //if (app()->environment('local', 'development', 'acceptance')) {
            $this->setCacheLimit(now());
        //}

        $moduleBlocks = $this->getElementsByClass('minmax-module');

        $additionHContent = '';
        $this->wrapParameters['projectsExtra'] = false;

        $requestUri = str_replace('/'.app()->getLocale().'/','',Request()->getRequestUri());
        $requestUri = str_replace('/'.app()->getLocale(),'',$requestUri);

        if(app()->getLocale() == webData('system_language')){

            if(mb_substr(Request()->getRequestUri(),0,1) == '/') {
                $requestUri = mb_substr(Request()->getRequestUri(),1);
            }
        }
        //dd($requestUri);

        $this->wrapParameters['requestUri'] = $requestUri;


        foreach ($moduleBlocks as $moduleBlock) {

            $moduleName = $moduleBlock->getAttribute('data-name');
            //$provider = $this->getProvider($moduleName);
            //$provider->initPageBreadcrumbs();

            switch ($moduleName) {

                case 'breadcrumbs':
                    if (!$this->isPreview('admin.article-page.preview-view')) {

                        $this->replaceBreadcrumbs($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'about-history-list':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceAboutHistoryList($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'about-management-list':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceAboutManagementList($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'about-awards-list':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceAboutAwardsList($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'about-location-list':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceAboutLocationList($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'news-list':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceNewsList($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'news-post':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceNewsPost($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'products-list':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceProductsList($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;

                case 'products-post':
                    if (!$this->isPreview('admin.article-page.preview-view')) {
                        $this->replaceProductsPost($moduleBlock);
                    } else {
                        $this->clearWrapDom($moduleBlock, true);
                    }
                    break;


            }
        }

        $this->compressImages();
        $this->attributeExchange('src', 'data-src', ['lazyload'], ['img']);


        $this->content = mb_convert_encoding(trim($this->pregMatch()), 'UTF-8', 'HTML-ENTITIES') . $additionHContent;
        //dd($this->content);
    }

    //replaceBreadcrumbs
    /**
     * @param  \DOMElement|\DOMNode $blockNode
     */
    protected function replaceBreadcrumbs($blockNode)
    {
        $viewData = breadcrumbs(\Request::route()->getName());

        $this->settingSeo(array_get($viewData,'model'));


        //'exposed', 'clicked', 'downloaded'
        if(array_has($viewData,'model') && filled(array_get($viewData,'model'))) {
            switch (array_get($viewData, 'model')->getTable()) {
                case 'product_intro':
                    $this->recordTrack(array_get($viewData, 'model'), 'exposed');
                    break;
                case 'article_page':
                    $this->recordTrack(array_get($viewData, 'model'), 'exposed');
                    break;
                case 'article_post':
                    $this->recordTrack(array_get($viewData, 'model'), 'exposed');
                    break;
                case 'article_intro':
                    $this->recordTrack(array_get($viewData, 'model'), 'exposed');
                    break;
                case 'article_block':
                    $this->recordTrack(array_get($viewData, 'model'), 'clicked');
                    break;
                case 'article_download':
                    $this->recordTrack(array_get($viewData, 'model'), 'downloaded');
                    break;
            }
        }



        $html = view('web.layouts.components.breadcrumbs', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceAboutHistoryList
    protected function replaceAboutHistoryList($blockNode)
    {

        $categoryId = 'web-block-abouts-history';
        $articleCategory = ArticleCategory::query()
            ->with(['articleCategories.articleCategories'])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$categoryId)->distributedOrWhere('code',$categoryId)
            ->distributedActive()
            ->orderBy('sort')
            ->first();



        if(blank($articleCategory)){
            abort(404);
        }

        $articleBlocks = (new ArticleBlockRepository())->query()
            ->with([
                'articleCategories.articleCategory',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->whereHas('articleCategories', function ($query) use($articleCategory) {
                $query->where('id', array_get($articleCategory,'id'));
            })

            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>', now());
            })
            ->distributedActive()
            ->orderBy('sort')
            ->get();

        $years = array();
        $blocks = array();

        foreach($articleBlocks ?? [] as $key => $item){
            $years[] = mb_substr(array_get($item,'start_at')->format('Y'),0,3).'0';
            $blocks[mb_substr(array_get($item,'start_at')->format('Y'),0,3).'0'][array_get($item,'start_at')->format('Y')][] = $item;
        }
        $years = array_unique($years);
        rsort($years);
        $years = array_values($years);

        //dd($blocks);


        $viewData = [
            'routeName' => request()->route()->getName(),
            'articleCategory' => $articleCategory,
            'blocks' => $blocks,
            'years' => $years,
        ];


        $html = view('web.layouts.components.about-history-list', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceAboutManagementList
    protected function replaceAboutManagementList($blockNode)
    {

        $categoryId = 'web-block-abouts-management';
        $articleCategory = ArticleCategory::query()
            ->with(['articleCategories.articleCategories'])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$categoryId)->distributedOrWhere('code',$categoryId)
            ->distributedActive()
            ->orderBy('sort')
            ->first();



        if(blank($articleCategory)){
            abort(404);
        }

        $articleBlocks = (new ArticleBlockRepository())->query()
            ->with([
                'articleCategories.articleCategory',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->whereHas('articleCategories', function ($query) use($articleCategory) {
                $query->where('id', array_get($articleCategory,'id'));
            })

            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>', now());
            })
            ->distributedActive()
            ->orderBy('sort')
            ->get();


        $viewData = [
            'routeName' => request()->route()->getName(),
            'articleCategory' => $articleCategory,
            'articleBlocks' => $articleBlocks,
        ];


        $html = view('web.layouts.components.about-management-list', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceAboutAwardsList
    protected function replaceAboutAwardsList($blockNode)
    {
        $perPage = $blockNode->getAttribute('data-per');
        $perPage = blank($perPage) || $perPage == 0 ? 9 : intval($perPage);

        $currentPage = intval(request('page', 1));

        $categoryId = 'web-block-abouts-awards';
        $articleCategory = ArticleCategory::query()
            ->with(['articleCategories.articleCategories'])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$categoryId)->distributedOrWhere('code',$categoryId)
            ->distributedActive()
            ->orderBy('sort')
            ->first();



        if(blank($articleCategory)){
            abort(404);
        }

        $baseQuery = (new ArticleBlockRepository())->query()
            ->with([
                'articleCategories.articleCategory',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->whereHas('articleCategories', function ($query) use($articleCategory) {
                $query->where('id', array_get($articleCategory,'id'));
            })

            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>', now());
            })
            ->distributedActive();


        $amount = $baseQuery->count();

        $articleBlocks = $baseQuery
            ->orderBy('sort')
            ->forPage($currentPage, $perPage)
            ->get();


        $viewData = [
            'total' => $amount < 1 ? 1 : intval(ceil($amount / $perPage)),
            'current' => $currentPage,
            'routeName' => request()->route()->getName(),
            'articleCategory' => $articleCategory,
            'articleBlocks' => $articleBlocks,
            'routeParameters' => [
                //'cls' => request()->route('cls') ?? '',
            ],
        ];


        $html = view('web.layouts.components.about-awards-list', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceAboutLocationList
    protected function replaceAboutLocationList($blockNode)
    {

        $categoryId = 'web-block-abouts-location';
        $articleCategory = ArticleCategory::query()
            ->with([
                'articleCategories' => function($query){
                    $query->orderBy('sort');
                },
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$categoryId)->distributedOrWhere('code',$categoryId)
            ->distributedActive()
            ->first();



        if(blank($articleCategory)){
            abort(404);
        }

        $articleBlocks = array();

        foreach(array_get($articleCategory,'articleCategories') ?? [] as $key => $item){
            $articleBlocks[array_get($item,'id')] = (new ArticleBlockRepository())->query()
                ->with([
                    'articleCategories' => function($query){
                        $query->orderBy('sort');
                    },
                ])
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->whereHas('articleCategories', function ($query) use($item) {
                    $query->where('id', array_get($item,'id'));
                })

                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->where(function ($query)  {
                    $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
                })
                ->where(function ($query)  {
                    $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>', now());
                })
                ->distributedOrderBy()
                ->get() ?? [];
        }





        $viewData = [
            'routeName' => request()->route()->getName(),
            'articleCategory' => $articleCategory,
            'articleBlocks' => $articleBlocks,
        ];


        $html = view('web.layouts.components.about-location-list', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceNewsList
    protected function replaceNewsList($blockNode)
    {

        $perPage = $blockNode->getAttribute('data-per');
        $perPage = blank($perPage) || $perPage == 0 ? 8 : intval($perPage);

        $articlePageId = 'web-news';
        $currentPage = intval(request('page', 1));

        $articleCategories = ArticleCategory::query()
            ->where('parent_id', $articlePageId)
            ->with(['articleCategories.articleCategories'])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->distributedActive()
            ->orderBy('sort')
            ->get();




        $articleCategory = array();
        $categoryId = request()->route('cls') ?? '';
        if(filled(request()->route('cls'))) {

            $articleCategory = ArticleCategory::query()
                ->where(function ($q) use ($categoryId) {
                    $q->orWhere('id', $categoryId)->distributedOrWhere('path', $categoryId)->distributedOrWhere('code', $categoryId);
                })
                ->distributedActive()
                ->first();
        }


        $topPost = ArticlePost::query()
                ->with(['articleCategories'])
                ->when(filled($categoryId), function ($query) use ($categoryId) {
                    return $query->whereHas('articleCategories', function ($query) use ($categoryId) {
                        //$query->where('id', $categoryId);
                        $query->where(function ($q) use ($categoryId) {
                            $q->orWhere('id', $categoryId)->distributedOrWhere('path', $categoryId)->distributedOrWhere('code', $categoryId);
                        });
                    });
                })
                ->whereHas('articleCategories', function ($query) use($articleCategories)  {
                    //$query->where('id', request()->route('cls'));
                    $query->whereIn('id',array_pluck($articleCategories,'id'));
                })
                ->where(function ($query) {
                    $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
                })
                ->where(function ($query) {
                    $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
                })

                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedWhere('pinned','1')
                ->distributedActive()
                ->orderBy('pinned', 'desc')
                ->orderBy('posted_at', 'desc')
                ->orderBy('id')
                ->first() ?? [];

        $baseQuery = ArticlePost::query()
            ->with([
                'articleCategories.articlePage',
                'articleCategories.articleCategory.articlePage',
                'articleCategories.articleCategory.articleCategory.articlePage',
            ])
            ->when(filled($categoryId), function ($query) use ($categoryId) {
                return $query->whereHas('articleCategories', function ($query) use ($categoryId) {
                    //$query->where('id', $categoryId);
                    $query->where(function ($q) use ($categoryId) {
                        $q->orWhere('id', $categoryId)->distributedOrWhere('path', $categoryId)->distributedOrWhere('code', $categoryId);
                    });
                });
            })
            ->when(filled($topPost), function ($query) use ($topPost) {
                return $query->where('id','!=', array_get($topPost,'id'));
            })
            ->whereHas('articleCategories', function ($query) use($articleCategories)  {
                //$query->where('id', request()->route('cls'));
                $query->whereIn('id',array_pluck($articleCategories,'id'));
            })
            ->where(function ($query) {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query) {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
            })

            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->distributedActive();

        $amount = $baseQuery->count();

        $articlePosts = $baseQuery

            ->orderBy('pinned', 'desc')
            ->orderBy('posted_at', 'desc')
            ->orderBy('id')
            ->forPage($currentPage, $perPage)
            ->get();




        $viewData = [
            'total' => $amount < 1 ? 1 : intval(ceil($amount / $perPage)),
            'current' => $currentPage,
            'routeName' => request()->route()->getName(),
            'articlePageId' => $articlePageId,
            'topPost' => $topPost,
            'articlePosts' => $articlePosts,
            'articleCategories' => $articleCategories,
            'articleCategory' => $articleCategory,
            'cls' => request()->route('cls') ?? '',
            'routeParameters' => [
                'cls' => request()->route('cls') ?? '',
            ],
        ];



        $html = view('web.layouts.components.news-list', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceNewsPost
    /**
     * @param  \DOMElement|\DOMNode $blockNode
     */
    protected function replaceNewsPost($blockNode)
    {
        $articlePageId = 'web-news';
        $articlePostId = request()->route('id');

        $articleCategory = array();
        $categoryId = request()->route('cls') ?? '';

        if(filled(request()->route('cls'))) {

            $articleCategory = ArticleCategory::query()
                ->where(function ($q) use ($categoryId) {
                    $q->orWhere('id', $categoryId)->distributedOrWhere('path', $categoryId)->distributedOrWhere('code', $categoryId);
                })
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedActive()
                ->first();
        }

        if(blank($articleCategory) && !$this->isPreview('admin.article-post.preview-view')){
            abort(404);
        }


        $articlePost = ArticlePost::query()
            ->with([
                'articleCategories.articleCategory',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query) {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query) {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
            })
            ->distributedActive()
            ->where(function($query) use($articlePostId){
                $query->orWhere('id',$articlePostId)->distributedOrWhere('path',$articlePostId);
            })
            ->first();

        if ($this->isPreview('admin.article-post.preview-view')) {
            $articlePost = new ArticlePost(session('admin.preview-data'));
        }


        if (blank($articlePost)) {
            abort(404);
        }

        $articlePostId = array_get($articlePost,'id');


        $site_title = array_get($articlePost,'meta_title' , array_get($articlePost,'title'));
        $this->setSeo('title',$site_title.' | '.webData('site_title'));

        $meta_description = array_get($articlePost,'meta_description' , array_get($articlePost,'description'));

        $this->setSeo('description',$meta_description);
        $this->setSeo('keywords',array_get($articlePost,'meta_keywords'));
        $this->setSeo('image',array_get($articlePost,'meta_image.0.path'));


        $this->recordTrack($articlePost,'clicked');

        if ($this->isPreview('admin.article-post.preview-view')) {
            $parentCategoryID = array_get($articlePost, 'articleCategories.0');
        }else {
            $parentCategoryID = $articlePost->articleCategories[0]->id;
        }



        $allPosts = ArticlePost::query()
            ->with([
                'articleCategories.articlePage',
                'articleCategories.articleCategory.articlePage',
                'articleCategories.articleCategory.articleCategory.articlePage',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->when(filled($categoryId), function ($query) use ($categoryId) {
                return $query->whereHas('articleCategories', function ($query) use ($categoryId) {
                    $query->where(function ($q) use ($categoryId) {
                        $q->orWhere('id', $categoryId)->distributedOrWhere('path', $categoryId)->distributedOrWhere('code', $categoryId);
                    });
                });
            })
            ->where(function ($query) {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query) {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
            })
            ->distributedActive()
            ->orderBy('pinned', 'desc')
            ->orderBy('posted_at', 'desc')
            ->orderBy('id')
            ->get();




        $postsCount = count($allPosts);
        // dd($postsCount);

        $key = array_search($articlePostId, array_pluck($allPosts, 'id'));

        $prev = null;
        $next = null;

        if ($key == 0) {
            $prev = null;
            $postsCount > 1 ? $next = $allPosts[$key + 1] : $next = null;

        } elseif ($key == $postsCount - 1) {
            $prev =   $allPosts[$key - 1];
            $next = null;
        } else {
            $prev = $allPosts[$key - 1];
            $next = $allPosts[$key + 1];
        }


        $viewData = [
            'routeName' => request()->route()->getName(),
            'fullUrl' => request()->fullUrl(),
            'prev' => $prev,
            'next' => $next,
            'articlePageId' => $articlePageId,
            'articlePost' => $articlePost,
            'routeParameters' => [
                'category' => request()->route('id'),
            ],
        ];

        $html = view('web.layouts.components.news-post', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceProductsList
    protected function replaceProductsList($blockNode)
    {
        $perPage = $blockNode->getAttribute('data-per');
        $perPage = blank($perPage) || $perPage == 0 ? 10 : intval($perPage);

        $currentPage = intval(request('page', 1));

        $categoryId = 'web-intro-products';
        $articleCategory = ArticleCategory::query()
            ->with([
                'articleCategories' => function($query){
                    $query->distributedActive()->orderBy('sort');
                },
                'articleCategories.articleCategories' => function($query){
                    $query->distributedActive()->orderBy('sort');
                },
            ])

            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$categoryId)->distributedOrWhere('code',$categoryId)
            ->distributedActive()
            ->orderBy('sort')
            ->first();



        if(blank($articleCategory)){
            abort(404);
        }

        $cls = filled(request()->input('cls')) ? request()->input('cls') : array_get($articleCategory,'articleCategories.0.id');
        $cls2 = filled(request()->input('cls2')) ? request()->input('cls2') : array_get($articleCategory,'articleCategories.0.articleCategories.0.id');

        if(request()->has('cls2')){
            $cls2 = request()->input('cls2') ?? '';
        }

        $category = ArticleCategory::query()
            ->with([
                'articleCategories' => function($query){
                    $query->distributedActive()->orderBy('sort');
                },
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$cls)->distributedOrWhere('code',$cls)
            ->distributedActive()
            ->first() ?? [];


        $secCategory = array();


        if(filled($cls) && filled($cls2)){
            $secCategory = ArticleCategory::query()
                    ->whereHas('languageUsage', function ($query) {
                        $query->whereJsonContains('languages', [app()->getLocale() => true]);
                    })
                    ->where('id',$cls2)->distributedOrWhere('code',$cls2)
                    ->distributedActive()
                    ->first() ?? [];
        }







        $baseQuery = (new ArticleIntroRepository())->query()
            ->with([
                'articleCategories' => function ($query) {
                    $query->distributedActive()->orderBy('sort')
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        });
                },
                'articleCategories.articleCategory' => function ($query) {
                    $query->distributedActive()->orderBy('sort')
                        ->whereHas('languageUsage', function ($query) {
                        $query->whereJsonContains('languages', [app()->getLocale() => true]);
                    });
                },

            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->whereHas('articleCategories', function ($query) use($cls2) {
                $query->distributedActive()->where('id', $cls2);
            })


            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>', now());
            })

            ->distributedActive();


        $baseQuery = $baseQuery->when(!empty(request()->input('product_keyword')), function ($query)  {
            return $query->where(function ($query)   {
                $query
                    ->distributedOrWhere('title', 'like', '%' . request()->input('product_keyword') . '%')
                    ->distributedOrWhere('description', 'like', '%' . request()->input('product_keyword') . '%')
                    ->distributedOrWhere('editor', 'like', '%' . request()->input('product_keyword') . '%');
            });
        });

        $amount = $baseQuery->count();

        $articleIntros = $baseQuery
            ->orderBy('sort')
            ->forPage($currentPage, $perPage)
            ->get();




        $viewData = [
            'total' => $amount < 1 ? 1 : intval(ceil($amount / $perPage)),
            'current' => $currentPage,
            'routeName' => request()->route()->getName(),
            'articleCategory' => $articleCategory,
            'articleIntros' => $articleIntros,
            'cls' => $cls,
            'cls2' => $cls2,
            'product_keyword' => request()->input('product_keyword') ?? '',
            'category' => $category,
            'secCategory' => $secCategory,
            'routeParameters' => [
                'cls' => $cls,
                'cls2' => $cls2,
                'product_keyword' => request()->input('product_keyword') ?? '',
            ],
        ];

        $html = view('web.layouts.components.products-list', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }


    //replaceProductsPost
    /**
     * @param  \DOMElement|\DOMNode $blockNode
     */
    protected function replaceProductsPost($blockNode)
    {
        $articlePageId = 'web-products-post';
        $articleIntroId = request()->route('id');

        $articleCategory = array();
        $cls = request()->route('cls') ?? '';
        $cls2 = request()->route('cls2') ?? '';

        if(filled(request()->route('cls'))) {

            $articleCategory = ArticleCategory::query()
                ->where(function ($q) use ($cls) {
                    $q->orWhere('id', $cls)->distributedOrWhere('path', $cls)->distributedOrWhere('code', $cls);
                })
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedActive()
                ->first();
        }

        if(blank($articleCategory) && !$this->isPreview('admin.article-intro.preview-view')){
            abort(404);
        }


        if(filled(request()->route('cls2'))) {

            $articleSecCategory = ArticleCategory::query()
                ->where(function ($q) use ($cls2) {
                    $q->orWhere('id', $cls2)->distributedOrWhere('path', $cls2)->distributedOrWhere('code', $cls2);
                })
                ->whereHas('languageUsage', function ($query) {
                    $query->whereJsonContains('languages', [app()->getLocale() => true]);
                })
                ->distributedActive()
                ->first();
        }

        if(blank($articleSecCategory) && !$this->isPreview('admin.article-intro.preview-view')){
            abort(404);
        }


        $articleIntro = ArticleIntro::query()
            ->with([
                'articleCategories.articleCategory',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query) {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query) {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
            })
            ->distributedActive()
            ->where(function($query) use($articleIntroId){
                $query->orWhere('id',$articleIntroId)->distributedOrWhere('path',$articleIntroId);
            })
            ->first();

        //dd(array_get($articleIntro,'articleCategories.0.title'));



        if ($this->isPreview('admin.article-intro.preview-view')) {
            $articleIntro = new ArticleIntro(session('admin.preview-data'));
        }


        if (blank($articleIntro)) {
            abort(404);
        }

        $articleIntroId = array_get($articleIntro,'id');


        $site_title = array_get($articleIntro,'meta_title' , array_get($articleIntro,'title'));
        $this->setSeo('title',$site_title.' | '.webData('site_title'));

        $meta_description = array_get($articleIntro,'meta_description' , array_get($articleIntro,'description'));

        $this->setSeo('description',$meta_description);
        $this->setSeo('keywords',array_get($articleIntro,'meta_keywords'));
        $this->setSeo('image',array_get($articleIntro,'meta_image.0.path'));


        $this->recordTrack($articleIntro,'clicked');

        if ($this->isPreview('admin.article-post.preview-view')) {
            $parentCategoryID = array_get($articleIntro, 'articleCategories.0');
        }else {
            $parentCategoryID = $articleIntro->articleCategories[0]->id;
        }



        $allIntros = (new ArticleIntroRepository)->query()
            ->with([
                'articleCategories' => function ($query) {
                    $query->distributedActive()->orderBy('sort')
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        });
                },
                'articleCategories.articleCategory' => function ($query) {
                    $query->distributedActive()->orderBy('sort')
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        });
                },

            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->whereHas('articleCategories', function ($query) use($cls2) {
                $query->distributedActive()->where('id', $cls2);
            })


            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query)  {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>', now());
            })

            ->orderBy('sort')
            ->distributedActive()
            ->get();





        $introsCount = count($allIntros);
        // dd($postsCount);

        $key = array_search($articleIntroId, array_pluck($allIntros, 'id'));

        $prev = null;
        $next = null;

        if ($key == 0) {
            $prev = null;
            $introsCount > 1 ? $next = $allIntros[$key + 1] : $next = null;

        } elseif ($key == $introsCount - 1) {
            $prev =   $allIntros[$key - 1];
            $next = null;
        } else {
            $prev = $allIntros[$key - 1];
            $next = $allIntros[$key + 1];
        }

        $viewData = [
            'routeName' => request()->route()->getName(),
            'fullUrl' => request()->fullUrl(),
            'prev' => $prev,
            'next' => $next,
            'articlePageId' => $articlePageId,
            'articleIntro' => $articleIntro,
            'routeParameters' => [
                'cls' => request()->route('cls'),
                'cls2' => request()->route('cls2'),
                'id' => request()->route('id'),
            ],
        ];

        $html = view('web.layouts.components.products-post', $viewData)->render();
        $this->replaceElement($blockNode, $html);
    }



    protected function prepareMenus()
    {
        $this->wrapParameters['systemMenus'] = \Minmax\Base\Models\SystemMenu::query()
            ->with(trim(str_repeat('systemMenu.', config('minmax.layer_limit.system_menu') - 1), '.'))

            ->with([
                'systemMenus' => function ($query) {
                    $query->distributedActive()
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        });
                },
                'systemMenus.systemMenus' => function ($query) {
                    $query->distributedActive()
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        })
                        ->distributedOrderBy();
                },
                'systemMenus.systemMenus.systemMenus' => function ($query) {
                    $query->distributedActive()
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        })
                        ->distributedOrderBy();
                },

            ])

            ->whereNull('parent_id')
            ->distributedWhere('guard', 'web')
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->distributedActive()
            ->distributedOrderBy()
            ->get();

    }

    protected function newsCategories()
    {
        $this->wrapParameters['newsCategories'] = ArticleCategory::query()
            ->with([
                'articleCategories' => function ($query) {
                    $query->distributedActive()
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        });
                },
                'articleCategories.articleCategories' => function ($query) {
                    $query->distributedActive()->whereHas('languageUsage', function ($query) {
                        $query->whereJsonContains('languages', [app()->getLocale() => true]);
                    });
                },
                'articleCategories.articleCategories.articleCategories' => function ($query) {
                    $query->distributedActive()->whereHas('languageUsage', function ($query) {
                        $query->whereJsonContains('languages', [app()->getLocale() => true]);
                    });
                },

            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('parent_id', 'web-news')
            ->distributedWhere('guard', 'web')
            ->distributedActive()
            ->distributedOrderBy()
            ->get();
    }


    protected function productsCategories()
    {

        $this->wrapParameters['productsCategories'] = ArticleCategory::query()
            ->with([
                'articleCategories' => function ($query) {
                    $query->distributedActive()
                        ->whereHas('languageUsage', function ($query) {
                            $query->whereJsonContains('languages', [app()->getLocale() => true]);
                        });
                },
                'articleCategories.articleCategories' => function ($query) {
                    $query->distributedActive()->whereHas('languageUsage', function ($query) {
                        $query->whereJsonContains('languages', [app()->getLocale() => true]);
                    });
                },
                'articleCategories.articleCategories.articleCategories' => function ($query) {
                    $query->distributedActive()->whereHas('languageUsage', function ($query) {
                        $query->whereJsonContains('languages', [app()->getLocale() => true]);
                    });
                },

            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('parent_id', 'web-intro-products')
            ->distributedWhere('guard', 'web')
            ->distributedActive()
            ->distributedOrderBy()
            ->get();
    }






    protected function changeName($node, $name)
    {
        $newnode = $this->domReader->createElement($name);

        $childNodes = $node->childNodes;
        for ($i = 0; $i < $childNodes->count(); $i++) {
            $newnode->appendChild($childNodes->item($i)->cloneNode(true));
        }
        foreach ($node->attributes as $attrName => $attrNode) {
            $newnode->setAttribute($attrName, $attrNode->value);
        }
        return $newnode;
    }

    /**
     * @param  string $filename
     * @return string
     */
    public function getPageScript($filename, $useCdn = false): string
    {
        $js = file_get_contents(public_path(implode(DIRECTORY_SEPARATOR, [
            'static', 'web', 'scripts', 'page', $filename
        ])));


        $useCdn ? $cdn = "<script src=" . url('static/web/scripts/default/jquery.min.js') . "></script>" : $cdn = "";
        return "\n{$cdn}<script>\n{$js}</script>";
    }







}
