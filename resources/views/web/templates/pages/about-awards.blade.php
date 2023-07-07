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

      @include('web.templates.modules.about-awards-list')

    </section>
  </div>
</main>
