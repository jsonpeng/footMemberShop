<table class="table table-responsive" id="accountUsers-table">
    <thead>
        <tr>
        <th>单号</th>
        <th>用户昵称</th>
        <th>操作</th>
        <th>金额</th>
        <th>状态</th>
        <th>提交时间</th>
        <th>预计到账时间(一天后,可根据需求修改)</th>
        <th>银行卡信息</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($accountUsers as $accountUser)
        <tr>
            <td>{!! $accountUser->no !!}</td>
            <td>{!! $accountUser->user()->first()->nickname !!}</td>
            <td>{!! $accountUser->type !!}</td>
            <td>{!! $accountUser->price !!}</td>
            <td>@if($accountUser->type=='账户提现'){!! $accountUser->status !!}@else--@endif</td>
            <td>{!! $accountUser->created_at !!}</td>
            <td>@if($accountUser->type=='账户提现'){!! $accountUser->arrive_time !!}@else--@endif</td>
            <td>@if($accountUser->type=='账户提现')银行卡名称:{!! $accountUser->card_name !!}|卡号:{!! $accountUser->card_no !!}|开户手机号:{!! $accountUser->user_mobile !!}@else--@endif</td>
            <td>
                {!! Form::open(['route' => ['accountUsers.destroy', $accountUser->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('accountUsers.show', [$accountUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('accountUsers.edit', [$accountUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <!-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>