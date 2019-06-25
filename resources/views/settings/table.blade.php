<table class="table table-responsive" id="settings-table">
    <thead>
        <tr>
            <th>会员卡介绍</th>
            <th>会员卡价格</th>
            <th>会员卡图片</th>
            <th>当日消费次数(最大)</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($settings as $setting)
        <tr>
            <td>{!! $setting->card_intro !!}</td>
            <td>{!! $setting->card_num !!}</td>
            <td> <img src="{!! $setting->card_pic !!}" style="height: 50px; width: auto;">  </td>
            <td>{!! $setting->card_limit !!}</td>
            <td>
               
                <div class='btn-group'>
                    <a href="{!! route('settings.edit', [$setting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>