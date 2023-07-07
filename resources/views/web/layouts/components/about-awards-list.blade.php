
<div class="awardsContent d-flex align-items-start justify-content-start flex-wrap">
  @foreach($articleBlocks ?? [] as $key => $item)
  <div class="awardsBlock" data-aos="fade-up" data-aos-duration="1000">
    <div class="awardsBlockImg">
      <img data-src="{{file_exists(public_path(array_get($item,'pic.0.path'))) ?  url(array_get($item,'pic.0.path')) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=' }}" class="defaultImg lazyload" src="" alt="{{array_get($item,'title')}}">
    </div>
    <h3 class="awardsBlockTitle">{{array_get($item,'title')}}</h3>
    <ul class="awardsBlockInfoBox list-unstyled mb-0">
      <li class="awardsBlockInfo">年度：{{array_get($item,'year')}}</li>
      <li class="awardsBlockInfo">公司：{{array_get($item,'company')}}</li>
    </ul>
  </div>
  @endForeach
</div>


{{--換頁--}}
@include('web.layouts.components.pagination')
