<?php
/**
 * Page route:about-awards
 *
 * @var string $local
 */
?>

<main>
  <section class="TopicBox">
    <div class="TopicBg">
      <picture>
        <source media="(max-width: 1200px)"  srcset="/static/web/styles/images/about/topicBg_mobile.webp" width="1200" height="313" data-device="mobile">
        <source media="(max-width: 2048px)"  srcset="/static/web/styles/images/about/topicBg_pc.webp" width="1920" height="500">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/about/topicBg.webp" alt="" width="3840" height="1000">
      </picture>
    </div>
    <h1 class="Topic">關於我們</h1>
  </section>


  @include('web.templates.modules.breadcrumbs')


  <div class="OuterBox">
    <section class="MainBox">
      <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">肯定與榮耀</h2>
      <div class="awardsContent d-flex align-items-start justify-content-start flex-wrap">
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/0.webp" class="defaultImg lazyload" alt="熱心公益貢獻獎">
          </div>
          <h3 class="awardsBlockTitle">熱心公益貢獻獎</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2022</li>
            <li class="awardsBlockInfo">公司：經濟部加工出口區管理處</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/1.webp" class="defaultImg lazyload" alt="感謝贊助肇喜登峰巡廻賽">
          </div>
          <h3 class="awardsBlockTitle">感謝贊助肇喜登峰巡廻賽</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2022</li>
            <li class="awardsBlockInfo">公司：台灣職業高爾夫協會</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/2.webp" class="defaultImg lazyload" alt="Buiness Award">
          </div>
          <h3 class="awardsBlockTitle">Buiness Award</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2021</li>
            <li class="awardsBlockInfo">公司：Sumitomo Bakelite</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/3.webp" class="defaultImg lazyload" alt="績優供應商">
          </div>
          <h3 class="awardsBlockTitle">績優供應商</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2021</li>
            <li class="awardsBlockInfo">公司：華泰電子</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/4.webp" class="defaultImg lazyload" alt="Buiness Award">
          </div>
          <h3 class="awardsBlockTitle">Buiness Award</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2020</li>
            <li class="awardsBlockInfo">公司：Sumitomo Bakelite</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/5.webp" class="defaultImg lazyload" alt="績優供應商">
          </div>
          <h3 class="awardsBlockTitle">績優供應商</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2020</li>
            <li class="awardsBlockInfo">公司：華泰電子</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/6.webp" class="defaultImg lazyload" alt="成立三十週年誌慶">
          </div>
          <h3 class="awardsBlockTitle">成立三十週年誌慶</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2019</li>
            <li class="awardsBlockInfo">公司：華立集團</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/7.webp" class="defaultImg lazyload" alt="績優供應商">
          </div>
          <h3 class="awardsBlockTitle">績優供應商</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2019</li>
            <li class="awardsBlockInfo">公司：華泰電子</li>
          </ul>
        </div>
        <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
          <div class="awardsBlockImg">
            <img data-src="/static/web/styles/images/about/awards/8.webp" class="defaultImg lazyload" alt="傑出供應合作廠商">
          </div>
          <h3 class="awardsBlockTitle">傑出供應合作廠商</h3>
          <ul class="awardsBlockInfoBox list-unstyled mb-0">
            <li class="awardsBlockInfo">年度：2018</li>
            <li class="awardsBlockInfo">公司：矽品精密</li>
          </ul>
        </div>
      </div>
      <ul class="PageBox list-unstyled mb-0" data-aos="zoom-in" data-aos-duration="1000">
        <li class="PageBtn updown disabled">
          <a href="javascript:void(0);" class="defaultA">
            <i class="icon_pageL"></i>
          </a>
        </li>
        <li class="PageBtn active">
          <a href="javascript:void(0);" class="defaultA">
            <div class="PageBtnNum">1</div>
          </a>
        </li>
        <li class="PageBtn">
          <a href="javascript:void(0);" class="defaultA">
            <div class="PageBtnNum">2</div>
          </a>
        </li>
        <li class="PageBtn">
          <a href="javascript:void(0);" class="defaultA">
            <div class="PageBtnNum">3</div>
          </a>
        </li>
        <li class="PageBtn">
          <a href="javascript:void(0);" class="defaultA">
            <div class="PageBtnNum">...</div>
          </a>
        </li>
        <li class="PageBtn">
          <a href="javascript:void(0);" class="defaultA">
            <div class="PageBtnNum">9</div>
          </a>
        </li>
        <li class="PageBtn updown">
          <a href="javascript:void(0);" class="defaultA">
            <i class="icon_pageR"></i>
          </a>
        </li>
      </ul>				</section>
  </div>
</main>
