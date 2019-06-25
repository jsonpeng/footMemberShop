<table class="table table-responsive" id="counts-table">
    <thead>
        <tr>
            <th>用户</th>
            <th>卡号</th>
            <th>信息</th>
            <th>类型</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($counts as $count)
        <tr>
            <td>{!! $count->user->nickname !!}</td>
            <td>{!! $count->backup02 !!}</td>
            <td>{!! $count->info !!}</td>
            <td>{!! $count->type !!}</td>
            <td>
                {!! Form::open(['route' => ['counts.destroy', $count->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>