
<ul class="annualrptListBox d-flex align-items-center justify-content-start flex-wrap list-unstyled mb-0">
  @foreach($articleDownloads ?? [] as $key => $item)
  <li class="annualrptList defaultA" data-aos="fade-up" data-aos-duration="1000">
    <div class="annualrptListYear">{{array_get($item,'title')}}</div>
    <p class="annualrptListName">{{array_get($item,'sub_title')}}</p>


    @if(array_has($item,'file.0.path') && file_exists(public_path(array_get($item,'file.0.path'))))
    <a href="{{url(array_get($item,'file.0.path'))}}" class="annualrptListBtn defaultA d-flex align-items-center justify-content-center" download>
      <div>Download</div>
      <i class="icon_download"></i>
    </a>
    @endIf

    <div class="annualrptListIcon">
      <i class="icon_document"></i>
    </div>
  </li>
  @endForeach
</ul>
