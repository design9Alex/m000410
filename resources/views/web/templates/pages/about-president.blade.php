<?php
/**
 * Page route:about-president
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
        <div class="BreadText now">經營者的話</div>
      </li>
    </ol>
  </nav>
  --}}
  @include('web.templates.modules.breadcrumbs')

  <div class="OuterBox">
    <section class="MainBox editor">
      <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">經營者的話</h2>
      <div class="presdtBlockBox d-md-flex align-items-md-start justify-content-md-center">
        <div class="presdtBlock">
          <h3 class="presdtBlockTitle" data-aos="fade-right" data-aos-duration="1000">總裁的話</h3>
          <div class="presdtBlockImg" data-aos="fade-right" data-aos-duration="1000">
            <img data-src="/static/web/styles/images/about/president/person0.webp" alt="" class="defaultImg lazyload">
          </div>
          <p class="presdtBlockSlogan text-center" data-aos="fade-up" data-aos-duration="1000">成功絕非偶然   努力成就現在</p>
          <div class="presdtBlockWord">
            <div class="Para4 first" data-aos="fade-up" data-aos-duration="1000">
              <p>長華電材自1989年創立以來，以專業封裝材料及設備通路商起家，在半導體封裝業界耕耘至今已長達30年以上。憑藉著與扮演好客戶與供應商溝通橋樑角色，自2007年起，長華電材與合作夥伴日本住友礦山共同投資生產LCD驅動IC的薄膜覆晶(COF)捲帶式封裝材料。為尋求產能第二個出海口，轉投資台灣住礦、長華科技等投入LED導線架與封裝材料生產。</p>
              <p>從通路商延伸到製造業，封裝材料拓展到LCD、LED及消費性電子領域，長華集團的事業版圖逐步擴張，並非一步到位、立竿見影，而是經由眾多關鍵因素成就而來。</p>
            </div>
            <div class="presdtBlockWordBlockBox">
              <div class="presdtBlockWordBlock" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="presdtBlockWordBlockTitle">充分利用母公司的有效資源</h4>
                <p class="Para4">母公司長華電材從封裝材料代理起家，多年來不僅擁有一流的IC封裝工程人員，更有優質的合作夥伴支持，包括日本住友電木優異的封裝材料，日本住礦純熟的蝕刻及電鍍技術，日本山田精良的封裝製程設備、模具設計與製造能力。長華電材憑藉著對導線架原料及生產流程的熟悉，建立自有核心技術平台，讓長華科技在幾乎完美的時刻進入LED EMC導線架市場，幸運地拿下當時最火紅EMC導線架過半的市場佔有率。</p>
              </div>
              <div class="presdtBlockWordBlock" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="presdtBlockWordBlockTitle">台灣資本市場的支持</h4>
                <p class="Para4">長華集團也受惠於台灣資本市埸對小型企業的支持，使長華科技在短短的兩年時間內，於2016年順利上櫃掛牌，取得直接金融的管道和能力，得以儲備後續營運發展的實力。</p>
              </div>
              <div class="presdtBlockWordBlock" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="presdtBlockWordBlockTitle">充分運用母公司溝通管道</h4>
                <p class="Para4">日本半導體產業表現不盡理想，日本住友礦山淡出導線架市場，而長華電材與日本住友礦山有多年合作經驗，雙方一拍即成，由長華電材與長華科技分別出資，在無縫接軌的情況之下，順利取得日本住友礦山的五個日本海內外導線架工廠。長華科技不僅承接既有的IDM客戶，加上長華電材原有的封測客戶，具備完整的客戶出海口，為金屬導線架封裝領域帶來全新的應用與更具競爭力的產品。</p>
              </div>
              <div class="presdtBlockWordBlock" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="presdtBlockWordBlockTitle">展現自我創新能力</h4>
                <div class="Para4">
                  <p>長華科技不僅自己設計修改模具和機台，亦自行開發獨特的製程，包含精準的QFN半蝕刻技術以提升33%以上的生產效率，機械光罩式電鍍以取代80%原光阻式電鍍QFN，以及自行開發的Pre-Mold模壓製程，以提高附加價值。藉由重新創造導線架製造工藝，具備產業標準制定能力，以業界最高的製造效率滿足客戶需求。</p>
                  <p>儘管近三年來疫情對全球經濟產生多重影響，長華集團展現經營韌性，長華電材和長華科技全年營運皆刷新歷史新高紀錄，在疫情烏雲逐漸散去之際，期盼長華集團成員未來表現能夠再造巔峰。</p>
                </div>
              </div>
            </div>
          </div>
          <p class="presdtBlockWho text-end mb-0" data-aos="fade-right" data-aos-duration="1000">
            長華集團 總裁<span class="ColorMain">黃嘉能</span>
          </p>
        </div>
        <div class="presdtBlock">
          <h3 class="presdtBlockTitle" data-aos="fade-left" data-aos-duration="1000">副董事長的話</h3>
          <div class="presdtBlockImg" data-aos="fade-left" data-aos-duration="1000">
            <img data-src="/static/web/styles/images/about/president/person1.webp" alt="" class="defaultImg lazyload">
          </div>
          <div class="presdtBlockSlogan text-center" data-aos="fade-up" data-aos-duration="1000">
            <p>跨入前段材料 尋求併購機會 </p>
            <p>讓長華集團價值持續發光</p>
          </div>
          <div class="presdtBlockWord">
            <div class="Para4">
              <p data-aos="fade-up" data-aos-duration="1000">長華電材自1989 年成立以來，以專業的前瞻眼光與敏銳的市場嗅覺，適時、準確地導入日本住友培科、住友金屬礦山集團及多家國際知名大廠封裝材料與設備，滿足國內各封裝廠多元化需求，並贏得原廠及客戶一致的讚賞。</p>
              <p data-aos="fade-up" data-aos-duration="1000">2020年起，長華電材邁入第二個30年，為因應全球產業分工，強化整體競爭力，提高股東投資報酬率，長華電材的佈局策略，第一是切入新的半導體相關核心產業，掌握更多元的材料。長華電材以代理封裝材料起家，對封裝業務熟稔，從設備到材料皆是，未來代理版圖觸角將向前段延伸，比如晶圓級封裝相關材料，以期擴大長華電材在材料界的影響力。</p>
              <p data-aos="fade-up" data-aos-duration="1000">第二是深耕製造領域，適當時機尋求合作對象投資工廠，並參與經營，以掌握半導體相關材料或設備新的商機。過去長華電材曾執行購併住友工廠等重大投資案，在參與M&A及經營管理工廠深具經驗。更重要的一點，進行購併不可缺的是資金，集團財務健全、資金雄厚，亟具向外擴張的實力。未來長華集團轄下會有至少兩個主要的Business Unit（BU），一是製造或工業控股，另一個就是業務或貿易部門，集團計劃朝往投控模式發展。</p>
              <p data-aos="fade-up" data-aos-duration="1000">長華集團以成為國際性半導體材料專業行銷通路商，以及在半導體材料產業擁有規格制訂的話語權為目標，在提昇市場佔有率及擴大營收規模之際，亦將本著專業誠信、永續經營的原則，在全體員工群策群力及各位股東的支持下，繼續朝向追求股東、員工及客戶最大利益之路邁進。我們常說：「機會是給準備好的人。」面對未來商機與挑戰，長華集團已經準備好了！</p>
            </div>
          </div>
          <p class="presdtBlockWho text-end mb-0" data-aos="fade-right" data-aos-duration="1000">
            長華電材 副董事長<span class="ColorMain">洪全成</span>
          </p>
        </div>
      </div>
    </section>
  </div>
</main>
