@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">会员卡</h1>
        <h1 class="pull-right">
           <!--a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('memberCards.create') !!}">Add New</a-->
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
            
                    <div class="form-group col-md-4">
                        <label>根据起止时间</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_start" id="create_start" placeholder="开始时间"  @if (array_key_exists('create_start', $input)) value="{{$input['create_start']}}" @endif>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_end" id="create_end" placeholder="结束时间" @if (array_key_exists('create_end', $input)) value="{{$input['create_end']}} "@endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label>手机号</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="手机号" @if (array_key_exists('mobile', $input))value="{{$input['mobile']}}"@endif>
                    </div>


                    <div class="form-group col-md-2">
                        <label>根据分店</label>
                        <div class="row">
                            <div class="col-md-12">
                        <select class="form-control" name="fendian">
                            <option value="全部" @if (!array_key_exists('fendian', $input)) selected="selected" @endif>全部</option>
                            
                            @foreach($shop as $shops)
                          <option value="{!! $shops->name !!}" id="{{$shopname=$shops->name}}"  @if(array_key_exists('fendian', $input) && $input['fendian']==$shopname) selected="selected" @endif>{!! $shops->name !!}</option>
                            @endforeach
                             
                        </select>
                             </div>
                        </div>
                    </div>


                     <div class="form-group col-md-2">
                        <label>条件</label>
                        <div class="row">
                            <div class="col-md-12">
                        <select class="form-control" name="status">
                            <option value="全部"   @if (!array_key_exists('status', $input)) selected="selected" @endif>全部</option>
                            <option value="已过期" @if(array_key_exists('status', $input) && $input['status']=='已过期') selected="selected" @endif>已过期</option> 
                            <option value="未过期" @if(array_key_exists('status', $input) && $input['status']=='未过期') selected="selected" @endif>未过期</option> 
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
                    @include('member_cards.table')
            </div>
        </div>
        {!! $memberCards->appends($input)->links()  !!}
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        //Date range picker
        $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});


        function search() {
            window.location.href = "/memberCount?"+$('#form_search').serialize();
        }

          $('#sendtime_start, #sendtime_end, #create_start, #create_end').datepicker({
            format: "yyyy-mm-dd",
            language: "zh-CN",
            todayHighlight: true
        });

        // function search() {
        //     window.location.href = "/orders?"+$('#form_search').serialize();
        // }
    </script>

@endsection