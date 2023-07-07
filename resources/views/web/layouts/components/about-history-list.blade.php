<div class="hstyTimeBox d-md-flex align-items-md-start justify-content-md-between">

  <div class="hstyTimeYearBox" data-aos="fade-right" data-aos-duration="1000">
    @foreach($years as $key => $year)
      <div class="hstyTimeYear jsHistoryYear" data-year="{{$year}}">{{$year}} -</div>
    @endForeach
  </div>

  <div class="hstyTimeEvents jsHistoryTimeEvents" data-aos="fade-left" data-aos-duration="1000">
    @foreach($years ?? [] as $key => $year)
      @php $i = 0; @endphp
      @foreach(array_get($blocks,$year) ?? [] as $key2 => $itemYear)
        <div class="hstyTimeEventsBlock d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap jsHistoryYearBlock" data-year="@if($i == 0){{$year}}@endIf" data-kind="{{$year}}" data-aos="fade-up" data-aos-duration="1000">
          <div class="hstyTimeEventsBlockYear d-flex align-items-center justify-content-start">
            <div class="hstyTimeEventsBlockYearDecro"></div>
            <div>{{$key2}}</div>
          </div>
          <div class="hstyTimeEventsBlockListBox">
            @php $m = ''; @endphp
            @foreach($itemYear ?? [] as $key3 => $item3)
              <div class="hstyTimeEventsBlockList d-flex align-items-start justify-content-start @if($key3 == count($itemYear) - 1) last @endIf">
                @if(array_get($item3,'start_at')->format('M') != $m)
                  @php $m = array_get($item3,'start_at')->format('M'); @endphp
                  <div class="hstyTimeEventsBlockListMonth ">{{array_get($item3,'start_at')->format('M')}}{{--Sep.--}}</div>
                @else
                  <div class="hstyTimeEventsBlockListMonth hide">{{array_get($item3,'start_at')->format('M')}}</div>
                @endIf

                <div class="hstyTimeEventsBlockListDetailBox">
                  <div class="hstyTimeEventsBlockListDetail d-flex align-items-start justify-content-start">
                    <div class="decro">-</div>
                    <p class="content">{{array_get($item3,'title')}}</p>
                  </div>
                </div>
              </div>
              @php ++$i; @endphp
            @endForeach
          </div>
        </div>
        @endForeach
      @endForeach

  </div>
</div>
