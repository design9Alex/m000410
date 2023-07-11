<?php
/**
 * Page route:financial
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

  {{--
  <nav class="BreadBox" data-aos="fade-left" data-aos-duration="900">
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
        <a class="BreadText defaultA" href="financial.php">投資人關係</a>
      </li>
      <li class="middle">
        <i class="icon_arrowR2"></i>
      </li>
      <li>
        <a class="BreadText defaultA" href="financial.php">財務資訊</a>
      </li>
      <li class="middle">
        <i class="icon_arrowR2"></i>
      </li>
      <li>
        <div class="BreadText now">財務基本資料</div>
      </li>
    </ol>
  </nav>
  --}}
  @include('web.templates.modules.breadcrumbs')


  <div class="OuterBox">
    <section class="MainBox editor">
      <h2 class="MainTitle text-center" data-aos="fade-up" data-aos-duration="1000">財務資料</h2>
      <div class="TabBox financial" data-aos="zoom-in" data-aos-duration="1000">
        <div class="TabNow d-lg-none jsTabNow">
          <div class="TabNowText">財務基本資料</div>
          <div class="TabNowIcon">
            <i class="icon_selectTri"></i>
          </div>
        </div>


        @include('web.templates.modules.financial-menu')


      </div>

      <h3 class="Para1" data-aos="fade-up" data-aos-duration="1000">財務基本資料</h3>
      <div class="fnclCont" data-aos="fade-up" data-aos-duration="1000">
        <div class="DataTable">
          <table>
            <thead>
            <tr>
              <th>單位別</th>
              <th>業務</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td class="unit text-start">股市總市值</td>
              <td class="text-start">新台幣231.3億元</td>
            </tr>
            <tr>
              <td class="unit text-start">發行股數</td>
              <td class="text-start">已發行普通股數: 689,419,426 仟股</td>
            </tr>
            <tr>
              <td class="unit text-start">簽證會計師事務所</td>
              <td class="text-start">勤業眾信聯合會計師事務所</td>
            </tr>
            <tr>
              <td class="unit text-start">整合資訊</td>
              <td class="text-start">長華電材公司的整合資訊可從台灣證券交易所取得（請輸入公司股票代號：8070）</td>
            </tr>
            <tr>
              <td class="unit text-start">資料結算日期</td>
              <td class="text-start">以2022/05/23為準</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</main>
