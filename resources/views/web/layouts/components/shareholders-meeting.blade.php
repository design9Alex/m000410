@if(filled($articleDownloads) && filled(array_get($articleDownloads,'0')))
  <div class="shareholderBlock">
    <h4 class="Para2 special" data-aos="fade-left" data-aos-duration="1000">{{array_get($articleDownloads,'0.title')}}</h4>
    <div class="DataTable" data-aos="fade-up" data-aos-duration="1000">
      <table>
        <tbody>
        <tr>
          <td>@lang('web.shareholders_meeting.date'){{--日期--}}</td>
          <td>{{array_get($articleDownloads,'0.new_meeting_at')->format('Y-m-d')}}({{getWeekday(array_get($articleDownloads,'0.new_meeting_at')->format('w'))}})</td>
        </tr>
        <tr>
          <td>@lang('web.shareholders_meeting.time'){{--時間--}}</td>
          <td>{{array_get($articleDownloads,'0.new_meeting_at')->format('H:i')}}</td>
        </tr>
        <tr>
          <td>@lang('web.shareholders_meeting.location'){{--會場--}}</td>
          <td>{{array_get($articleDownloads,'0.location')}}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
@endIf


@if(filled($articleDownloads) && filled(array_get($articleDownloads,'1')))
  <div class="shareholderBlock">
    <h4 class="Para2" data-aos="fade-left" data-aos-duration="1000">{{array_get($articleDownloads,'1.title')}}</h4>
    <div class="DataTable1 center" data-aos="fade-up" data-aos-duration="1000">
      <table>
        <thead>
        <tr>
          <th>@lang('web.shareholders_meeting.item'){{--項目--}}</th>
          <th>@lang('web.shareholders_meeting.download'){{--下載--}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>@lang('web.shareholders_meeting.meeting_1'){{--開會通知--}}</td>
          <td>

            @if(array_has($articleDownloads,'1.meeting_file_1.0.path') && file_exists(public_path(array_get($articleDownloads,'1.meeting_file_1.0.path'))))
            <a href="{{url(array_get($articleDownloads,'1.meeting_file_1.0.path'))}}" class="DownloadBtn defaultA" download>
              <i class="icon_download"></i>
            </a>
            @endIf
          </td>
        </tr>
        <tr>
          <td>@lang('web.shareholders_meeting.meeting_2'){{--議事手冊--}}</td>
          <td>
            @if(array_has($articleDownloads,'1.meeting_file_2.0.path') && file_exists(public_path(array_get($articleDownloads,'1.meeting_file_2.0.path'))))
              <a href="{{url(array_get($articleDownloads,'1.meeting_file_2.0.path'))}}" class="DownloadBtn defaultA" download>
                <i class="icon_download"></i>
              </a>
            @endIf
          </td>
        </tr>
        <tr>
          <td>@lang('web.shareholders_meeting.meeting_3'){{--主要股東名單--}}</td>
          <td>
            @if(array_has($articleDownloads,'1.meeting_file_3.0.path') && file_exists(public_path(array_get($articleDownloads,'1.meeting_file_3.0.path'))))
              <a href="{{url(array_get($articleDownloads,'1.meeting_file_3.0.path'))}}" class="DownloadBtn defaultA" download>
                <i class="icon_download"></i>
              </a>
            @endIf
          </td>
        </tr>
        <tr>
          <td>@lang('web.shareholders_meeting.meeting_4'){{--議事錄--}}</td>
          <td>
            @if(array_has($articleDownloads,'1.meeting_file_4.0.path') && file_exists(public_path(array_get($articleDownloads,'1.meeting_file_4.0.path'))))
              <a href="{{url(array_get($articleDownloads,'1.meeting_file_4.0.path'))}}" class="DownloadBtn defaultA" download>
                <i class="icon_download"></i>
              </a>
            @endIf
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
@endIf

@if(filled($articleDownloads) && filled(array_get($articleDownloads,'2')))
<div class="shareholderBlock">
  <h4 class="Para2" data-aos="fade-left" data-aos-duration="1000">@lang('web.shareholders_meeting.meeting_list'){{--歷年股東會資料--}}</h4>
  <div class="DataTable2" data-aos="fade-up" data-aos-duration="1000">
    <table>
      <thead>
      <tr>
        <th>@lang('web.shareholders_meeting.year'){{--年份--}}</th>
        <th>@lang('web.shareholders_meeting.meeting'){{--會議--}}</th>
        <th>@lang('web.shareholders_meeting.date'){{--日期--}}</th>
        <th>@lang('web.shareholders_meeting.meeting_2'){{--議事手冊--}}</th>
        <th>@lang('web.shareholders_meeting.meeting_1'){{--開會通知書--}}</th>
        <th>@lang('web.shareholders_meeting.meeting_4'){{--議事錄--}}</th>
      </tr>
      </thead>
      <tbody>
      @foreach($articleDownloads ?? [] as $key => $item)
      @if($key > 1)
      <tr>
        <td class="fontWeight700 FontSub">{{array_get($item,'new_meeting_at')->format('Y')}}</td>
        <td class="fontWeight500">{{array_get($item,'title')}}</td>
        <td class="FontSub">{{array_get($item,'new_meeting_at')->format('Y-m-d')}}</td>
        <td>
          @if(array_has($item,'meeting_file_2.0.path') && file_exists(public_path(array_get($item,'meeting_file_2.0.path'))))
            <a href="{{url(array_get($item,'meeting_file_2.0.path'))}}" class="DownloadBtn defaultA" download>
              <i class="icon_download"></i>
            </a>
          @endIf
        </td>
        <td>
          @if(array_has($item,'meeting_file_1.0.path') && file_exists(public_path(array_get($item,'meeting_file_1.0.path'))))
            <a href="{{url(array_get($item,'meeting_file_1.0.path'))}}" class="DownloadBtn defaultA" download>
              <i class="icon_download"></i>
            </a>
          @endIf
        </td>
        <td>
          @if(array_has($item,'meeting_file_4.0.path') && file_exists(public_path(array_get($item,'meeting_file_4.0.path'))))
            <a href="{{url(array_get($item,'meeting_file_4.0.path'))}}" class="DownloadBtn defaultA" download>
              <i class="icon_download"></i>
            </a>
          @endIf
        </td>
      </tr>
      @endIf
      @endForeach

      </tbody>
    </table>
  </div>
</div>
@endIf
