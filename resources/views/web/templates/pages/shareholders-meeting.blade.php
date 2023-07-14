<?php
/**
 * Page route:shareholders-meeting
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
      <h2 class="MainTitle text-center" data-aos="fade-up" data-aos-duration="1000">股東專區</h2>
      <div class="TabBox" data-aos="zoom-in" data-aos-duration="1000">
        <div class="TabNow d-lg-none jsTabNow">
          <div class="TabNowText">股東會</div>
          <div class="TabNowIcon">
            <i class="icon_selectTri"></i>
          </div>
        </div>

        @include('web.templates.modules.shareholders-menu')

      </div>

      <h3 class="Para1 first" data-aos="fade-up" data-aos-duration="1000">股東會</h3>

      @include('web.templates.modules.shareholders-meeting')

    </section>
  </div>
</main>

{{--
<div class="PopBox jsShareholderPop">
  <div class="PopCont">
    <div class="PopIcon">
      <i class="icon_popUpNotice"></i>
    </div>
    <div class="PopTitle">提醒</div>
    <p class="PopText">您即將離開本站，前往第三方來源網站可能存在風險，是否繼續?</p>
    <div class="PopBtnBox">
      <a href="" class="PopBtn defaultA special jsPopLink" target="_blank">確定前往</a>
      <button class="PopBtn cancel defaultButton jsPopCancel" type="button">取消</button>
    </div>
  </div>
  <div class="PopBg jsPopCancel"></div>
</div>

--}}
