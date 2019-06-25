
<li class="treeview @if(Request::is('memberCount*') || Request::is('memberCards*')) active @endif " >
  <a href="#">
    <i class="fa fa-pie-chart"></i>
    <span>统计</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('memberCount*') ? 'active' : '' }}">
        <a href="{!! route('memberCount.index') !!}"><i class="fa fa-bar-chart"></i><span>统计</span></a>
    </li>


    <li class="{{ Request::is('memberCards*') ? 'active' : '' }}">
      <a href="{!! route('memberCards.index') !!}"><i class="fa fa-archive"></i><span>会员卡</span></a>
    </li>
  </ul>
</li>


<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-archive"></i><span>订单</span></a>
</li>


<li class="treeview @if(Request::is('shops*') || Request::is('counts*') || Request::is('settings*')) active @endif " >
  <a href="#">
    <i class="fa fa-pie-chart"></i>
    <span>门店设置</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('shops*') ? 'active' : '' }}">
        <a href="{!! route('shops.index') !!}"><i class="fa fa-edit"></i><span>门店设置</span></a>
    </li>

    <li class="{{ Request::is('shopConnects*') ? 'active' : '' }}">
      <a href="{!! route('shopConnects.index') !!}"><i class="fa fa-edit"></i><span>关联门店</span></a>
    </li>

    <li class="{{ Request::is('counts*') ? 'active' : '' }}">
        <a href="{!! route('counts.index') !!}"><i class="fa fa-edit"></i><span>消费警告</span></a>
    </li>

    <li class="{{ Request::is('settings*') ? 'active' : '' }}">
        <a href="{!! route('settings.index') !!}"><i class="fa fa-edit"></i><span>警告设置</span></a>
    </li>
  </ul>
</li>


<li class="treeview @if(Request::is('coupons*') || Request::is('couponUsers*') || Request::is('couponNewUsers*') || Request::is('couponSettings*')) active @endif " >
  <a href="#">
    <i class="fa fa-pie-chart"></i>
    <span>优惠券</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('coupons*') && !Request::is('coupons/giveCoupon') ? 'active' : '' }}">
        <a href="{!! route('coupons.index') !!}"><i class="fa fa-edit"></i><span>优惠券</span></a>
    </li>

    <li class="{{ Request::is('coupons/giveCoupon') ? 'active' : '' }}">
        <a href="{!! route('coupons.giveCoupon') !!}"><i class="fa fa-edit"></i><span>发放优惠券</span></a>
    </li>

    <li class="{{ Request::is('couponUsers*') ? 'active' : '' }}">
        <a href="{!! route('couponUsers.index') !!}"><i class="fa fa-edit"></i><span>已发放优惠券</span></a>
    </li>

    <li class="{{ Request::is('couponNewUsers*') ? 'active' : '' }}">
        <a href="{!! route('couponNewUsers.index') !!}"><i class="fa fa-edit"></i><span>新用户生日券开关</span></a>
    </li>

    <li class="{{ Request::is('couponSettings*') ? 'active' : '' }}">
        <a href="{!! route('couponSettings.index') !!}"><i class="fa fa-edit"></i><span>新用户优惠券设置</span></a>
    </li>
  </ul>
</li>

<li class="treeview {{ Request::is('cats*') || Request::is('products*') ? 'active' : '' }}">
 <a href="#"><i class="fa fa-edit"></i> <span>商品</span>
              
              <i class="fa fa-angle-left pull-right"></i>
             
 </a>
    <ul class="treeview-menu">
      <li class="{{ Request::is('cats*') ? 'active' : '' }}">
         <a href="{!! route('cats.index') !!}">商品分类管理</a>
      </li>

      <li class="{{ Request::is('products*') ? 'active' : '' }}">
            <a href="{!! route('products.index') !!}">商品管理</a>
      </li>
       <li class="{{ Request::is('products/recycle') ? 'active' : '' }}">
         <a href="{!! route('products.recycle') !!}">商品回收站</a>
         </li>
    </ul>
</li>

<li class="treeview {{ Request::is('tuaninfos*') || Request::is('tuansettings*') ? 'active' : '' }}">
 <a href="#"><i class="fa fa-edit"></i> <span>拼团</span>
              
              <i class="fa fa-angle-left pull-right"></i>
            
 </a>
    <ul class="treeview-menu">
    <li class="{{ Request::is('tuaninfos*') ? 'active' : '' }}">
        <a href="{!! route('tuaninfos.index') !!}">当前拼团情况</a>
    </li>

 <!--    <li class="{{ Request::is('tuansettings*') ? 'active' : '' }}">
        <a href="{!! route('tuansettings.edit', [1]) !!}">拼团设置</a>
    </li> -->
    </ul>
</li>

<li class="treeview {{ Request::is('accountUsers*') || Request::is('bankinfos*') ? 'active' : '' }}">
 <a href="#"><i class="fa fa-edit"></i> <span>钱包用户管理</span>
               
              <i class="fa fa-angle-left pull-right"></i>
             
 </a>
    <ul class="treeview-menu">
    <li class="{{ Request::is('accountUsers*') ? 'active' : '' }}">
        <a href="{!! route('accountUsers.index') !!}">钱包用户记录</a>
    </li>

    <li class="{{ Request::is('bankinfos*') ? 'active' : '' }}">
        <a href="{!! route('bankinfos.index') !!}">钱包用户银行卡信息</a>
    </li>
    </ul>
</li>



