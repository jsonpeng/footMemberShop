<table class="table table-responsive" id="cardBuys-table">
    <thead>
        <tr>
            <th>Order Num</th>
        <th>Price</th>
        <th>Status</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cardBuys as $cardBuy)
        <tr>
            <td>{!! $cardBuy->order_num !!}</td>
            <td>{!! $cardBuy->price !!}</td>
            <td>{!! $cardBuy->status !!}</td>
            <td>{!! $cardBuy->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['cardBuys.destroy', $cardBuy->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('cardBuys.show', [$cardBuy->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('cardBuys.edit', [$cardBuy->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>