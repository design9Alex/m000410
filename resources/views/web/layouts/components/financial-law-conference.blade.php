
<div class="fnclmtlFilter d-flex align-items-center justify-content-end">
  <div class="FilterSel jsFilterSel" data-aos="fade-right" data-aos-duration="1000">
    <div class="FilterSelView">

      @if(filled($y))
        <div class="FilterSelViewText">{{$y}}</div>
      @else
        <div class="FilterSelViewText">@lang('web.financial_law_conference.all'){{--All--}}</div>
      @endIf

      <div class="FilterSelViewDecro">
        <i class="icon_selectTri"></i>
      </div>
    </div>
    <div class="FilterSelManu">
      <a href="{{route('web.page.web-financial-law-conference')}}" class="defaultA FilterSelManuBtn @if(empty($y)) active @endIf">
        <div class="FilterSelManuBtnText">@lang('web.financial_law_conference.all')</div>
      </a>

      @foreach($articleIntros ?? [] as $key => $item)
        <a href="{{route('web.page.web-financial-law-conference',['y' => array_get($item,'title')])}}" class="defaultA FilterSelManuBtn @if(!empty($y) && array_get($item,'title') == $y ) active @endIf">
          <div class="FilterSelManuBtnText">{{array_get($item,'title')}}</div>
        </a>
      @endForeach

    </div>
  </div>
</div>
<div class="DataTable2" data-aos="fade-up" data-aos-duration="1000">
  <table>
    <thead>
    <tr>
      <th class="text-center">@lang('web.financial_law_conference.date'){{--日期--}}</th>
      <th class="text-center">@lang('web.financial_law_conference.title'){{--標題--}}</th>
      <th class="text-center">@lang('web.financial_law_conference.download'){{--下載--}}</th>
      <th class="text-center">@lang('web.financial_law_conference.movie_download'){{--影音下載--}}</th>
    </tr>
    </thead>
    <tbody>

    @foreach(array_get($downloads,$y) ?? [] as $key => $item)
    <tr>
      <td class="date FontSub">{{array_get($item,'created_at')->format('Y-m-d')}}</td>
      <td class="fontWeight500 text-start">{{array_get($item,'title')}}</td>
      <td class="same">
        @if(array_has($item,'file.0.path') && file_exists(public_path(array_get($item,'file.0.path'))))
        <a href="{{url(array_get($item,'file.0.path'))}}" class="DownloadBtn defaultA" download>
          <i class="icon_download"></i>
        </a>
        @endIf
      </td>
      <td class="same">
        @if(array_has($item,'movie_file.0.path') && file_exists(public_path(array_get($item,'movie_file.0.path'))))
        <a href="{{url(array_get($item,'movie_file.0.path'))}}" class="DownloadBtn defaultA" download>
          <i class="icon_video"></i>
        </a>
        @endIf
      </td>
    </tr>
    @endForeach
    </tbody>
  </table>
</div>
