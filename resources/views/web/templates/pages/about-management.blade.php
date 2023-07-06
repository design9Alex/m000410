<?php
/**
 * Page route:about-management
 *
 * @var string $local
 */
?>
<main>
  <section class="TopicBox">
    <div class="TopicBg">
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/about/topicBg_mobile.webp" width="1200" height="313" data-device="mobile">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/about/topicBg_pc.webp" width="1920" height="500">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/about/topicBg.webp" alt="" width="3840" height="1000">
      </picture>
    </div>
    <h1 class="Topic">關於我們</h1>
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
        <a class="BreadText defaultA" href="about.php">關於我們</a>
      </li>
      <li class="middle">
        <i class="icon_arrowR2"></i>
      </li>
      <li>
        <div class="BreadText now">經營團隊</div>
      </li>
    </ol>
  </nav>
  --}}
  @include('web.templates.modules.breadcrumbs')

  <div class="OuterBox">
    <section class="MainBox editor">
      <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">經營團隊</h2>
      <div class="DataListBox">

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">黃嘉能</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">董事長 / 執行長 / 總經理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．發展、規劃、執行公司短、中、長期營運策略及計畫</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle hide">工作權責</div>
                <div class="DataListInfoItemText">．規劃公司重大投資之決策與開發新事業版圖 </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">黃俊勳</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">業務總經理暨導線架事業部主管</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．導線架及自動化設備事業部之業務推廣</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle hide">工作權責</div>
                <div class="DataListInfoItemText">．管理及督導各事業部業務績效</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">吳聲濤</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">台北分公司 / 總經理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．管理及督導台北分公司業務績效及行政部門事務執行</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">陳明軒</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">高分子材料事業部 / 協理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．負責高分子材料事業部之業務推廣</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">趙芝緯</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">高分子材料事業部 / 協理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．負責高分子材料事業部之業務推廣</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">蔣華文</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">基板事業部 / 協理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．負責基板事業部之業務推廣</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">陳子仁</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">新產品開發事業部 / 協理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．負責新產品開發事業部之業務推廣</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">張振榮</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">自動化設備事業部 / 協理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．負責自動化設備事業部之業務推廣</div>
              </li>
            </ul>
          </div>
        </div>

        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
          <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">陳美琴</div>
          <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
            <ul class="DataListInfoItemBox list-unstyled mb-0">
              <li class="DataListInfoItem">
                <div class="DataListInfoItemTitle">部門/職稱</div>
                <div class="DataListInfoItemText">財務及會計部 / 經理</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle ">工作權責</div>
                <div class="DataListInfoItemText">．財務、帳務及稅務規畫及執行</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle hide">工作權責</div>
                <div class="DataListInfoItemText">．合併報表作業之規劃與執行</div>
              </li>
              <li class="DataListInfoItem same">
                <div class="DataListInfoItemTitle hide">工作權責</div>
                <div class="DataListInfoItemText">．董事會、審計委員會及薪資報酬委員會議事之執行</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
