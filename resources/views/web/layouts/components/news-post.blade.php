
<section class="MainBox">
  <div class="ArticledtlBox">
    <div class="ArticledtlTop" data-aos="fade-down" data-aos-duration="1000">
      <div class="ArticledtlDate">{{array_get($articlePost,'posted_at')->format('Y-m-d')}}</div>
      <div class="ArticledtlKind">{{array_get($articlePost,'articleCategories.0.title')}}</div>
    </div>
    <h2 class="ArticledtlTitle" data-aos="fade-left" data-aos-duration="1000">{{array_get($articlePost,'title')}}</h2>

    {!! array_get($articlePost,'editor') !!}


    <div class="ArticledtlSocialBox d-flex align-items-center justify-content-start" data-aos="fade-left" data-aos-duration="1500">
      <div class="ArticledtlSocialFore">分享</div>
      <ul class="list-unstyled mb-0 d-flex align-items-center justify-content-start">
        <li class="ArticledtlSocial">
          <a href="javascript:void(0);" class="defaultA share-facebook">
            <i class="icon_facebook"></i>
          </a>
        </li>
        <li class="ArticledtlSocial">
          <a href="javascript:void(0);" class="defaultA share-line">
            <i class="icon_line"></i>
          </a>
        </li>
        <li class="ArticledtlSocial">
          <a href="javascript:void(0);" class="defaultA share-twitter">
            <i class="icon_twitter"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="ArticledtlLinkBox" data-aos="zoom-in" data-aos-duration="1800">

    @if(filled($prev))
    <a href="{{route('web.page.web-news-post',['cls' => array_get($prev,'articleCategories.0.path',array_get($prev,'articleCategories.0.id')) , 'id' => array_get($prev,'id') ])}}" class="ArticledtlLinkGuide defaultA prev">
      <div class="ArticledtlLinkGuideDecro">
        <i class="icon_arrowL0"></i>
      </div>
      <div class="ArticledtlLinkGuideText">@lang('web.page.prev'){{--上一則--}}</div>
    </a>
    @endIf

    <a href="{{route('web.page.web-news',['cls' => array_get($articlePost,'articleCategories.0.path',array_get($articlePost,'articleCategories.0.id')) ])}}" class="ArticledtlLinkBack defaultA">@lang('web.page.back_list'){{--返回列表--}}</a>

    @if(filled($next))
    <a href="{{route('web.page.web-news-post',['cls' => array_get($next,'articleCategories.0.path',array_get($next,'articleCategories.0.id')) , 'id' => array_get($next,'id') ])}}" class="ArticledtlLinkGuide defaultA next">
      <div class="ArticledtlLinkGuideText">@lang('web.page.next'){{--下一則--}}</div>
      <div class="ArticledtlLinkGuideDecro">
        <i class="icon_arrowR0"></i>
      </div>
    </a>
    @endIf
  </div>

</section>
