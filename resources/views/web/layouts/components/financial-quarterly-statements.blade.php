
<table>
  <thead>
  <tr>
    <th class="text-center" rowspan="2">年度</th>
    <th class="plus text-center" colspan="5">合併</th>
  </tr>
  <tr>
    <th class="special text-center">第一季</th>
    <th class="special text-center">第二季</th>
    <th class="special text-center">第三季</th>
    <th class="special text-center">第四季</th>
    <th class="special text-center">全年度</th>
  </tr>
  </thead>
  <tbody>
  @foreach($articleDownloads ?? [] as $key => $item)
  <tr>
    <td class="year fontWeight700">{{array_get($item,'title')}}</td>
    <td class="download">
      @if(array_has($item,'quarterly_statements_file_1.0.path') && file_exists(public_path(array_get($item,'quarterly_statements_file_1.0.path'))))
      <a href="{{url(array_get($item,'quarterly_statements_file_1.0.path'))}}" class="DownloadBtn defaultA" download>
        <i class="icon_download"></i>
      </a>
      @endIf
    </td>
    <td class="download">
      @if(array_has($item,'quarterly_statements_file_2.0.path') && file_exists(public_path(array_get($item,'quarterly_statements_file_2.0.path'))))
        <a href="{{url(array_get($item,'quarterly_statements_file_2.0.path'))}}" class="DownloadBtn defaultA" download>
          <i class="icon_download"></i>
        </a>
      @endIf
    </td>
    <td class="download">
      @if(array_has($item,'quarterly_statements_file_3.0.path') && file_exists(public_path(array_get($item,'quarterly_statements_file_3.0.path'))))
        <a href="{{url(array_get($item,'quarterly_statements_file_3.0.path'))}}" class="DownloadBtn defaultA" download>
          <i class="icon_download"></i>
        </a>
      @endIf
    </td>
    <td class="download">
      @if(array_has($item,'quarterly_statements_file_4.0.path') && file_exists(public_path(array_get($item,'quarterly_statements_file_4.0.path'))))
        <a href="{{url(array_get($item,'quarterly_statements_file_4.0.path'))}}" class="DownloadBtn defaultA" download>
          <i class="icon_download"></i>
        </a>
      @endIf
    </td>
    <td class="download">
      @if(array_has($item,'quarterly_statements_file_5.0.path') && file_exists(public_path(array_get($item,'quarterly_statements_file_5.0.path'))))
        <a href="{{url(array_get($item,'quarterly_statements_file_5.0.path'))}}" class="DownloadBtn defaultA" download>
          <i class="icon_download"></i>
        </a>
      @endIf
    </td>
  </tr>
  @endForeach
  </tbody>
</table>
