<table class="table table-responsive" id="orders-table">
    <thead>
        <tr>
            <th>编号</th>
            <th>价格</th>
            <th>支付状态</th>
            <th>店铺</th>
            <th>用户</th>
            <th>用户手机号</th>
            <th>日期</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{!! $order->no !!}</td>
            <td>{!! $order->price !!}</td>
            <td>{!! $order->status !!}</td>
            <td>{!! $order->shop->name !!}</td>
            <td>{!! $order->user->nickname !!}</td>
            <td><a href="/orders?uid={!! $order->user->id !!}">{!! $order->user->mobile !!} </a></td>
            <td>{!! $order->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!--a href="{!! route('orders.show', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a-->
                    <a href="{!! route('orders.edit', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗? 该操作不可回复')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>