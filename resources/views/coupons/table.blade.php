<table class="table table-responsive" id="coupons-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>类型</th>
            <th>有效期类型</th>
            <th>结束时间</th>
            <th>过期天数</th>
            <th>消费满</th>
            <th>优惠金额</th>
            <th>折扣</th>
            <th>限制使用</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td>{!! $coupon->name !!}</td>
            <td>{!! $coupon->type !!}</td>
            <td>{!! $coupon->time_type !!}</td>
            <td>@if($coupon->time_type == '固定日期'){!! substr($coupon->time_end,0,10) !!} @endif</td>
            <td>@if($coupon->time_type != '固定日期'){!! substr($coupon->expired_days,0,10) !!} @endif</td>
            <td>{!! $coupon->base !!}</td>
            <td>@if($coupon->type != '打折券'){!! $coupon->given !!} @endif</td>
            <td>@if($coupon->type == '打折券'){!! $coupon->discount !!} @endif</td>
            <td>{!! $coupon->limit !!}</td>
            <td>
                {!! Form::open(['route' => ['coupons.destroy', $coupon->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('coupons.show', [$coupon->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('coupons.edit', [$coupon->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>