<?php
/**
 * Page route:products-post
 *
 * @var string $local
 */
?>


<main>
  <section class="TopicBox">
    <div class="TopicBg">
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/product/topicBg_mobile.webp" width="1200" height="313" data-device="mobile">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/product/topicBg_pc.webp" width="1920" height="500">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/product/topicBg.webp" alt="" width="3840" height="1000">
      </picture>
    </div>
    <h1 class="Topic">產品與服務</h1>
  </section>

  @include('web.templates.modules.breadcrumbs')

  <div class="OuterBox">
    <div class="MainBox">

      @include('web.templates.modules.products-post')

    </div>
  </div>
</main>
