@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">会员管理</h1>
        <h1 class="pull-right">
         <!--   <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('memberManage.create') !!}">添加会员</a> -->
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>


      <div class="box box-default box-solid" style="margin-top:20px;">
            <div class="box-header with-border">
              <h3 class="box-title">查询</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <form id="form_search">
             
              <!--       <div class="form-group col-md-2">
                        <label for="type">条件</label>
                        <select class="form-control" name="type" style="padding:6px 10px;">
                            <option value="onedays>2">每天试图消费两次以上</option>
                            <option value="alldays>2">连续消费2天及以上</option>
                        </select>
                    </div> -->

                    <div class="form-group col-md-2">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control" name="name" placeholder="姓名" @if (array_key_exists('name', $input))value="{{$input['name']}}"@endif>
                    </div>

                       <div class="form-group col-md-2">
                        <label for="name">手机号</label>
                        <input type="text" class="form-control" name="mobile" placeholder="手机号"@if (array_key_exists('mobile', $input))value="{{$input['mobile']}}"@endif >
                    </div>

                        <div class="form-group col-md-2">
                        <label>状态</label>
                        <div class="row">
                            <div class="col-md-12">
                        <select class="form-control" name="status">
                        <option value="全部" @if (!array_key_exists('status', $input)) selected="selected" @endif>全部</option>
                            
                          <option value="开启"   @if(array_key_exists('status', $input) && $input['status']=='开启') selected="selected" @endif>开启</option>
                         <option value="禁止"   @if(array_key_exists('status', $input) && $input['status']=='禁止') selected="selected" @endif>禁止</option>
                             
                        </select>
                             </div>
                        </div>
                    </div>
      
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" onclick="search()">查询</button>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->


        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('member_manage.table')
            </div>
        </div>
          {!! $user->appends($all)->links()  !!}
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        function search() {
            window.location.href = "/zcjy/orders?"+$('#form_search').serialize();
        }


        // function search() {
        //     window.location.href = "/orders?"+$('#form_search').serialize();
        // }
    </script>
@endsection