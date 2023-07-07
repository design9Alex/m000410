
<div class="DataListBox">
  @foreach($articleBlocks ?? [] as $key => $item)
  <div class="DataList" data-aos="fade-up" data-aos-duration="1000">
    <div class="DataListName" data-aos="fade-right" data-aos-duration="1500">{{array_get($item,'title')}}</div>
    <div class="DataListInfo" data-aos="fade-right" data-aos-duration="1500">
      <ul class="DataListInfoItemBox list-unstyled mb-0">
        <li class="DataListInfoItem">
          <div class="DataListInfoItemTitle">@lang('web.about_management.department'){{--部門/職稱--}}</div>
          <div class="DataListInfoItemText">{{array_get($item,'department')}}</div>
        </li>

        @if(filled(array_get($item,'responsibilities')))
        @foreach(explode("\n",array_get($item,'responsibilities')) ?? [] as $key2 => $value2)
        <li class="DataListInfoItem same">
          <div class="DataListInfoItemTitle @if($key2 > 0) hide @endIf">@lang('web.about_management.responsibilities'){{--工作權責--}}</div>
          <div class="DataListInfoItemText">．{{$value2 ?? ''}}</div>
        </li>
        @endForeach
        @endIf

      </ul>
    </div>
  </div>
  @endForeach

</div>
