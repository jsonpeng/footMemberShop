<table class="table table-responsive" id="products-table">
    <thead>
        <tr>
        <th>商品名称</th>
        <th>所在分类</th>
        <th>封面图</th>
        <th>商品拼团价格</th>
        <th>商品原价</th>
        <th>拼团开始时间</th>
        <th>拼团结束时间</th>
        <th>最大团数量</th>
        <th>单个团最大参加人数</th>
        <th>状态</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $products)
    @if($products->deleted=='否')
        <tr>
            <td> <a href="/tuaninfos?product_name={!! $products->name !!}">{!! $products->name !!}</a> </td>
            <td>@foreach($products->cats()->get() as $name)<a href="/cats/{{$name->id}}/edit">{!! $name->name !!}</a>&nbsp;&nbsp;@endforeach</td>
            <td><img src="{!! $products->banner !!}" style="max-width: 100%; max-height: 100px; display: block;" /></td>
            <td>{!! $products->price !!}</td>
            <td>{!! $products->o_price !!}</td>
            <td>{!! $products->start_time !!}</td>
            <td>{!! $products->end_time !!}</td>
            <td>{!! $products->tuan_num !!} </td>
            <td>{!! $products->man_num !!} </td>
           <td>{!! $products->status==1?'下架':'上架' !!}</td> 
            <td>
                {!! Form::open(['route' => ['products.destroy', $products->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('products.show', [$products->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('products.edit', [$products->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除该商品吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
     @endif
    @endforeach
    </tbody>
</table>