<?php
/**
 * Page route:about-location
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
        <section class="MainBox">
            <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">全球據點</h2>
            <div class="locationBlockBox">
                <div class="locationBlock" >
                    <h3 class="locationBlockTitle" data-aos="fade-left" data-aos-duration="1000">營業據點</h3>
                    <div class="DataListBox">
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">高雄總公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">811 高雄市楠梓區東七街16號6樓</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:886-7-3622663">886-7-362-2663</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">886-7-362-1490</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">台中營業所</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">427 台中市潭子區雅豐街109號</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:886-4-25354645">886-4-2535-4645</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">886-4-2535-4425</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">台北分公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">114 台北市內湖區港墘路221巷35號7樓</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:886-2-87510696">886-2-8751-0696</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">886-2-8751-0689</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="locationBlock" >
                    <h3 class="locationBlockTitle" data-aos="fade-left" data-aos-duration="1000">其他營業據點</h3>
                    <div class="DataListBox">
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">長華科技股份有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">811 高雄市楠梓區開發路24號</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:886-7-9628202">886-7-962-8202</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">886-7-962-8203</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">長華能源科技股份有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">114 台北市內湖區港墘路221巷35號7樓</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:886-2-87510696">886-2-8751-0696</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">886-2-8751-0689</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="locationBlock" >
                    <h3 class="locationBlockTitle" data-aos="fade-left" data-aos-duration="1000">海外營業據點</h3>
                    <div class="DataListBox">
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">SH ASIA PACIFIC PTE. LTD.</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord FontSub">10 Eunos Road 8, #05-04/05 Singapore Post Centre, Singapore 408600</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+65-69147908">+65-6914-7908</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">---</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">MALAYSIAN SH ELECTRONICS SDN. BHD.</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord FontSub">Lot 5,7 & 9, Jalan Ragum 15/17 40200 Shah Alam Selangor Darul Ehsan, Malaysia</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+60-3-55198140 ">+60-3-5519-8140 </a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">+60-3-5519-8110</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">蘇州興勝科半導體材料有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">215126 中國江蘇省蘇州工業園區龍潭路123號</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+86-512-62836501">+86-512-62836501</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">+86-512-62836511</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">成都興勝半導體材料有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">610041 中國四川省成都高新區新加坡工業園新園南二路7號</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+86-28-85155577">+86-28-85155577</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">+86-28-85180228</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">成都興勝新材料有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">611731 中國四川省成都高新區西部園區科新路8號西區6號廠房</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+86-28-87958880">+86-28-87958880</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">+86-28-87958581</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">長科實業(上海)有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">中國(上海)自由貿易試驗區富特北路207號2層E01室</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+86-21-52419000">+86-21-5241-9000</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">+86-21-5241-9100</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
                            <h4 class="DataListName mb-0" data-aos="fade-right" data-aos-duration="1500">上海長華新技電材有限公司</h4>
                            <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
                                <p class="DataListInfoWord ">200050 上海市長寧路1027號兆豐廣場21F-1</p>
                                <ul class="DataListInfoItemBox list-unstyled mb-0">
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">電話</div>
                                        <div class="DataListInfoItemText FontSub">
                                            <a href="tel:+86-21-52419000">+86-21-5241-9000</a>
                                        </div>
                                    </li>
                                    <li class="DataListInfoItem">
                                        <div class="DataListInfoItemTitle">傳真</div>
                                        <div class="DataListInfoItemText FontSub">+86-21-5241-9000</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

