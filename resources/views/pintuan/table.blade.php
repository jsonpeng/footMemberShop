<table class="table table-responsive" id="pintuan-table">
    <thead>
        <tr>
        <th>商品名称</th>
        <th>商品价格</th>
        <th>当前人数</th>
        <th>参与的用户</th>
        <th>拼团总金额</th>
        
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>


    @foreach($products as $products)
    <tr>
        <td>{!! $products->name !!} </td>
        <td>{!! $products->price !!} </td>
        <td>{!! $products->join_user()->count() !!}</td>
        <td>@foreach($user_join as $user)<a href=""> </a>   @endforeach</td>
        <td>{!! ($products->join_user()->count())*($products->price) !!}</td>
     </tr>
     @endforeach
    </tbody>
</table>