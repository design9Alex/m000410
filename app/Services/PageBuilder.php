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
