
<section class="MainBox">
  <h2 class="MainTitle" data-aos="fade-up" data-aos-duration="1000">{{array_get($articleCategory,'title',trans('web.news.all'))}}</h2>
  <div class="newsContent">
    <div class="newsFilter d-flex align-items-center justify-content-end">
      <div class="FilterSel jsFilterSel" data-aos="fade-right" data-aos-duration="1000">
        <div class="FilterSelView">
          <div class="FilterSelViewText">{{array_get($articleCategory,'title',trans('web.news.all'))}}</div>
          <div class="FilterSelViewDecro">
            <i class="icon_selectTri"></i>
          </div>
        </div>
        <div class="FilterSelManu">
          <a href="{{route('web.page.web-news')}}" class="defaultA FilterSelManuBtn">
            <div class="FilterSelManuBtnText">@lang('web.news.all')</div>
          </a>

          @foreach($articleCategories ?? [] as $key => $item)
          <a href="{{route('web.page.web-news',['cls' => array_get($item,'path',array_get($item,'id'))])}}" class="defaultA FilterSelManuBtn">
            <div class="FilterSelManuBtnText">{{array_get($item,'title')}}</div>
          </a>
          @endForeach
        </div>
      </div>
    </div>


    @if(filled($topPost))
    <div class="ArticleMainBox" data-aos="fade-up" data-aos-duration="1000">
      <a href="{{route('web.page.web-news-post',['cls' => array_get($topPost,'articleCategories.0.path',array_get($topPost,'articleCategories.0.id')) , 'id' => array_get($topPost,'path', array_get($topPost,'id')) ])}}" class="ArticleMainPic defaultA">
        <img data-src="/static/web/styles/images/news/1.webp" class="defaultImg lazyload" alt="{{array_get($topPost,'title')}}">
      </a>
      <a href="{{route('web.page.web-news-post',['cls' => array_get($topPost,'articleCategories.0.path',array_get($topPost,'articleCategories.0.id')) , 'id' => array_get($topPost,'path', array_get($topPost,'id')) ])}}" class="ArticleMainInfo defaultA">
        <div class="ArticleMainInfoTop" data-aos="fade-left" data-aos-duration="800">
          <div class="ArticleMainInfoDate">{{array_get($topPost,'posted_at')->format('Y-m-d')}}</div>
          <div class="ArticleMainInfoKind">{{array_get($topPost,'articleCategories.0.title')}}</div>
        </div>
        <h3 class="ArticleMainInfoTitle" data-aos="fade-left" data-aos-duration="1200">{{array_get($topPost,'title')}}</h3>
        <div class="ArticleMainInfoDecro" data-aos="fade-left" data-aos-duration="1600"></div>
        <p class="ArticleMainInfoWord" data-aos="fade-left" data-aos-duration="1800">{{array_get($topPost,'description')}}</p>
        <div class="ArticleMainBtn" data-aos="fade-right" data-aos-duration="1800">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
    </div>
    @endIf

    <div class="ArticleDataBox">
      @foreach($articlePosts ?? [] as $key => $item)
      <a href="{{route('web.page.web-news-post',['cls' => array_get($item,'articleCategories.0.path',array_get($item,'articleCategories.0.id')) , 'id' => array_get($item,'path', array_get($item,'id')) ])}}" class="ArticleData defaultA" data-aos="fade-up" data-aos-duration="1000">
        <div class="ArticleDataTop">
          <div class="ArticleDataDate">
            <div class="ArticleDataDateY">{{array_get($item,'posted_at')->format('Y')}}</div>
            <div class="ArticleDataDateD">{{array_get($item,'posted_at')->format('m-d')}}</div>
          </div>
          <div class="ArticleDataKind">{{array_get($item,'articleCategories.0.title')}}</div>
        </div>
        <div class="ArticleDataImg">
          <img data-src="{{file_exists(public_path(array_get($item,'pic.0.path'))) ?  url(array_get($item,'pic.0.path')) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=' }}" alt="{{array_get($item,'title')}}" src="" class="defaultImg lazyload">
        </div>
        <p class="ArticleDataTitle">{{array_get($item,'title')}}</p>
        <div class="ArticleDataBtn">
          <i class="icon_arrowR1"></i>
        </div>
      </a>
      @endForeach


    {{--換頁--}}
    @include('web.layouts.components.pagination')


  </div>
</section>
