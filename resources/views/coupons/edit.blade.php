@extends('layouts.app')

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($coupon, ['route' => ['coupons.update', $coupon->id], 'method' => 'patch']) !!}

                        @include('coupons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
    
    <script type="text/javascript">
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_minimal-blue'
        });
        $(document).ready(function() {
            $('.example-getting-started').multiselect();

            $('#datetimepicker_end').datepicker({
                format: "yyyy-mm-dd",
                language: "zh-CN",
                todayHighlight: true
            });
            $('#time_end').val($('#time_end').val().substring(0,10));

            function ele(type){
              switch (type){
                case '生日券':
                  $('div.given').show();
                  $('div.discount').hide();
                break;
                case '打折券':
                  $('div.given').hide();
                  $('div.discount').show();
                break;
                case '满减券':
                  $('div.given').show();
                  $('div.discount').hide();
                break;
                case '代金券':
                  $('div.given').show();
                  $('div.discount').hide();
                break;
              }
            }
            $('.conpon_type').on('loaded.bs.select', function (e) {
              ele(e.target.value);
            });

            $('.conpon_type').on('changed.bs.select', function (e) {
              ele(e.target.value);
            });


            function ele2(type){
              switch (type){
                case '固定日期':
                  $('div.fixeddate').show();
                  $('div.floatdate').hide();
                break;
                case '固定天数':
                  $('div.fixeddate').hide();
                  $('div.floatdate').show();
                break;
              }
            }
            $('.type_type').on('loaded.bs.select', function (e) {
              ele2(e.target.value);
            });

            $('.type_type').on('changed.bs.select', function (e) {
              ele2(e.target.value);
            });
        });
    </script>

@endsection