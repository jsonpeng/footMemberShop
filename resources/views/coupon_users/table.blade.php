<table class="table table-responsive" id="couponUsers-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>结束时间</th>
            <th>类型</th>
            <th>满额</th>
            <th>优惠金额</th>
            <th>折扣</th>
            <th>状态</th>
            <th>限制使用</th>
            <th>发放时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($couponUsers as $couponUser)
        <tr>
            <td>{!! $couponUser->name !!}</td> 
            <td>{!! mb_substr($couponUser->time_end,0,10) !!}</td>
            <td>{!! $couponUser->type !!}</td>
            <td>{!! $couponUser->base !!}</td>
            <td>@if($couponUser->type != '打折券'){!! $couponUser->given !!} @endif</td>
            <td>@if($couponUser->type == '打折券'){!! $couponUser->discount !!} @endif</td>
            <td>{!! $couponUser->status !!}</td>
            <td>{!! $couponUser->limit !!}</td>
            <td>{!! $couponUser->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['couponUsers.destroy', $couponUser->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('couponUsers.show', [$couponUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('couponUsers.edit', [$couponUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>