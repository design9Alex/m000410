<?php
/**
 * Page wrap: web-default
 *
 * @var array $wrapParameters
 * @var array $seo
 */

/** @var \Minmax\Base\Models\SystemMenu[]|\Illuminate\Database\Eloquent\Collection $headerMenus */
$headerMenus = optional(optional(optional(array_get($wrapParameters, 'systemMenus'))
    ->firstWhere('code', 'web-header'))->systemMenus)->sortBy('sort') ?? collect();

$newsCategories = array_get($wrapParameters, 'newsCategories')->sortBy('sort') ?? collect();
$productsCategories = array_get($wrapParameters, 'productsCategories')->sortBy('sort') ?? collect();


/** @var \Minmax\Base\Models\SystemMenu[]|\Illuminate\Database\Eloquent\Collection $footerMenus */
$footerMenus = optional(optional(optional(array_get($wrapParameters, 'systemMenus'))
    ->firstWhere('code', 'web-footer'))->systemMenus)->sortBy('sort') ?? collect();


?>


<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  @include('web.layouts.partials.html-head')

  {!! webData('custom_head') !!}
</head>

<body class="idxBox jsIdxBox">

@include('web.layouts.partials.header')


<div class="headerBg jsHeaderBg"></div>
<main>
  <h1 class="fakeHidden">長華電材股份有限公司</h1>
  <section class="idxCarouselBox owl-carousel jsIdxCarouselBox">
    <div class="idxCarousel jsIdxCarousel">
      <h2 class="idxCarouselTitle jsIdxCarouselTitle">願景</h2>
      <p class="idxCarouselText">從代理IC封裝材料，結合子公司製造領域，發展出以封裝材料－基板的世界級之專業廠商</p>
      <a href="vision.php" class="idxCarouselBtn defaultA d-flex align-items-center justify-content-center" data-aos="fade-right" data-aos-duration="900">
        <div class="idxCarouselBtnText">深入了解</div>
        <i class="icon_arrowR0 d-block"></i>
      </a>
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/banner/0_mobile.webp" width="1200" height="450" data-device="pad">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/banner/0_pc.webp" width="1920" height="960">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/banner/0.webp" alt="" width="3840" height="1920" loading="lazy">
      </picture>
    </div>
    <div class="idxCarousel jsIdxCarousel">
      <h2 class="idxCarouselTitle jsIdxCarouselTitle">IC封裝材料</h2>
      <p class="idxCarouselText">具關鍵地位之專業半導體封裝材料通路商</p>
      <a href="products.php" class="idxCarouselBtn defaultA d-flex align-items-center justify-content-center" data-aos="fade-right" data-aos-duration="900">
        <div class="idxCarouselBtnText">深入了解</div>
        <i class="icon_arrowR0 d-block"></i>
      </a>
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/banner/1_mobile.webp" width="1200" height="450" data-device="pad">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/banner/1_pc.webp" width="1920" height="960">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/banner/1.webp" alt="" width="3840" height="1920" loading="lazy">
      </picture>
    </div>
    <div class="idxCarousel jsIdxCarousel">
      <h2 class="idxCarouselTitle jsIdxCarouselTitle">IC/LED封裝設備</h2>
      <p class="idxCarouselText">提供先進封裝製程所需之全自動模壓、成型、點膠及塗佈機台</p>
      <a href="products?nKind=1" class="idxCarouselBtn defaultA d-flex align-items-center justify-content-center" data-aos="fade-right" data-aos-duration="900">
        <div class="idxCarouselBtnText">深入了解</div>
        <i class="icon_arrowR0 d-block"></i>
      </a>
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/banner/2_mobile.webp" width="1200" height="450" data-device="pad">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/banner/2_pc.webp" width="1920" height="960">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/banner/2.webp" alt="" width="3840" height="1920" loading="lazy">
      </picture>
    </div>
    <div class="idxCarousel jsIdxCarousel">
      <h2 class="idxCarouselTitle jsIdxCarouselTitle">EMC LED 導線架</h2>
      <p class="idxCarouselText">代理銷售EMC導線架及類BT基板，跨足TFT-LCD及LED 產業</p>
      <a href="products?nKind=2" class="idxCarouselBtn defaultA d-flex align-items-center justify-content-center" data-aos="fade-right" data-aos-duration="900">
        <div class="idxCarouselBtnText">深入了解</div>
        <i class="icon_arrowR0 d-block"></i>
      </a>
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/banner/3_mobile.webp" width="1200" height="450" data-device="pad">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/banner/3_pc.webp" width="1920" height="960">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/banner/3.webp" alt="" width="3840" height="1920" loading="lazy">
      </picture>
    </div>
    <div class="idxCarousel jsIdxCarousel">
      <h2 class="idxCarouselTitle jsIdxCarouselTitle">液晶面板相關材料</h2>
      <p class="idxCarouselText">代理國內知名廠商具競爭優勢之軟板和導光板</p>
      <a href="products?nKind=3" class="idxCarouselBtn defaultA d-flex align-items-center justify-content-center" data-aos="fade-right" data-aos-duration="900">
        <div class="idxCarouselBtnText">深入了解</div>
        <i class="icon_arrowR0 d-block"></i>
      </a>
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/banner/4_mobile.webp" width="1200" height="450" data-device="pad">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/banner/4_pc.webp" width="1920" height="960">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/banner/4.webp" alt="" width="3840" height="1920" loading="lazy">
      </picture>
    </div>
    <div class="idxCarousel jsIdxCarousel">
      <h2 class="idxCarouselTitle jsIdxCarouselTitle">綠能產業</h2>
      <p class="idxCarouselText">提供太陽光電系統興建及相關代辦服務</p>
      <a href="products?nKind=4" class="idxCarouselBtn defaultA d-flex align-items-center justify-content-center" data-aos="fade-right" data-aos-duration="900">
        <div class="idxCarouselBtnText">深入了解</div>
        <i class="icon_arrowR0 d-block"></i>
      </a>
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/banner/5_mobile.webp" width="1200" height="450" data-device="pad">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/banner/5_pc.webp" width="1920" height="960">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/banner/5.webp" alt="" width="3840" height="1920" loading="lazy">
      </picture>
    </div>
  </section>
  <section class="idxNewsBox">
    <div class="idxTopicBox">
      <h2 class="idxTopic" data-aos="fade-left" data-aos-duration="1000">新聞中心</h2>
      <a class="idxTopicMore defaultA" href="news.php" data-aos="fade-left" data-aos-duration="1000">更多資訊</a>
      <div class="idxTopicNavBox d-flex align-items-center justify-content-center justify-content-md-start" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
        <div class="idxTopicNav prev jsIdxTopicNav" data-nav="prev">
          <i class="icon_arrowL0"></i>
        </div>
        <div class="idxTopicNav next jsIdxTopicNav" data-nav="next">
          <i class="icon_arrowR0"></i>
        </div>
      </div>
    </div>
    <div class="idxNewsCarouselBox ArticleDataBox owl-carousel jsIdxNewsCarousel" data-aos="fade-left" data-aos-duration="900">
      <a href="news-Post1.php" class="ArticleData defaultA jsIdxNewsItem">
        <div class="ArticleDataTop">
          <div class="ArticleDataDate">
            <div class="ArticleDataDateY">2023</div>
            <div class="ArticleDataDateD">01.08</div>
          </div>
          <p class="ArticleDataKind mb-0">新聞消息</p>
        </div>
        <div class="ArticleDataImg">
          <img data-src="/static/web/styles/images/news/1.webp" alt="2022年12月合併營收為新台幣15.65億元" width="265" height="176" class="defaultImg lazyload" loading="lazy">
        </div>
        <p class="ArticleDataTitle">2022年12月合併營收為新台幣15.65億元</p>
        <div class="ArticleDataBtn">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
      <a href="news-Post2.php" class="ArticleData defaultA jsIdxNewsItem">
        <div class="ArticleDataTop">
          <div class="ArticleDataDate">
            <div class="ArticleDataDateY">2022</div>
            <div class="ArticleDataDateD">11.04</div>
          </div>
          <p class="ArticleDataKind mb-0">新聞消息</p>
        </div>
        <div class="ArticleDataImg">
          <img data-src="/static/web/styles/images/news/2.webp" alt="長華*(每股面額1元)董事會新聞稿" width="265" height="176" class="defaultImg lazyload" loading="lazy">
        </div>
        <p class="ArticleDataTitle">長華*(每股面額1元)董事會新聞稿</p>
        <div class="ArticleDataBtn">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
      <a href="news-Post3.php" class="ArticleData defaultA jsIdxNewsItem">
        <div class="ArticleDataTop">
          <div class="ArticleDataDate">
            <div class="ArticleDataDateY">2022</div>
            <div class="ArticleDataDateD">09.05</div>
          </div>
          <p class="ArticleDataKind mb-0">活動消息</p>
        </div>
        <div class="ArticleDataImg">
          <img data-src="/static/web/styles/images/news/3.webp" alt="長華與日本住友合資新廠9/5動土 擴大封膠樹酯產能" width="265" height="176" class="defaultImg lazyload" loading="lazy">
        </div>
        <p class="ArticleDataTitle">長華與日本住友合資新廠9/5動土 擴大封膠樹酯產能</p>
        <div class="ArticleDataBtn">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
      <a href="news-Post4.php" class="ArticleData defaultA jsIdxNewsItem">
        <div class="ArticleDataTop">
          <div class="ArticleDataDate">
            <div class="ArticleDataDateY">2022</div>
            <div class="ArticleDataDateD">08.31</div>
          </div>
          <p class="ArticleDataKind mb-0">新聞消息</p>
        </div>
        <div class="ArticleDataImg">
          <img data-src="/static/web/styles/images/news/4.webp" alt="黃嘉能董事長獲頒 2022《哈佛商業評論》台灣企業領袖 100 強名列 62" width="265" height="176" class="defaultImg lazyload" loading="lazy">
        </div>
        <p class="ArticleDataTitle">黃嘉能董事長獲頒 2022《哈佛商業評論》台灣企業領袖 100 強名列 62</p>
        <div class="ArticleDataBtn">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
      <a href="news-Post5.php" class="ArticleData defaultA jsIdxNewsItem">
        <div class="ArticleDataTop">
          <div class="ArticleDataDate">
            <div class="ArticleDataDateY">2022</div>
            <div class="ArticleDataDateD">03.22</div>
          </div>
          <p class="ArticleDataKind mb-0">活動消息</p>
        </div>
        <div class="ArticleDataImg">
          <img data-src="/static/web/styles/images/news/5.webp" alt="長華集團首度冠名主辦高球公開賽" width="265" height="176" class="defaultImg lazyload" loading="lazy">
        </div>
        <p class="ArticleDataTitle">長華集團首度冠名主辦高球公開賽</p>
        <div class="ArticleDataBtn">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
    </div>
  </section>
  <section class="idxIvstBox">
    <div class="idxIvstInfo" data-aos="fade-right" data-aos-duration="1300">
      <h2 class="idxIvstTopic">投資人專區</h2>
      <p class="idxIvstText">長華多年的深耕與努力，隨時充分掌握市場最新動態，創造更高的附加價值，據以帶動與客戶、供應商共同成長的競爭優勢</p>
      <a class="idxBtnMore defaultA" href="financial.php">
        <div class="idxBtnMoreText">更多資訊</div>
        <div class="idxBtnMoreIcon">
          <i class="icon_arrowR0"></i>
        </div>
      </a>
    </div>
    <div class="idxIvstAreaBox">
      <div class="idxIvstAreaInner" data-aos="fade-left" data-aos-duration="900">
        <div class="idxIvstAreaTitle">
          <div class="idxIvstAreaTitleWord">股票代號</div>
          <div class="idxIvstAreaTitleCode">8070</div>
        </div>
        <div class="idxIvstAreaImg">
          <picture>
            <source media="(max-width:1199px)" srcset="/static/web/styles/images/index/investor1m.webp" />
            <source media="(min-width:1200px)" srcset="/static/web/styles/images/index/investor1.webp" />
            <img data-src="/static/web/styles/images/index/investor1.webp" class="defaultImg lazyload" width="780" height="380" alt="" loading="lazy">
          </picture>
        </div>
        <div class="idxIvstAreaNumBox d-md-flex align-items-md-center justify-content-md-center">
          <div class="idxIvstAreaNum">
            <div class="idxIvstAreaNumList">
              <p class="idxIvstAreaNumListTitle">05月營收</p>
              <p class="idxIvstAreaNumListVal">
                1,997,861
                <span class="FontMain">(新台幣千元)</span>
              </p>
            </div>
            <div class="idxIvstAreaNumList">
              <p class="idxIvstAreaNumListTitle">年增率</p>
              <p class="idxIvstAreaNumListVal mb-0">27.7%</p>
            </div>
          </div>
          <div class="idxIvstAreaNum">
            <div class="idxIvstAreaNumList">
              <p class="idxIvstAreaNumListTitle">累計營收</p>
              <p class="idxIvstAreaNumListVal">
                9,506,884
                <span class="FontMain">(新台幣千元)</span>
              </p>
            </div>
            <div class="idxIvstAreaNumList">
              <p class="idxIvstAreaNumListTitle">年增率</p>
              <p class="idxIvstAreaNumListVal mb-0">22.6%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="idxIvstBg"></div>
    <div id="particles-js"></div>
  </section>
  <section class="idxAbtBox">
    <div class="idxAbtInner d-xl-flex align-items-xl-center justify-content-xl-start">
      <div class="idxAbtWordFore">
        <div class="idxAbtPicBox d-flex align-items-center justify-content-center justify-content-lg-end" data-aos="fade-right" data-aos-duration="900">
          <div class="idxAbtPic0">
            <img data-src="/static/web/styles/images/index/about0.webp" alt="" width="330" height="317" class="defaultImg lazyload" loading="lazy">
          </div>
          <div class="idxAbtPic1">
            <img data-src="/static/web/styles/images/index/about1.webp" alt="" width="330" height="440" class="defaultImg lazyload" loading="lazy">
          </div>
          <div class="idxAbtPic2">
            <img data-src="/static/web/styles/images/index/about2.webp" alt="" width="330" height="440" class="defaultImg lazyload" loading="lazy">
          </div>
        </div>
        <p class="idxAbtEnTitle" data-aos="fade-right" data-aos-duration="1600">PROFESSIONALISM QUALITY VALUE</p>
      </div>
      <div class="idxAbtWordBox" data-aos="fade-left" data-aos-duration="900">
        <h2 class="idxAbtTwTitle">專業前瞻眼光與敏銳市場嗅覺 長華電材提供全方位高品質服務</h2>
        <p class="idxAbtInfo">長華電材創立於1989年，歷經多年的深耕與努力，秉持著「誠信、熱忱、全方位服務」的經營宗旨，持續強化產品銷售能力，爭取更多國際品牌代理，期許能以最完整的產品線，滿足客戶一次購足的需求，並隨時充分掌握市場最新動態，創造更高的附加價值，據以帶動與客戶、供應商共同成長的競爭優勢。</p>
        <a class="idxBtnMore defaultA" href="about.php">
          <div class="idxBtnMoreText">關於我們</div>
          <div class="idxBtnMoreIcon">
            <i class="icon_arrowR0"></i>
          </div>
        </a>
      </div>
    </div>
  </section>
  <div class="idxLinkBox d-lg-flex align-items-lg-center justify-content-lg-start">
    <a href="relationship.php" class="idxLink defaultA" data-aos="fade-right" data-aos-duration="900">
      <p class="idxLinkTitle">關係企業</p>
      <div class="idxBtnMore">
        <div class="idxBtnMoreText">了解更多</div>
        <div class="idxBtnMoreIcon">
          <i class="icon_arrowR0"></i>
        </div>
      </div>
    </a>
    <a href="stakeholder.php" class="idxLink keep defaultA" data-aos="fade-left" data-aos-duration="900">
      <p class="idxLinkTitle">企業永續</p>
      <div class="idxBtnMore">
        <div class="idxBtnMoreText">了解更多</div>
        <div class="idxBtnMoreIcon">
          <i class="icon_arrowR0"></i>
        </div>
      </div>
    </a>
  </div>
</main>

@include('web.layouts.partials.footer')

@include('web.layouts.partials.plugins')
</body>
</html>


