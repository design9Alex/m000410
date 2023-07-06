<?php
/**
 * Page route:about-history
 *
 * @var string $local
 */
?>

<main>
  <div class="TopicBox">
    <div class="TopicBg">
      <picture>
        <source media="(max-width: 1200px)" srcset="/static/web/styles/images/about/topicBg_mobile.webp" width="1200" height="313" data-device="mobile">
        <source media="(max-width: 2048px)" srcset="/static/web/styles/images/about/topicBg_pc.webp" width="1920" height="500">
        <img class="defaultImg lazyload" data-src="/static/web/styles/images/about/topicBg.webp" alt="" width="3840" height="1000">
      </picture>
    </div>
    <h1 class="Topic">關於我們</h1>
  </div>

  {{---
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
        <div class="BreadText now">大事紀</div>
      </li>
    </ol>
  </nav>
  --}}
  @include('web.templates.modules.breadcrumbs')

  <div class="OuterBox">
    <section class="MainBox editor">
      <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">大事紀</h2>
      <div class="hstyImg" data-aos="zoom-in" data-aos-duration="1500">
        <img data-src="/static/web/styles/images/about/history/top0.webp" class="defaultImg lazyload" alt="">
      </div>
      <div class="hstyTimeBox d-md-flex align-items-md-start justify-content-md-between">
        <div class="hstyTimeYearBox" data-aos="fade-right" data-aos-duration="1000">
          <div class="hstyTimeYear jsHistoryYear" data-year="2020">2020 -</div>
          <div class="hstyTimeYear jsHistoryYear" data-year="2010">2010 -</div>
          <div class="hstyTimeYear jsHistoryYear" data-year="2000">2000 -</div>
          <div class="hstyTimeYear jsHistoryYear" data-year="1980">1980 -</div>
        </div>
        <div class="hstyTimeEvents jsHistoryTimeEvents" data-aos="fade-left" data-aos-duration="1000">
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="2020" data-kind="2020" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2022</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">黃嘉能董事長獲頒 2022《哈佛商業評論》台灣企業領袖 100 強</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">與日本住友合資新廠動土  擴大封膠樹酯產能</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">董事會決議處分子公司長華科技(股)公司部分持股，截至4月底止，本公司對長華科技(股)公司累積持有股數179,967,970股，持股比例48%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">首度冠名主辦高球公開賽</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2020" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2021</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">董事會決議取得新應材10.03%股權，聚焦半導體材料。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2020" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2020</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">董事會決議取得Silver Connection Co., Ltd. 30%股權，布局電接觸材料。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司將股票面額由每股新臺幣10元變更為新臺幣1元，並於2020年8月17日恢復交易，上市股數將由原63,879,937股變更為638,799,370股，資本額新臺幣6.39億元維持不變。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="2010" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2019</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司為強化在自動化生產設備市場之布局，擴大客戶服務範疇，將攜手天正國際精密機械(股)公司共同進軍被動元件、LED及半導體檢測設備市場，藉此擴大產品組合與客戶基礎，以求取最大的雙贏效益；雙方分階段展開策略合作，期能結合雙方產業資源、業務與技術優勢，進一步擴大產品組合與客戶基礎，以達到擴大營運規模、提升獲利之目的。本公司將視本合作案之後續業務發展需求，於必要時增加對天正國際精密機械(股)公司之持股。惟實際之投資方式及條件，應依照相關法定程序辦理。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司長華科技(股)公司將股票面額由每股新臺幣10元變更為新臺幣1元，並於2019年9月9日恢復交易，上櫃股數將由原36,413,105股變更為364,131,050股，資本額新臺幣3.64億元維持不變。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司及子公司長華科技(股)公司經股東常會決議通過修訂公司章程，盈餘分配改為每半年配息一次。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過總額度等值新臺幣72億元整之五年期聯合授信案，用以償還金融負債暨充實中期營運週轉金。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2018</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jul.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">「蘇州住礦電子有限公司」更名為「蘇州興勝科半導體材料有限公司」、「成都住礦電子有限公司」更名為「成都興勝半導體材料有限公司」、「成都住礦精密製造有限公司」更名為「成都興勝新材料有限公司」、「台灣住礦科技(股)公司」更名為「台灣興勝半導體材料(股)公司」。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2017</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司認購子公司長華科技(股)公司現金增資股票2,556千股，投資金額新台幣10.22億元。認購股權後，本公司對子公司長華科技(股)持股比例為45%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司為配合集團營運策略之考量，將本公司所持有之WSP Electromaterials Limited 100%股權轉讓予子公司SH Asia Pacific Pte. Ltd.。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司為配合集團營運策略之考量，將本公司所持有之SH Asia Pacific Pte. Ltd. 40%股權轉讓予子公司長華科技(股)公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司以新台幣9,000萬元投資成立長華能源科技(股)公司，持股比例100%，該公司主要係發展太陽能發電事業。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">為因應導線架產業發展趨勢及集團未來策略發展，本公司及子公司長華科技(股)公司以日幣150億元(折合新台幣41億元)向SH Materials Co., Ltd.購買其所持有SH Asia Pacific Pte. Ltd.全部股權，並間接取得其子公司（即Malaysian SH Electronics Sdn. Bhd.、蘇州住礦電子有限公司、成都住礦電子有限公司、成都住礦精密製造有限公司及台灣住礦科技(股)公司）股權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司及子公司長華科技(股)公司對SH Asia Pacific Pte. Ltd.持股比例分別為40%及60%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之子公司台灣住礦科技(股)公司與子公司長華科技(股)公司皆屬IC基板導線架之生產工廠，為整合二家子公司在台灣之生產基地以增加子公司市場競爭力。本公司將所持有之台灣住礦科技(股)公司30%股權轉讓予子公司長華科技(股)公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司認購子公司長華科技(股)公司現金增資股票1,987千股，投資金額新台幣4.9億元。認購股權後，本公司對子公司長華科技(股)公司持股比例為46%。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2015</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司How Weih International Ltd.與臺灣銀行等7家銀行簽訂美金23,700千元整聯合授信合約。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司大陸惠州偉特電機有限公司核准更名為惠州偉特電子有限公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司處分易華電子(股)公司計16,500,000股，持股比例從65.38%下降至47%，本公司對易華電子(股)公司已於民國104年6月30日喪失控制能力，是以將易華電子(股)公司自合併個體排除，列入採用權益法之投資。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之子公司CWE Holding Co., Ltd.董事會決議通過設立長華控股(開曼)(股)公司暨調整轉投資架構。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過變更對吳江斌茂光電有限公司之投資方式：
                      變更前：本公司 → CWE Holding Co., Ltd. → CWER Co., Ltd. → 吳江斌茂光電有限公司
                      變更後：本公司 → CWE Holding Co., Ltd. → 長華控股(開曼)(股)公司 → CWER Co., Ltd. → 吳江斌茂光電有限公司</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司How Weih International Ltd.董事會決議通過對大陸惠州偉特電機有限公司辦理現金增資美金670萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司How Weih International Ltd.董事會決議通過對大陸濠瑋電子科技(惠州)有限公司辦理現金增資美金300萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之子公司CWER CO., LTD.董事會決議通過對大陸吳江斌茂光電有限公司辦理現金增資美金300萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jan.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過認購子公司易華電子(股)公司現金增資10,142,867股，每股認購金額新台幣20元。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2014</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過認購長華科技(股)公司現金增資，預計認購5,500,000股為上限，每股認購價格新台幣50元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司How Weih International Ltd.董事會決議通過辦理現金增資美金670萬元，並經母公司濠瑋控股(開曼)(股)公司(持股比例100%)同日董事會決議全數認購。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司濠瑋控股(開曼)(股)公司董事會決議通過辦理現金增資新台幣21,000萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過處分重要子公司濠瑋控股(開曼)(股)公司部分股權7,000,000股。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過認購子公司易華電子(股)公司現金增資，預計認購33,540,000股為上限，每股面額新台幣10元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議處分大陸惠州偉特電機有限公司100%股權予本公司之重要子公司How Weih International Ltd.。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過處分重要子公司濠瑋控股(開曼)(股)公司部分股權5,710,000股。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司台灣住礦電子(股)公司更名為易華電子(股)公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Mar.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過對大陸惠州偉特電機有限公司辦理現金增資美金800萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Feb.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司How Weih International Ltd.董事會決議通過投資設立惠州濠瑋精密科技有限公司。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2013</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">董事會決議通過購買台灣住礦電子(股)公司70%股權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之重要子公司How Weih International Ltd.董事會決議通過辦理現金增資美金930萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過認購濠瑋控股(開曼)(股)公司現金增資新台幣2.142億元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">董事會決議向合益實業(亞洲)有限公司購買大陸惠州偉特電機有限公司100%股權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過對大陸惠州偉特電機有限公司辦理現金增資美金200萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司華德光電材料科技(股)公司及云輝科技(股)公司經雙方董事會決議通過收購案，華德光電材料科技(股)公司採股份轉換方式收購云輝科技(股)公司100%股權，並同時取得云輝科技(股)公司旗下轉投資公司Technew Holding Co., Ltd.、Prosper King Limited及廈門云輝興業材料科技有限公司百分之百股權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">董事會決議通過與持股達100%之子公司長伯科技(股)公司簡易合併，合併後本公司為存續公司，長伯科技(股)公司為消滅公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">台灣住礦電子(股)公司因其母公司進行集團業務重整，將台灣住礦電子(股)公司分割為台灣住礦電子(股)公司與台灣住礦科技(股)公司，本公司分別持股30%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過修正認購長華科技(股)公司現金增資，預計認購5,000,000股為上限，每股認購價格新台幣30元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司Beam Mode Optronics LLC董事會決議通過減資美金2,780,077.08元，減資比率11.14%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">取得濠瑋控股(開曼)(股)公司股權，持股比率90%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Jun.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司How Weih International Ltd.與臺灣銀行等12家銀行簽訂美金3,600萬元整聯合授信合約。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2012</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司董事會決議通過How Weih International Ltd.之股權架構重整，並設立濠瑋控股(開曼)(股)公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司華德光電材料科技(股)公司董事會通過經由WellsTech Optical Holding Co.,Ltd.認購Top Swiss Limited現金增資股份，並同時取得其大陸轉投資之華田光電(成都)有限公司50.82%股權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司云輝在大陸地區投資設立廈門云輝興業材料科技有限公司。			</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司間接透過子公司How Weih International Ltd.對濠瑋精密科技(深圳)有限公司辦理現金增資美金800萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司之子公司華德光電材料科技(股)公司經由Wellstech Optical Holding Co.,Ltd. 對Steadfast Enterprise Co., Ltd.及Golden Jo Corp.分別辦理現金增資美金440萬元及美金50萬元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">參與望隼科技(股)公司之現金增資，持股比率為42.95%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">與玉山商業銀行等9家銀行簽訂新台幣275,000萬元整聯合授信合約。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司華德光電材料科技(股)公司間接取得豐泰光電(深圳)有限公司及群億光電(深圳)有限公司100%股權。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2011</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司及子公司長伯科技(股)公司綜合持股達51%之之轉投資公司云輝科技(股)公司經董事會決議設立Technew Holding Co., Ltd.及 Prosper King Limited以完善投資架構。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">透過子公司How Weih International Ltd.以自有資金取得Hopeful (HK) Enterprise Holdings Limited100%股權，並間接取得濠鈺科技(深圳)有限公司100%股權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">成立第一屆審計委員會及薪資報酬委員會。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2010" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2010</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">轉投資云輝科技(股)公司，該公司主要係從事精密化學材料製造、電子零組件製造、工業助劑批發、其他化學製品批發、電子材料批發與零售及國際貿易之公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司濠瑋精密五金(深圳)有限公司更名為濠瑋精密科技(深圳)有限公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司轉讓濠瑋國際有限公司10%之增資後股權予該公司之子公司濠瑋精密科技(深圳)有限公司管理階層，本公司對濠瑋國際有限公司及濠瑋精密科技(深圳)有限公司累計持股比率由100%變更為90%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">核准發行國內第三次無擔保可轉換公司債，發行總額新台幣18億元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">參與長華科技(股)公司現金增資，持股比率由100%變更為51%。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="2000" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2009</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">轉投資長華科技(股)公司，該公司主要係從事工業用塑膠製品與電子零組件之製造及電子零組件與機械器具之零售與批發。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2008</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">因轉投資公司「華德光電材料科技(股)公司」為特定人韓國MNTech辦理現金增資，本公司持股比率由63.42%調降為48.67%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">透過由本公司百分之百轉投資Beam Mode Optronics LLC參與How Weih International Ltd.現金增資取得19%股權，並同時取得其大陸轉投資濠瑋精密五金(深圳)有限公司，該公司主要係從事新型電子製品、精密塑膠五金製品之研發、製造及銷售之公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">完成新台幣20億元五年期聯合授信案之簽約。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">參與成都住礦電子有限公司增資計畫，持股比率增為30%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">參與轉投資公司華德光電材料科技(股)公司之減資及現金增資計畫，持股比率增為63.42%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jul.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">子公司山田遠東尖端科技服務(股)公司更名為長伯科技(股)公司。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Feb.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">透過WSP Electromaterials Ltd.轉投資設立成都住礦精密製造有限公司。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2007</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">投資華德光電材料科技(股)公司，主要係生產製造光學膜。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">12月31日正式上市掛牌。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">投資華德光電材料科技(股)公司，主要係生產製造光學膜。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">12月31日正式上市掛牌。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2006</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Dec.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">發行國內第二次無擔保可轉換公司債，發行總額新台幣15億元。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Sep.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">增加對上海長華新技電材有限公司投資，持股比率增為69.375%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">與住友金屬礦山集團共同投資台灣住礦電子(股)公司，用於TCP/COF基板擴廠，本公司按持股比率30%投資。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2005</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jul.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司取得轉投資山田遠東尖端科技服務(股)公司股權40%，持股比率由60%上升至100%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">通過兩岸政府審查，於上海設立「上海長華新技電材有限公司」，為台商在中國第一家取得內外貿易權之公司。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2004</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">新設立CWE holding Co., Ltd.及CWER Co., Ltd.，投資架構為透過CWE holding Co., Ltd.間接投資CWER Co., Ltd.，持股比率100%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">本公司向Apic Yamada Corporation購入山田遠東尖端科技服務(股)公司800,000股，持股比率由20%增加為60%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">發行國內可轉換公司債新台幣6億元</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Feb.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">取得日本KYOCERA之覆晶基板材料台灣代理權。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2003</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">10月30日股票正式掛牌上櫃。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Feb.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">開始於興櫃市場交易。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2002</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">May.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">補辦公開發行。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2001</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">合併華友柏電氣材料(股)公司及華山新技(股)公司以擴大營業規模，提供封裝產業整體服務 (Total Solution)。並取得轉投資公司WSP Electromaterials Ltd.、台灣住礦電子(股)公司及山田遠東尖端科技服務(股)公司，持股比率分別為100%、30%及20%。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Oct.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">因合併取得 Apic Yamada Corportion 之自動封膠設備及剪腳整腳設備之代理權。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Feb.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">促成台住電子材料(股)公司 (Taiwan Sumiko Materials Co. Ltd.) 設立金線工廠，直接供應台灣市場需求。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="2000" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>2000</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Jul.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">代理銷售台灣住友培科(股)公司製造之封膠樹酯型材料。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="1980" data-kind="1980" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>1998</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Apr.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">促成台灣住友培科(股)公司 (Taiwan Sumitomo Bakelite Co. Ltd.) 在台灣生產環氧樹酯，直接供應台灣市場。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="1980" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>1994</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth ">Nov.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">促成Sumitomo Metal Mining Asia Pacific投資台灣住礦電子(股)公司在台設立導線架工廠，直接供應台灣市場需求。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="" data-kind="1980" data-aos="fade-up" data-aos-duration="1000">
            <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
              <div class="hstyTimeEventsBlockYearDecro"></div>
              <div>1989</div>
            </div>
            <div class="hstyTimeEventsBlockListBox">
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start ">
                <div class="hstyTimeEventsBlockListMonth ">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">長華電材(股)公司以資本額新台幣200萬元在台北成立，代理日本住友電木之封膠樹酯材料。</p>
                  </div>
                </div>
              </div>
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start last">
                <div class="hstyTimeEventsBlockListMonth hide">Aug.</div>
                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">代理住工(股)公司之封膠樹酯模封材料。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
