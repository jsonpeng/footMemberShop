<table class="table table-responsive" id="shopConnects-table">
    <thead>
        <tr>
            <th>分店ID</th>
            <th>分店名称</th>
            <th>关联分店</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($shopConnects as $shopConnect)
        <tr>
            <td>{!! $shopConnect->shop_id !!}</td>
            <td>{!! $shopConnect->name !!}</td>
            <td>{!! $shopConnect->shop->name !!}</td>
            <td>
                {!! Form::open(['route' => ['shopConnects.destroy', $shopConnect->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!--a href="{!! route('shopConnects.show', [$shopConnect->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a-->
                    <a href="{!! route('shopConnects.edit', [$shopConnect->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>