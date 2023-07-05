<header class="jsHeader">
  <div class="headerTop d-flex align-items-start justify-content-end">
    <a href="{{route('web.home')}}" class="headerLogo defaultA">
      <img data-src="{{asset('/static/web/styles/static/logo0.svg')}}" alt="長華電材Logo" width="150" height="85" class="defaultImg lazyload">
      <img data-src="{{asset('/static/web/styles/static/logo1.svg')}}" alt="長華電材Logo" width="106" height="59" class="defaultImg lazyload">
    </a>
    <div class="menuBox d-xl-flex align-items-xl-start justify-content-xl-start jsMenuBox">
      <div class="langBox d-flex align-items-center justify-content-center ">
        <a class="langBtn defaultA tw active" href="{{route('web.home')}}">繁中</a>
        <a class="langBtn defaultA" href="{{route('web.home')}}">ENG</a>
      </div>
      <nav class="menuInner">
        <ul class="d-xl-flex align-items-xl-stretch justify-content-xl-between list-unstyled mb-0">
          @foreach ($headerMenus as $systemMenu)
            @php $requestUrl = Request::url(); @endphp
            <li class="menuBlock @if(array_get($systemMenu,'code') == 'web-header-contact' || array_get($systemMenu,'code') == 'web-header-staff') jsMenuSubOther @endIf  d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">{{array_get($systemMenu,'title')}}</div>

              @if(array_get($systemMenu,'code') != 'web-header-contact' && array_get($systemMenu,'code') != 'web-header-staff')
              <div class="menuTopicDecro"></div>
              @endIf

            </div>
                <ul class="menuSub list-unstyled jsMenuSub">
                  @if($systemMenu->code === 'web-header-news')
                    <li>
                      <a href="{{route('web.page.web-news')}}" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                        <div class="menuSubText">全部消息</div>
                        <i class="icon_arrowR3"></i>
                      </a>
                    </li>
                    @foreach($newsCategories ?? [] as $key => $item)
                    <li>
                      <a href="{{route('web.page.web-news',['cls' => array_get($item,'path',array_get($item,'id'))])}}" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                        <div class="menuSubText">{{array_get($item,'title')}}</div>
                        <i class="icon_arrowR3"></i>
                      </a>
                    </li>
                    @endForeach
                  @elseif($systemMenu->code === 'web-header-products')
                    @foreach($productsCategories ?? [] as $key => $item)
                    <li>
                      <a href="{{route('web.page.web-products',['cls' => array_get($item,'path',array_get($item,'id'))])}}" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                        <div class="menuSubText">{{array_get($item,'title')}}</div>
                        <i class="icon_arrowR3"></i>
                      </a>
                    </li>
                    @endForeach
                  @else
                    @foreach(array_get($systemMenu,'systemMenus') ?? [] as $subSystemMenu)
                    <li>
                      <a href="{{ $subSystemMenu->url ?? 'javascript:void(0)' }}" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                        <div class="menuSubText">{{ $subSystemMenu->title }}</div>
                        <i class="icon_arrowR3"></i>
                      </a>
                    </li>
                    @endForeach
                  @endIf

            </ul>

          </li>
          @endForeach

          {{--
          <li class="menuBlock  d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">新聞中心</div>
              <div class="menuTopicDecro"></div>
            </div>
            <ul class="menuSub list-unstyled jsMenuSub">
              <li>
                <a href="news.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">全部消息</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="news.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">新聞消息</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="news.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">活動消息</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="menuBlock  d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">產品與服務</div>
              <div class="menuTopicDecro"></div>
            </div>
            <ul class="menuSub list-unstyled jsMenuSub">
              <li>
                <a href="products.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">產品</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="products.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">應用領域</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="products.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">代理品牌</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="menuBlock  d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">投資人關係</div>
              <div class="menuTopicDecro"></div>
            </div>
            <ul class="menuSub list-unstyled jsMenuSub">
              <li>
                <a href="financial.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">財務資訊</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="shareholders-Meeting.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">股東專區</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="corporate-Overview.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">公司治理</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="investor_service.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">投資人服務窗口</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="menuBlock  d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">企業永續</div>
              <div class="menuTopicDecro"></div>
            </div>
            <ul class="menuSub list-unstyled jsMenuSub">
              <li>
                <a href="stakeholder.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">利害關係人專區</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
              <li>
                <a href="csr_activities.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">CSR活動報導</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="menuBlock jsMenuSubOther d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">聯絡我們</div>
            </div>
            <ul class="menuSub list-unstyled jsMenuSub">
              <li>
                <a href="contact.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" >
                  <div class="menuSubText">客戶服務表單</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
            </ul>
          </li>
          <li class="menuBlock jsMenuSubOther d-xl-flex align-items-xl-start justify-content-xl-center flex-xl-column jsMenuBlock">
            <div class="menuTopic defaultA d-flex align-items-center justify-content-between justify-content-xl-center jsMenuTopic">
              <div class="menuTopicText">員工專區</div>
            </div>
            <ul class="menuSub list-unstyled jsMenuSub">
              <li>
                <a href="staff_login.php" class="menuSubList defaultA  d-flex align-items-center justify-content-between justify-content-xl-center jsMenuSubHref" target="blank">
                  <div class="menuSubText">員工專區登入</div>
                  <i class="icon_arrowR3"></i>
                </a>
              </li>
            </ul>
          </li>
          --}}

        </ul>
      </nav>
      <div class="menuLinkBox">
        <a href="staff_login.php" class="menuLink defaultA d-flex align-items-center justify-content-between">
          <div class="menuLinkText">員工專區</div>
          <div class="menuLinkIcon">
            <i class="icon_user"></i>
          </div>
        </a>
        <a href="contact.php" class="menuLink defaultA contact d-flex align-items-center justify-content-between">
          <div class="menuLinkText">聯絡我們</div>
          <div class="menuLinkIcon">
            <i class="icon_mail0"></i>
          </div>
        </a>
      </div>
    </div>
    <button class="headerSearch defaultA defaultButton jsHeaderSearchBtn" type="button">
      <i class="icon_search"></i>
    </button>
    <button class="headerMenuBtn defaultButton d-xl-none jsMenuBtn" type="button">
      <i class="icon_menuBtn"></i>
      <i class="icon_menuClose"></i>
    </button>
  </div>
  <form class="headerSearchBox jsHeaderSearchBox" action="search_result.php">
    <div class="headerSearchInner">
      <div class="headerSearchField d-flex align-items-center justify-content-between">
        <input type="text" placeholder="搜尋">
        <button type="submit" class="headerSearchBtn defaultButton">
          <i class="icon_search"></i>
        </button>
      </div>
      <button type="button" class="headerSearchClose defaultButton headerSearchBtnClose">
        <i class="icon_menuClose"></i>
      </button>
    </div>
  </form>
</header>
