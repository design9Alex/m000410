
<div class="fnclmtlFilter d-flex align-items-center justify-content-end">
  <div class="FilterSel jsFilterSel" data-aos="fade-right" data-aos-duration="1000">
    <div class="FilterSelView">

      @if(filled($y))
        <div class="FilterSelViewText">{{$y}}</div>
      @else
        <div class="FilterSelViewText">@lang('web.financial_monthly.all'){{--All--}}</div>
      @endIf

      <div class="FilterSelViewDecro">
        <i class="icon_selectTri"></i>
      </div>
    </div>
    <div class="FilterSelManu">

      <a href="{{route('web.page.web-financial-monthly')}}" class="defaultA FilterSelManuBtn @if(empty($y)) active @endIf">
        <div class="FilterSelManuBtnText">@lang('web.financial_monthly.all')</div>
      </a>

      @foreach($articleIntros ?? [] as $key => $item)
        <a href="{{route('web.page.web-financial-monthly',['y' => array_get($item,'title')])}}" class="defaultA FilterSelManuBtn @if(!empty($y) && array_get($item,'title') == $y ) active @endIf">
          <div class="FilterSelManuBtnText">{{array_get($item,'title')}}</div>
        </a>
      @endForeach
    </div>
  </div>
</div>

<div class="DataTable2" data-aos="fade-up" data-aos-duration="1000">
  {!! array_get($articleIntro,'editor') !!}
</div>
