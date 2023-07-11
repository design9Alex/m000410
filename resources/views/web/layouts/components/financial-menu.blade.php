
<ul class="TabMenu list-unstyled mb-0 jsTabMenu">
  @foreach(array_get($financialMenu,'systemMenus') ?? [] as $key => $item)
  <li class="TabBtn {{--active--}} @if('/'.request()->route()->uri() == $item->url) active @endIf">
    <a href="{{array_get($item,'url')}}" class="defaultA">
      {{array_get($item,'title')}}
    </a>
  </li>
  @endForeach
</ul>
