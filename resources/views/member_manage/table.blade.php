<table class="table table-responsive" id="memberManage-table">
    <thead>
        <tr>
            <th>姓名</th>
            <th>手机号</th>
            <th>状态</th>
            <th>注册时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($user as $users)
    @if(empty($users->mobile))
    @else
        <tr>
            <td><a href="/orders?uid={!! $users->id !!}">{!! $users->nickname !!}</a></td>
            <td><a href="/orders?uid={!! $users->id !!}">{!! $users->mobile !!}</a></td>
            <td>{!! $users->status !!}</td>
            <td>{!! $users->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['memberManage.destroy', $users->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
             
                    <a href="{!! route('memberManage.edit', [$users->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗? 该操作不可回复')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endif
    @endforeach
    </tbody>
</table>