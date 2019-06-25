<table class="table table-responsive" id="memberCards-table">
    <thead>
        <tr>
            <th>会员卡号</th>
            <th>手机号</th>
            <th>持有者</th>
            <th>实名</th>
            <th>生日</th>
            <th>交易订单号</th>
            <th>分店</th>
            <th>起止日期</th>
            <th>办理价格</th>
            <th>会员姓名</th>
            <th>当前状态</th>
            <th>消费金额</th>
            <th>消费次数</th>
            <th>优惠使用数量</th>
            <th>卡状态(过期)</th>
           
        </tr>
    </thead>
    <tbody>
    @foreach($memberCards as $memberCard)
        <tr>
            <td>{!! $memberCard->card_no !!}</td>
            <td><a href="/orders?uid={!! $memberCard->user->id !!}">{!! $memberCard->user->mobile !!}</a></td>
            <td><a href="/orders?uid={!! $memberCard->user->id !!}">{!! $memberCard->user->nickname !!}</a></td>
            <td>{!! $memberCard->user->shiMing !!}</td>
            <td>{!! $memberCard->user->birthday !!}</td>
            <td>{!! $memberCard->tradeNo !!}</td>
            <td>{!! $memberCard->shop->name !!}</td>
            <td>{!! $memberCard->start->format('Y-m-d') !!}_{!! $memberCard->end->format('Y-m-d') !!}</td>
            <td>{!! $memberCard->price !!}</td>

            <td>{!! $memberCard->user->nickname !!}</td>
            <td>{!! $memberCard->user->status !!}</td>
            <td>{!! $memberCard->shoppingAmount !!}</td>
            <td>{!! $memberCard->shoppingCount !!}</td>
            <td>{!! $memberCard->usedCoupons !!}</td>
            <td>{!! $memberCard->expired !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>