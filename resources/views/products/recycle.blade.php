@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">商品回收站</h1>
     
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
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
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $products)
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
            <td>
                <div class='btn-group'>
                    <a href="{!! route('products.recover', [$products->id]) !!}" class='btn btn-default btn-xs'>恢复</a>
                </div>
            
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>
@endsection

