<table class="table table-responsive" id="tuaninfos-table">
    <thead>
        <tr>
        <th>团名称</th>
        <th>商品名称</th>
        <th>团长 </th>
        <th>参与的用户</th>
        <th>当前团总人数</th>
        <th>当前团总金额</th>
        <th>状态</th>
        <th>开团时间</th>
        <th>结束时间</th>
        <th>是否中奖</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tuaninfos as $tuaninfo)
        <tr>
            <td>{!! $tuaninfo->name !!}</td>
            @if(!empty($tuaninfo->products))
            <td>
            {!! $tuaninfo->products->name !!} 
            </td>
            @else
            <td>--</td>
            @endif
            <td><a>{!! $tuaninfo->tuanzhang->nickname !!}</a></td>
            <td>
            <?php $userlists=$tuaninfo->users()->get(); ?>
            @foreach($userlists as $userlist)
            <a>{!! $userlist->nickname !!}</a>&nbsp;&nbsp;
            @endforeach
            </td>
            <td>{!! $tuaninfo->num !!} </td>
            <td>{!! $tuaninfo->zongjia !!}</td>
            <td>@if($tuaninfo->chanum<=0)参团人数已满@else还差{!! $tuaninfo->chanum !!}人@endif</td>
            <td>{!! $tuaninfo->created_at !!} </td>
            <td>{!! $tuaninfo->end_time !!} </td>
            <td>{!! $tuaninfo->winner=='是'?'是':'否' !!}</td>
            <td>
                {!! Form::open(['route' => ['tuaninfos.destroy', $tuaninfo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                   <a href="{!! route('tuaninfos.show', [$tuaninfo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                  
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                @if(!empty($tuaninfo->products))

                @if($tuaninfo->products->hadwined!='是' && $tuaninfo->winner!='是' && $tuaninfo->whetherguoqi!='已过期' && $tuaninfo->chanum<=0)<a href="javascript:;"  id="zhongjiang" data-tuanid="{!! $tuaninfo->id !!}" data-productid="{!! $tuaninfo->products->id !!}"class='btn btn-default btn-xs'>设定中奖</i></a>@endif
                @else
                --
                @endif
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>