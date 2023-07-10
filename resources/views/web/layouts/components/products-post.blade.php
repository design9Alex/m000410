
<section class="productdtlContent">
  <div class="productdtlBriefBox d-flex align-items-start justify-content-center justify-content-lg-start flex-wrap flex-lg-nowrap">
    <div class="productdtlCarouselBox" data-aos="fade-right" data-aos-duration="1000">

      <div class="productdtlCarouselBtn disabled jsProductdtlCarouselBtn" data-kind="-1">
        <i class="icon_productCarouselUp"></i>
      </div>

      <div class="productdtlCarouselPicBox jsProductdtlCarousel">
        @foreach(array_get($articleIntro,'pic') as $key => $value)
        <div class="productdtlCarouselPic jsProductdtlCarouselPic @if($key == 0) active @endIf">
          <img data-src="{{file_exists(public_path(array_get($value,'path'))) ?  url(array_get($value,'path')) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=' }}" alt="{{array_get($articleIntro,'title')}}" class="defaultImg lazyload">
        </div>
        @endForeach
      </div>

      <div class="productdtlCarouselBtn jsProductdtlCarouselBtn" data-kind="1">
        <i class="icon_productCarouselDown"></i>
      </div>
    </div>
    <div class="productdtlMainPic" data-aos="zoom-in" data-aos-duration="1200">
      <img data-src="{{file_exists(public_path(array_get($articleIntro,'pic.0path'))) ?  url(array_get($articleIntro,'pic.0.path')) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII='}}" alt="{{array_get($articleIntro,'title')}}" class="defaultImg lazyload jsProductdtlMainPic">
    </div>
    <div class="productdtlBriefCont" data-aos="fade-left" data-aos-duration="1000">
      <p class="productdtlBriefKind mb-0">{{array_get($articleIntro,'articleCategories.0.title')}}</p>
      <h2 class="productdtlBriefTitle">{{array_get($articleIntro,'title')}}</h2>
      <ul class="productdtlBriefInfo list-unstyled jsBriefInfo">

        @foreach(explode("\n",array_get($articleIntro,'description')) as $key => $value )
          <li class="productdtlBriefInfoList">{{$value}}</li>
        @endForeach

      </ul>
      <a href="{{route('web.page.web-products',['cls' => array_get($articleIntro,'articleCategories.0.articleCategory.path',array_get($articleIntro,'articleCategories.0.articleCategory.id')),'cls2' => array_get($articleIntro,'articleCategories.0.path',array_get($articleIntro,'articleCategories.0.id'))])}}" class="productdtlBriefBtn defaultA">返回</a>
    </div>
  </div>
  <div class="productdtlIntroBox">
    <div class="productdtlTabBox text-center d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-duration="1200">
      <div class="productdtlTab jsProductdtlTab active" data-no="0">@lang('web.product.editor'){{--產品說明--}}</div>
      <div class="productdtlTab jsProductdtlTab" data-no="1">@lang('web.product.application'){{--應用產業--}}</div>
    </div>
    <div class="productdtlIntroContBox" data-aos="fade-up" data-aos-duration="1000">
      <div class="productdtlIntroCont jsProductdtlIntroCont active" data-no="0">
        <h3 class="fakeHidden">@lang('web.product.editor'){{--產品說明--}}</h3>
        {{array_get($articleIntro,'editor')}}
      </div>


      <div class="productdtlIntroCont jsProductdtlIntroCont" data-no="1">
        <h3 class="fakeHidden">@lang('web.product.application'){{--應用產業--}}</h3>
        {{array_get($articleIntro,'application')}}
      </div>
    </div>
    <div class="ArticledtlLinkBox" data-aos="zoom-in" data-aos-duration="1800">
      @if(filled($prev))
        <a href="{{route('web.page.web-products-post',[
            'cls' => array_get($prev,'articleCategories.0.articleCategory.path',array_get($prev,'articleCategories.0.articleCategory.id')) ,
            'cls2' => array_get($prev,'articleCategories.0.path',array_get($prev,'articleCategories.0.id')) ,
            'id' => array_get($prev,'id')
            ])}}" class="ArticledtlLinkGuide defaultA prev">
          <div class="ArticledtlLinkGuideDecro">
            <i class="icon_arrowL0"></i>
          </div>
          <div class="ArticledtlLinkGuideText">@lang('web.page.prev'){{--上一則--}}</div>
        </a>
      @endIf

      <a href="{{route('web.page.web-products',['cls' => array_get($articleIntro,'articleCategories.0.articleCategory.path',array_get($articleIntro,'articleCategories.0.articleCategory.id')),'cls2' => array_get($articleIntro,'articleCategories.0.path',array_get($articleIntro,'articleCategories.0.id'))])}}" class="ArticledtlLinkBack defaultA">@lang('web.page.back_list')</a>


        @if(filled($next))
        <a href="{{route('web.page.web-products-post',[
            'cls' => array_get($next,'articleCategories.0.articleCategory.path',array_get($next,'articleCategories.0.articleCategory.id')) ,
            'cls2' => array_get($next,'articleCategories.0.path',array_get($next,'articleCategories.0.id')) ,
            'id' => array_get($next,'id')
            ])}}" class="ArticledtlLinkGuide defaultA next">
          <div class="ArticledtlLinkGuideText">@lang('web.page.next'){{--下一則--}}</div>
          <div class="ArticledtlLinkGuideDecro">
            <i class="icon_arrowR0"></i>
          </div>
        </a>
        @endIf

    </div>
  </div>
</section>
