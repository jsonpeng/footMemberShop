<table class="table table-responsive" id="shops-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>店铺ID</th>
            <th>会员卡价格</th>
            <th>消费限制次数</th>
         <!--    <th>会员卡图片</th>
            <th>会员卡说明</th> -->

            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($shops as $shop)
        <tr>
            <td>{!! $shop->name !!}</td>
            <td>{!! $shop->shop_id !!}</td>
            <td>{!! $shop->card_price !!}</td>
            <td>{!! $shop->card_limit !!}</td>
          
            <td>
                {!! Form::open(['route' => ['shops.destroy', $shop->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!--a href="{!! route('shops.show', [$shop->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a-->
                    <a href="{!! route('shops.edit', [$shop->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
