<?php
/**
 * @var integer $total
 * @var integer $current
 * @var string $routeName
 * @var array $routeParameters
 */
?>


@if ($total > 1)
<ul class="PageBox list-unstyled mb-0" data-aos="zoom-in" data-aos-duration="1000">

  <li class="PageBtn updown {{--disabled--}} @if($current == 1) disabled @endIf">
    <a href="{{ route($routeName, array_merge($routeParameters, ['page' => $current - 1])) }}" class="defaultA">
      <i class="icon_pageL"></i>
    </a>
  </li>

  @for($i = 5 * (intval(ceil($current / 5)) - 1) + 1; $i <= min(5 * intval(ceil($current / 5 )), $total);$i++)
  <li class="PageBtn {{ $current == $i ? 'active' : '' }}">
    <a href="{{ route($routeName, array_merge($routeParameters, ['page' => $i])) }}" class="defaultA">
      <div class="PageBtnNum">{{ $i }}</div>
    </a>
  </li>
  @endfor


  <li class="PageBtn updown  @if($current == $total) disabled @endIf">
    <a href="{{ route($routeName, array_merge($routeParameters, ['page' => $current + 1])) }}" class="defaultA">
      <i class="icon_pageR"></i>
    </a>
  </li>

</ul>
@endif
