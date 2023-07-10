
<section class="productsContent">
  <form class="productsFilter d-flex align-items-center justify-content-start flex-wrap flex-md-nowrap" action="{{route('web.page.web-products')}}" method="GET">
    <input type="hidden" name="cls" id="cls" value="{{$cls}}">
    <input type="hidden" name="cls2" id="cls2" value="{{$cls2}}">

    <div class="FilterSel style1 jsFilterSel" data-aos="fade-left" data-aos-duration="1000">
      <div class="FilterSelView">
        <div class="FilterSelViewText jsFilterSelVewText">{{array_get($category,'title')}}</div>
        <div class="FilterSelViewDecro">
          <i class="icon_selectTri"></i>
        </div>
      </div>

      <div class="FilterSelManu">
        @foreach(array_get($articleCategory,'articleCategories') ?? [] as $key => $item)
        <div class="selectOption categorySelect FilterSelManuBtn jsFilterMenuBtn @if(array_get($item,'id') == $cls) active @endIf" data-value="{{array_get($item,'id')}}">
          <div class="FilterSelManuBtnText">{{array_get($item,'title')}}</div>
        </div>
        @endForeach
      </div>

    </div>

    <div class="FilterSel style1 last jsFilterSel" data-select="nKind" data-aos="fade-left" data-aos-duration="1000">
      <div class="FilterSelView">
        <div class="FilterSelViewText jsFilterSelVewText" id="secCategoryFirstOption">{{array_get($secCategory,'title')}}</div>
        <div class="FilterSelViewDecro">
          <i class="icon_selectTri"></i>
        </div>
      </div>
      <div class="FilterSelManu" id="secCategorySelect">
        @foreach(array_get($category,'articleCategories') ?? [] as $key => $item)
          <div class="selectOption secCategorySelect FilterSelManuBtn @if(array_get($item,'id') == $cls2) active @endIf jsFilterMenuBtn" data-value="{{array_get($item,'id')}}" data-title="{{array_get($item,'title')}}">
            <div class="FilterSelManuBtnText">{{array_get($item,'title')}}</div>
          </div>
        @endForeach

      </div>
    </div>
    <div class="FilterSearch" data-aos="fade-right" data-aos-duration="1000">
      <input type="text" placeholder="請輸入產品名稱" id="product_keyword" name="product_keyword" value="{{$product_keyword}}">
      <button type="submit" class="FilterSearchBtn defaultButton">
        <i class="icon_search"></i>
      </button>
    </div>
  </form>

  <div class="productsInner">
    <h2 class="productsTopic" data-aos="fade-up" data-aos-duration="1000">{{array_get($secCategory,'title')}}</h2>
    <div class="productsListBox d-flex align-items-stretch justify-content-start flex-wrap">
      @foreach($articleIntros ?? [] as $key => $item)
      <a href="{{route('web.page.web-products-post',[
  'cls' => array_get($item,'articleCategories.0.articleCategory.path',array_get($item,'articleCategories.0.articleCategory.id')),
  'cls2' => array_get($item,'articleCategories.0.path',array_get($item,'articleCategories.0.id')),
  'id' => array_get($item,'path',array_get($item,'id'))
  ])}}" class="productsList defaultA d-flex align-items-center justify-content-start" data-aos="fade-up" data-aos-duration="3000">
        <div class="productsListPic">
          <img data-src="{{file_exists(public_path(array_get($item,'pic.0.path'))) ?  url(array_get($item,'pic.0.path')) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=' }}" class="defaultImg lazyload" alt="{{array_get($item,'title')}}">
        </div>
        <div class="productsListWord">
          <h3 class="productsListTitle">{{array_get($item,'title')}}</h3>
          <div class="productsListDecro"></div>
          <p class="productsListInfo">{{array_get($item,'notes')}}</p>
          <p class="productsListPro">@lang('web.products.scale'){{array_get($item,'scale')}}{{--營收佔比:--}}</p>
          <div class="productsListBtn">
            <i class="icon_arrowR0"></i>
          </div>
        </div>
      </a>
      @endForeach
    </div>

    {{--換頁--}}
    @include('web.layouts.components.pagination')

  </div>
</section>
