<?php
/**
 * Page route:about-relationship
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
            <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">關係企業</h2>
            <div class="reltContent">
                <div class="reltBlock">
                    <h3 class="reltBlockTopic" data-aos="fade-left" data-aos-duration="1000">IC封裝材料</h3>
                    <div class="DataTable1" data-aos="fade-up" data-aos-duration="1000">
                        <table>
                            <thead>
                            <tr>
                                <th>項目</th>
                                <th>主要產品</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fontWeight500">長華科技</td>
                                <td>製造IC導線架、Pre-Mold導線架、LED導線架</td>
                            </tr>
                            <tr>
                                <td class="fontWeight500">成都興勝半導體材料有限公司</td>
                                <td>製造IC導線架</td>
                            </tr>
                            <tr>
                                <td class="fontWeight500">成都興勝新材料有限公司</td>
                                <td>製造IC導線架</td>
                            </tr>
                            <tr>
                                <td class="fontWeight500">蘇州興勝科半導體材料有限公司</td>
                                <td>製造IC導線架</td>
                            </tr>
                            <tr>
                                <td class="fontWeight500">Malaysian SH Electronics Sdn. Bhd.</td>
                                <td>製造IC導線架</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="reltBlock">
                    <h3 class="reltBlockTopic" data-aos="fade-left" data-aos-duration="1000">通路商</h3>
                    <div class="DataTable1" data-aos="fade-up" data-aos-duration="1000">
                        <table>
                            <thead>
                            <tr>
                                <th>項目</th>
                                <th>主要產品</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fontWeight500">SH Asia Pacific Pte. Ltd.</td>
                                <td>製造IC導線架</td>
                            </tr>
                            <tr>
                                <td class="fontWeight500">長科實業(上海)有限公司</td>
                                <td>銷售IC、LED導線架</td>
                            </tr>
                            <tr>
                                <td class="fontWeight500">上海長華新技電材有限公司</td>
                                <td>銷售IC封裝材料及設備</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="reltBlock">
                    <h3 class="reltBlockTopic" data-aos="fade-left" data-aos-duration="1000">綠能產業</h3>
                    <div class="DataTable1" data-aos="fade-up" data-aos-duration="1000">
                        <table>
                            <thead>
                            <tr>
                                <th>項目</th>
                                <th>主要產品</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fontWeight500">長華能源科技股份有限公司</td>
                                <td>太陽能發電</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
