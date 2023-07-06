<?php
/**
 * Page route:about-vision
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

  @include('web.templates.modules.breadcrumbs')

    <div class="OuterBox">
        <section class="MainBox editor">
            <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">使命與願景</h2>
            <div class="visionContent d-lg-flex align-items-lg-start justify-content-lg-between">
                <div class="visionMainPic" data-aos="fade-right" data-aos-duration="1000">
                    <img data-src="/static/web/styles/images/about/vision/main0.webp" class="defaultImg lazyload" alt="公司組織">
                </div>
                <div class="visionInfoBox" data-aos="fade-left" data-aos-duration="1000">
                    <div class="visionInfoBlock mission">
                        <h3 class="visionInfoBlockTitle">使命</h3>
                        <p class="visionInfoBlockText mb-0">掌握科技脈動、引進先進材料、提供客戶全方面解決方案、創造與客戶雙贏局面，並且秉持永續經營理念，造福員工、客戶與股東。</p>								</div>
                    <div class="visionInfoBlock vision">
                        <h3 class="visionInfoBlockTitle">願景</h3>
                        <p class="visionInfoBlockText mb-0">從代理IC封裝材料，結合子公司製造領域，發展出以封裝材料－基板的世界級之專業廠商。</p>								</div>
                    <div class="visionInfoBlock value">
                        <h3 class="visionInfoBlockTitle">核心價值</h3>
                        <p class="visionInfoBlockText mb-0">『誠信』最高標準職業操守，建立公司與供應商、客戶、員工之信實夥伴關係，達成互信、互惠、互利等多贏目標。</p>
                        <p class="visionInfoBlockText mb-0">『確實』貫徹公司政策，以積極負責態度執行業務開發，準時交貨、確實品管，追求完美的客戶滿意度。</p>
                        <p class="visionInfoBlockText mb-0">『專業』具備全方位服務技能，依據客戶需求，提供多元化、即時性之產品，並提供完備的技術諮詢服務。</p>
                        <p class="visionInfoBlockText mb-0">『創新』掌握市場動態與產品技術發展，為客戶尋求更有效的解決方案，成為產業領導廠商。</p>								</div>
                    <div class="visionInfoBlock quality">
                        <h3 class="visionInfoBlockTitle">品質政策</h3>
                        <p class="visionInfoBlockText mb-0">力求業界最高品質要求，提供客戶完整而優質產品</p>								</div>
                </div>
                <div class="visionMainBg">
                    <img data-src="/static/web/styles/images/about/vision/bg0.webp" class="defaultImg lazyload" alt="">
                </div>
            </div>
        </section>
    </div>
</main>
