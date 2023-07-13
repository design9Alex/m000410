<div class="fnclrptUnitBox d-flex align-items-center justify-content-between" data-aos="fade-up" data-aos-duration="1000">
  <p class="fnclrptUnit mb-0">@lang('web.financial.unit_5'){{--單位：百萬新台幣--}}</p>
</div>

{{--data-when="year"  data-when="quarter"--}}
<div class="fnclrptChartBox jsFnclrptChart" data-when="{{$type}}" data-kind="products_proportion" data-aos="fade-up" data-aos-duration="1000">
  <canvas id="jsFnclrptChartGraph"></canvas>
</div>


<div class="fnclrptYearBox d-flex align-items-start justify-content-start flex-wrap" data-aos="fade-up" data-aos-duration="1000">
  @if($type == 'quarter')
    @foreach($quarter as $key => $item)
      @if(is_numeric(mb_substr($key,0,2)))
      <div class="fnclrptYear jsFnclrptYear d-flex align-items-center justify-content-start">
        <input type="checkbox" id="financial{{$key}}" checked>
        <div class="fnclrptYearLabel jsFnclrptYearLabel">{{$key}}</div>
      </div>
      @endIf
    @endForeach
  @else
    @foreach($year as $key => $item)
    <div class="fnclrptYear jsFnclrptYear d-flex align-items-center justify-content-start">
      <input type="checkbox" id="financial{{$key}}" checked>
      <div class="fnclrptYearLabel jsFnclrptYearLabel">{{$key}}</div>
    </div>
    @endForeach
  @endIf
</div>

<div class="DataTable3 report0 {{$type}}" data-aos="fade-up" data-aos-duration="1000">
  <table>
    <thead>
    <tr>
      <th class="text-start">@lang('web.financial.item'){{--項目--}}</th>
      @if($type == 'quarter')
        @foreach($quarter ?? [] as $key => $item)
            <th class="jsFnclrptTh" data-year="{{$key}}">{{$key}}</th>
        @endforeach
      @else
        @foreach($year ?? [] as $key => $item)
          <th class="jsFnclrptTh" data-year="{{$key}}">{{$key}}</th>
        @endforeach
      @endIf
    </tr>
    </thead>
    <tbody>


    @if($type == 'quarter')
      @foreach($tableQuarter as $key => $item)
        <tr class="">
          <td class="title text-start fontWeight500 ">{{__('web.products_proportion.'.$key)}}</td>
          @foreach($item as $year => $value)
            @if(++$loop->index >= count($item) - 2)
              <td class="FontSub ColorDF2020 jsFnclrptTd" data-year="{{$year}}" data-index="{{ ++$loop->index}}">{{$value}}</td>
            @else
              <td class="FontSub jsFnclrptTd" data-year="{{$year}}" data-index="{{ ++$loop->index}}">{{$value}}</td>
            @endIf
          @endForeach
        </tr>
      @endForeach
    @else
      @foreach($tableYear as $key => $item)
        <tr class="">
          <td class="title text-start fontWeight500 ">{{__('web.products_proportion.'.$key)}}</td>
          @foreach($item as $year => $value)
          @if(++$loop->index == count($item))
            <td class="FontSub ColorDF2020 jsFnclrptTd" data-year="{{$year}}" data-index="{{ ++$loop->index}}">{{$value}}</td>
          @else
              <td class="FontSub jsFnclrptTd" data-year="{{$year}}" data-index="{{ ++$loop->index}}">{{$value}}</td>
          @endIf
          @endForeach
        </tr>
      @endForeach
    @endIf

    </tbody>
  </table>
</div>
