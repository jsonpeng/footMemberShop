<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


// 微信授权
Route::get('/weixin', 'HomeController@weixinAuth');

// 微信授权回调
Route::get('/weixin_auth_callback', 'HomeController@WeixinAuthCallback');

//购买会员卡支付回调
Route::any('/notify', 'HomeController@payNotify');

//买单支付回调
Route::any('/notify_bill', 'HomeController@payBillNotify');

//请求购买会员卡
Route::get('/buy_card', 'HomeController@buyCard');

//请求买单
Route::get('/pay_bill', 'HomeController@payBill');

//充值支付成功状态更新
Route::any('/notify_recharge','HomeController@payRechargeNotify');

//开团支付成功状态更新
Route::any('/notify_tuan','HomeController@payTuanNotify');

//tinymce上传图片
Route::post('/uploadimg','RestController@uploadimg');

//上传多张产品图片
Route::get('/productImages','RestController@productImages');

//删除产品图片
Route::get('/delProductImage/{id}','RestController@delProductImage');

Route::post('/updateAccountprice','RestController@updateAccountprice');

//设置制定团中奖
Route::post('/zhongjiang','RestController@zhongjiang');

Route::group(['middleware' => ['weixin']], function () {
	// 会员注册
	Route::get('/register', 'HomeController@register');

	//发送注册信息
	Route::post('/post_register', 'HomeController@postRegister');

	//发送短信验证码
	Route::get('/sendCode', 'HomeController@sendCode');
	
	 //商品列表
    Route::get('/productList','HomeController@productList');
	
    //对应商品分类下商品列表
    Route::get('/productList/{id}','HomeController@productListByCatid');
	
    //商品详情
    Route::get('/productContent/{id}','HomeController@productContent');
	
    //开团接口
    Route::post('/KaiProductTuan','RestController@KaiProductTuan');
	
    //参团接口
    Route::post('/JoinProductTuan','RestController@JoinProductTuan');

    //分享链接
    Route::get('/share/{id}','HomeController@sharelink');
	
    //参团支付接口交互
    Route::post('/starttuan','HomeController@StartTuan');
	
    //个人中心
    Route::get('/usercenter','UserCenterController@index');
	
    //获取用户银行卡信息
    Route::get('/get_user_bankinfo','UserCenterController@get_user_bankinfo');
	
    //参与记录
    Route::get('/mejoinlist','UserCenterController@mejoinlist');
	
    //验证开团
    Route::post('/varifyKaituan','RestController@varifyKaituan');
	
    //验证参团前更新手机号
    Route::post('/varifyMobile','RestController@varifyMobile');
	
    //验证参团
    Route::post('/varifyCantuan','RestController@varifyCantuan');
	
    //用户钱包
    Route::get('/useraccount','UserCenterController@useraccount');
	
    //充值调用微信支付
    Route::post('/AccountRecharge','HomeController@AccountRecharge');
	
    //存储充值信息
    Route::post('/recharge_account','UserCenterController@recharge_account');
	
    //绑定银行卡
    Route::post('/blind_bank_card','UserCenterController@blind_bank_card');
	
    //账户提现
    Route::post('/withdraw_account','UserCenterController@withdraw_account');
	
    //充值记录
    Route::get('/recharge_record','UserCenterController@recharge_record');
	
    //提现记录
    Route::get('/withdraw_record','UserCenterController@withdraw_record');
	
    //返现记录
    Route::get('/return_money','UserCenterController@return_money');
	
    //提现详情
    Route::get('/withdraw_record/{no}','UserCenterController@withdraw_record_detail');
	
    //消费记录
    Route::get('/consume_record','UserCenterController@consume_record');
	
    //银行卡管理
    Route::get('/bank_manage','UserCenterController@bank_manage');
	
    //删除银行卡
    Route::post('/del_bank_card','UserCenterController@del_bank_card');

	Route::group(['middleware' => ['mobile']], function () {

		//主页
		Route::get('/', 'HomeController@home');
		Route::get('/shopinfo', 'HomeController@shopinfo');
		//主页
		Route::get('/index', 'HomeController@index');
		//扫描
		Route::get('/scan', 'HomeController@scan');
		//优惠券
		Route::get('/user_coupons', 'HomeController@coupons');
		Route::get('/user_birthday_coupons', 'HomeController@birthday_coupons');
		//购买会员卡
		Route::get('/shop_select/select', 'HomeController@shopSelect');
		//生日设置页面
		Route::get('/birthday', 'HomeController@birthday');
		//生日设置页面
		Route::get('/realname', 'HomeController@realname');
		//设置生日信息
		Route::get('/set_birthday', 'HomeController@setBirthday');
		//可用优惠券
		Route::get('/api/coupon_can_use', 'HomeController@couponCanUse');
	});
});

//以下是管理员界面
Route::group(['middleware' => ['auth']], function () {
	Route::resource('memberCards', 'MemberCardController');
    Route::resource('memberManage', 'MemberManageController');

    Route::get('memberCount/onedayhign2','MemberCountController@highday2')->name('memberCount.highday2');
    Route::get('memberCount/allday2','MemberCountController@allday2')->name('memberCount.allday2');
    Route::get('memberCount/month','MemberCountController@month')->name('memberCount.month');
    Route::get('memberCount/custom','MemberCountController@custom')->name('memberCount.custom');
    //custom
    Route::resource('memberCount','MemberCountController');

	Route::resource('orders', 'OrderController');
	Route::resource('settings', 'SettingController');
	Route::resource('shops', 'ShopController');
	Route::resource('cardBuys', 'CardBuyController');
	
	Route::get('/pintuan','PintuanController@index')->name('pintuan.index');
	
	Route::resource('counts', 'CountController');

	Route::get('coupons/giveCoupon', 'CouponController@giveCoupon')->name('coupons.giveCoupon');
	Route::post('coupons/giveCoupon', 'CouponController@giveCouponPost')->name('coupons.giveCouponPost');
	Route::resource('coupons', 'CouponController');

	Route::resource('couponUsers', 'CouponUserController');

	Route::resource('couponNewUsers', 'CouponNewUserController');

	Route::resource('couponSettings', 'CouponSettingController');

	Route::resource('shopConnects', 'ShopConnectController');
	
	Route::resource('cats', 'catsController');

    Route::get('products/recycle','productsController@recycle')->name('products.recycle');

    Route::get('products/recover/{id}','productsController@recover')->name('products.recover');

	Route::resource('products', 'productsController');



	Route::resource('tuaninfos', 'TuaninfoController');
	
    Route::resource('tuansettings', 'tuansettingController');
	
    Route::resource('accountUsers', 'account_userController');
	
    Route::resource('bankinfos', 'bankinfoController');
	
});


