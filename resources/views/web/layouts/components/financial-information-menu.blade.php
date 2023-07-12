<h3 class="Para1" data-aos="fade-up" data-aos-duration="1000">@lang('web.financial.financial_information'){{--財務摘要--}}</h3>
<div class="fnclrptWhenBox d-flex align-items-center justify-content-center" data-aos="flip-down" data-aos-duration="1000">
  <a href="?type=year" class="fnclrptWhen defaultA text-center @if(!request()->has('type') || (request()->has('type') && request()->get('type') == 'year')) active @endIf">@lang('web.financial.year'){{--年度--}}</a>
  <a href="?type=quarter" class="fnclrptWhen defaultA text-center @if(request()->has('type') && request()->get('type') == 'quarter') active @endIf">@lang('web.financial.quarter'){{--季度--}}</a>
</div>
<div class="fnclrptKindBox d-flex align-items-center justify-content-between justify-content-lg-center list-unstyled" data-aos="zoom-out" data-aos-duration="1000">
  <div class="fnclrptKindActBtn d-lg-none jsFnclrptKindActBtn" data-act="prev">
    <i class="icon_pageL"></i>
  </div>
  <nav class="fnclrptKindNav jsFnclrptKindInner">
    <ul class="fnclrptKindInner d-flex align-items-center justify-content-start justify-content-lg-center list-unstyled mb-0">
      <a href="{{route('web.page.web-financial-income-statement',['type' => 'year'])}}" class="fnclrptKind defaultA text-center @if(request()->url() == route('web.page.web-financial-income-statement')) active @endIf">@lang('web.financial.income_statement'){{--損益表--}}</a>
      <a href="{{route('web.page.web-financial-balance-sheet',['type' => 'year'])}}" class="fnclrptKind defaultA text-center @if(request()->url() == route('web.page.web-financial-balance-sheet')) active @endIf">@lang('web.financial.balance_sheet'){{--資產負債表--}}</a>
      <a href="{{route('web.page.web-financial-cash-flow',['type' => 'year'])}}" class="fnclrptKind defaultA text-center @if(request()->url() == route('web.page.web-financial-cash-flow')) active @endIf">@lang('web.financial.cash_flow'){{--現金流量表--}}</a>
      <a href="{{route('web.page.web-financial-share-data',['type' => 'year'])}}" class="fnclrptKind defaultA text-center @if(request()->url() == route('web.page.web-financial-share-data')) active @endIf">@lang('web.financial.share_data'){{--每股數據--}}</a>
      <a href="{{route('web.page.web-financial-important-ratio',['type' => 'year'])}}" class="fnclrptKind defaultA text-center @if(request()->url() == route('web.page.web-financial-important-ratio')) active @endIf">@lang('web.financial.important_ratio'){{--重要比率--}}</a>
      <a href="{{route('web.page.web-financial-products-proportion',['type' => 'year'])}}" class="fnclrptKind defaultA text-center @if(request()->url() == route('web.page.web-financial-products-proportion')) active @endIf">@lang('web.financial.products_proportion'){{--產品組合--}}</a>
    </ul>
  </nav>
  <div class="fnclrptKindActBtn d-lg-none jsFnclrptKindActBtn" data-act="next">
    <i class="icon_pageR"></i>
  </div>
</div>
