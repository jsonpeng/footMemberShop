<table class="table table-responsive" id="bankinfos-table">
    <thead>
        <tr>
        <th>用户昵称</th>
        <th>银行卡名称</th>
        <th>开户行</th>
        <th>姓名</th>
        <th>开户手机号</th>
        <th>银行卡号</th>
        <th>银行卡类型</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bankinfos as $bankinfo)
        <tr>
            <td>{!! $bankinfo->user()->first()->nickname !!}</td>
            <td>{!! $bankinfo->card_name !!}</td>
            <td>{!! $bankinfo->starthu !!}</td>
            <td>{!! $bankinfo->user_name !!}</td>
            <td>{!! $bankinfo->user_mobile !!}</td>
            <td>{!! $bankinfo->card_no !!}</td>
            <td>{!! $bankinfo->type !!}</td>
            <td>
                {!! Form::open(['route' => ['bankinfos.destroy', $bankinfo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bankinfos.show', [$bankinfo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bankinfos.edit', [$bankinfo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>