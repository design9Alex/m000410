<nav class="BreadBox" data-aos="fade-left" data-aos-duration="900">
  <ol class="mb-0 list-unstyled d-flex align-items-center justify-content-start flex-wrap">

    @foreach($breadcrumbs ?? [] as $key => $item)
      @if($key == 0)
        <li>
          <a href="{{route('web.home')}}" class="BreadIcon defaultA">
            <i class="icon_home"></i>
          </a>
        </li>
      @elseIf(count($breadcrumbs) == ($key+1))
        <li>
          <div class="BreadText now">{{array_get($item,'title')}}</div>
        </li>
      @else
        <li>
          <a class="BreadText defaultA">{{array_get($item,'title')}}</a>
        </li>
      @endIf

      @If(($key+1) < count($breadcrumbs))
      <li class="middle">
        <i class="icon_arrowR2"></i>
      </li>
      @endIf
    @endForeach
  </ol>
</nav>
