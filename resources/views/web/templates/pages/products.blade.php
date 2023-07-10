<?php
/**
 * Page route:products
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

  {{--
  <nav class="BreadBox" data-aos
  ="fade-left" data-aos-duration="900">
    <ol class="mb-0 list-unstyled d-flex align-items-center justify-content-start flex-wrap">
      <li>
        <a href="index.php" class="BreadIcon defaultA">
          <i class="icon_home"></i>
        </a>
      </li>
      <li class="middle">
        <i class="icon_arrowR2"></i>
      </li>
      <li>
        <div class="BreadText now">產品與服務</div>
      </li>
    </ol>
  </nav>
  --}}
  @include('web.templates.modules.breadcrumbs')

  <div class="OuterBox">
    <div class="MainBox">

      @include('web.templates.modules.products-list')
    </div>
  </div>
</main>
