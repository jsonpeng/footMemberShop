<table class="table table-responsive" id="couponSettings-table">
    <thead>
        <tr>
            <th>优惠券</th>
            <th>数量</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($couponSettings as $couponSetting)
        <tr>
            <td>{!! $couponSetting->coupon->name !!}</td>
            <td>{!! $couponSetting->number !!}</td>
            <td>
                {!! Form::open(['route' => ['couponSettings.destroy', $couponSetting->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('coupons.show', [$couponSetting->coupon_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('couponSettings.edit', [$couponSetting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>