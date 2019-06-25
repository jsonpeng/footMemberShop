<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('商品名称', '商品名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
 <div class="form-group col-sm-12">{!! Form::label('tags', '所在分类:') !!}</div>
    <div class="form-group " >


    @if(count($cats)==0)
     <div class=" col-sm-12">
       <a href="{!! route('cats.create') !!}" class="btn btn-primary">创建分类</a>
     </div>
    @endif

        @foreach ($cats as $cats)
            <div class=" col-sm-12">
                <label>
                    {!! Form::checkbox('cats[]',$cats->id, in_array($cats->id, $selectedcats), ['class' => 'field minimal']) !!}
                    {!! $cats->name !!}
                </label></br>
            </div>
        @endforeach
    </div>

<!-- Banner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('封面图', '封面图:') !!}
               {!! Form::text('banner', null, ['class' => 'form-control', 'id' =>'image_min']) !!}
                       <a data-toggle="modal" href="javascript:;" data-target="#myModal_min" class="btn" type="button" >更改</a>
     <div class="input-append">
                          @if($products)  
                          <img src="{{$products->banner}}" class="images"  />
                       @endif
    </div>
</div>

<div class="form-group col-sm-6">
      {!! Form::label('更多封面图(请添加商品后添加)', '更多封面图(请添加商品后添加):') !!}
      <div class="input-appends">
                        {!! Form::text('banners', null, ['class' => 'form-control', 'id' =>'product_image','style'=>'display:none;']) !!}
                        {!! Form::text('id', null, ['class' => 'form-control', 'id' => 'product_id','style'=>'display:none;']) !!}
                         
                         <a data-toggle="modal" href="javascript:;" data-target="#myModal_product" class="btn" type="button" onclick="productimage('product_image')">添加</a>
                      
                        @if($products)  
                        @if(!empty($products->image()->get()))
                        @foreach($products->image()->get() as $images)
                        <div class="image-item" id="product_image_{!! $images->id !!}">
                        <img src="{!! $images->url !!}"  />
                        <div><div class='btn btn-danger btn-xs' onclick='deletePic({!! $images->id !!})'>删除</div></div>
                        </div>
                        @endforeach
                        @endif
                         @endif
                        
                    </div>
</div>



<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '商品拼团价格:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('o_price', '商品原价:') !!}
    {!! Form::text('o_price', null, ['class' => 'form-control']) !!}
</div>
<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', '拼团开始时间:') !!}
    {!! Form::text('start_time', null, ['class' => 'form-control','id'=>'create_start']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('end_time', '拼团结束时间:') !!}
    {!! Form::text('end_time', null, ['class' => 'form-control','id'=>'create_end']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status', ['0' => '上架', '1' => '下架'], null, ['class' => 'form-control']) !!}
</div>

<!-- Tuan Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tuan_num', '最大团数量:') !!}
    {!! Form::text('tuan_num', null, ['class' => 'form-control']) !!}
</div>

<!-- Man Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('man_num', '单个团最大参加人数:') !!}
    {!! Form::text('man_num', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('img_content', '商品图文:') !!}
    {!! Form::textarea('img_content', null, ['class' => 'form-control intro']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">取消</a>
</div>
