<?php
/**
 * Page route:financial-income-sheet
 *
 * @var string $local
 */
?>
<main>
  <section class="TopicBox">
    <div class="TopicBg">
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/investor/topicBg_mobile.webp" width="1200" height="313" data-device="mobile">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/investor/topicBg_pc.webp" width="1920" height="500">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/investor/topicBg.webp" alt="" width="3840" height="1000">
      </picture>
    </div>
    <h1 class="Topic">投資人關係</h1>
  </section>

  @include('web.templates.modules.breadcrumbs')

  <div class="OuterBox">
    <section class="MainBox editor">
      <h2 class="MainTitle text-center" data-aos="fade-up" data-aos-duration="1000">財務資訊</h2>
      <div class="TabBox financial" data-aos="zoom-in" data-aos-duration="1000">
        <div class="TabNow d-lg-none jsTabNow">
          <div class="TabNowText">財務摘要</div>
          <div class="TabNowIcon">
            <i class="icon_selectTri"></i>
          </div>
        </div>

        @include('web.templates.modules.financial-menu')

      </div>

      @include('web.templates.modules.financial-information-menu')

      @include('web.templates.modules.financial-balance-sheet')

    </section>
  </div>
</main>
