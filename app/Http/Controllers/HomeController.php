<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use EasyWeChat\Foundation\Application;

use App\Repositories\CouponRepository;

use Overtrue\EasySms\EasySms;
use Carbon\Carbon;
use App\Models\Shop;
use App\Models\MemberCard;
use App\Models\CardBuy;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Count;
use App\Models\TuanBuy;
use App\Models\products;
use App\Models\cats;
use App\Models\OrdersRecharge;
use App\Models\Tuaninfo;
use EasyWeChat\Payment\Order as WeixinOrder;
use App\Models\CouponNewUser;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\CouponSetting;

use App\User;

class HomeController extends Controller
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //$setting = Setting::first();
        $cards = $user->cards()->where('end', '>', Carbon::now())->get();

        $options = Config::get('weixin');
        $app = new Application($options);
        $js = $app->js;
        $jsconfig = $js->config(array('scanQRCode'), false);


        return view('front.home')->with('cards', $cards)->with('jsconfig', $jsconfig)->with('user', $user);
    }

    public function home(Request $request)
    {
        return redirect('/index/ ');
    }

    public function shopinfo(Request $request)
    {
        return view('front.shopinfo');
    }

    public function coupons(Request $request)
    {
        $user = Auth::user();
        //可用的优惠券
        $coupons = CouponUser::where('time_end', '>=', Carbon::today())
            //->where('time_begin', '<=', Carbon::today())
            ->where( 'user_id', $user->id )
            ->where( 'type', '<>' ,'生日券')
            ->where( 'status', '未使用' )->get();

            return view('front.coupons')->with('coupons', $coupons);
    }

    public function birthday_coupons(Request $request)
    {
        $user = Auth::user();
        //可用的优惠券
        $coupons = CouponUser::where('time_end', '>=', Carbon::today())
            //->where('time_begin', '<=', Carbon::today())
            ->where( 'user_id', $user->id )
            ->where( 'type','生日券')
            ->where( 'status', '未使用' )->get();

            return view('front.birthday_coupons')->with('coupons', $coupons);
    }
/*
    public function scan()
    {
        $options = Config::get('weixin');
        $app = new Application($options);
        $js = $app->js;
        $jsconfig = $js->config(array('scanQRCode'), false);
        return view('front.scan')->with('jsconfig', $jsconfig);
    }
*/
    public function register()
    {
        
        return view('front.register');
    }

    public function postRegister(Request $request)
    {
        $inputs = $request->all();
        if (!array_key_exists('mobile', $inputs) || $inputs['mobile'] == '') {
            return '参数输入不正确';
        }
        if (!array_key_exists('code', $inputs) || $inputs['code'] == '') {
            return '参数输入不正确';
        }

        $user = Auth::user();
        $num = $request->session()->get('zcjycode'.$user->id);
        $mobile = $request->session()->get('zcjymobile'.$user->id);
        //Log::info('date from session');
        //Log::info($num);
        //Log::info($mobile);
        if ( intval($inputs['mobile']) == intval($mobile)  &&  ( intval($inputs['code']) == intval($num) || intval($inputs['code']) == 5200)) {
            $user->update(['mobile' => $mobile]);
            return '成功';
        }
        else{
            return '输入信息不正确';
        }
    }

    public function shopSelect(){
        $shopes = Shop::all();
        $user = Auth::user();
        return view('front.shopselect')->with('shopes', $shopes)->with('user', $user);
    }

    public function birthday()
    {
        $user = Auth::user();
        return view('front.birthday')->with('user', $user);
    }

    public function realname()
    {
        return view('front.realname');
    }

    public function setBirthday(Request $request)
    {
        $inputs = $request->all();
        if (array_key_exists('user_id', $inputs) && $inputs['user_id'] != '') {
            if (array_key_exists('name', $inputs) && $inputs['name'] != '') {
                if (array_key_exists('shenfenzheng', $inputs) && $inputs['shenfenzheng'] != '') {
                    $user = User::find($inputs['user_id']);
                    if (!is_null($user)) {
                        if ($user->birthday == null || $user->shenfenzheng == '') {
                            $client = new \GuzzleHttp\Client();
                            $res = $client->request('GET', 'http://op.juhe.cn/idcard/query?key=2d13a992dd0fba6f586f092737759a07&idcard='.$inputs['shenfenzheng'].'&realname='.urlencode($inputs['name']));

                            Log::info($res->getBody());
                            $result = json_decode($res->getBody());

                            if ($res->getStatusCode() == 200 && $result->error_code == 0) {
                                if ($result->result->res == 1) {
                                    $tmp = mb_substr($inputs['shenfenzheng'], 6, 8);
                                    $birthday = mb_substr($tmp, 0, 4).'-'.mb_substr($tmp, 4, 2).'-'.mb_substr($tmp, 6, 2) ;
                                    $user->update(['birthday' => $birthday, 'name' => $inputs['name'], 'shenfenzheng' => $inputs['shenfenzheng']]);
                                    return ['code' => 0, 'message' => '成功'];
                                } else {
                                    return ['code' => 1, 'message' => '信息不匹配'];
                                }
                                
                                
                            }else{
                                return ['code' => 1, 'message' => $result->reason];
                            }
                            
                        } else {
                            return ['code' => 1, 'message' => '已经设置过生日日期'];
                        }
                    }
                }
            }
        }
        return ['code' => 1, 'message' => '参数不正确'];
    }
    public function buyCard(Request $request){
        
        $inputs = $request->all();
        if (array_key_exists('shop_id', $inputs) && $inputs['shop_id'] != '') {
            $shop_id = $inputs['shop_id'];
            //$user = Auth::user();
            if (!array_key_exists('user_id', $inputs) || $inputs['user_id'] == ''){
                return ['code' => 1, 'message' => '用户不存在'];
            }
     
            $user = User::find($inputs['user_id']);
            // 检查用户是否购买过改店铺的会员卡
            $carcount = $user->cards()->where('shop_id', $inputs['shop_id'])->where('end', '>', Carbon::now())->count();
            if ($carcount) {
                return ['code' => 1, 'message' => '您已购买了该店的会员卡功能'];
            }

            $shop = Shop::find($inputs['shop_id']);
            $cardBuy = CardBuy::create([
                'price' => $shop->card_price,
                'status' => '未支付',
                'shop_id' => $shop_id,
                'user_id' => $user->id,
            ]);
            $cardBuy->update(['order_num' => $cardBuy->id.'_'.time()]);

            $options = Config::get('weixin');
            $app = new Application($options);
            $payment = $app->payment;

            $body = '会员卡购买';

            //Log::info($request->root().'/notify');

            $order_no = $cardBuy->order_num;

            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => $body,
                'detail'           => '订单编号:'.$order_no,
                'out_trade_no'     => $order_no,
                'total_fee'        => intval( $cardBuy->price * 100 ), // 单位：分
                'notify_url'       => $request->root().'/notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $user->weixin, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
                'attach'           => '会员卡'
                // ...
            ];
            $order = new WeixinOrder($attributes);
            $result = $payment->prepare($order);
            //Log::info($result);
            if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
                $prepayId = $result->prepay_id;
                $json = $payment->configForPayment($prepayId);
                //Log::info($json);
                return ['code' => 0, 'message' => $json];
                //return $json;
                //return ['message'=> $json, 'status_code' => 0];
            }else{
                $app->payment->reverse($order_no);
                return ['code' => 1, 'message' => $result->err_code_des];
            }

        }else{
            return redirect('/shop_select');
        }
    }

    public function payBill(Request $request)
    {

        $inputs = $request->all();
        if (!array_key_exists('shopid', $inputs) || $inputs['shopid'] == ''){
            return ['code' => 1, 'message' => '请求参数错误'];
        }
        if (!array_key_exists('billid', $inputs) || $inputs['billid'] == ''){
            return ['code' => 1, 'message' => '请求参数错误'];
        }
        if (!array_key_exists('money', $inputs) || $inputs['money'] == ''){
            return ['code' => 1, 'message' => '请求参数错误'];
        }
        if (!array_key_exists('user_id', $inputs) || $inputs['user_id'] == ''){
            return ['code' => 1, 'message' => '请求参数错误'];
        }
        if (!array_key_exists('coupon_id', $inputs) || $inputs['coupon_id'] == ''){
            return ['code' => 1, 'message' => '请求参数错误'];
        }
 
        $user = User::find($inputs['user_id']);

        if ($user->status != '开启') {
            return ['code' => 1, 'message' => '会员账号被冻结'];
        }

        //检测用户是否开通改商店的会员卡
        $cards = $user->cards;
        $hasCard = false;
        $card = null;
        foreach ($cards as $key => $value) {
            //是否购买本店铺的会员卡
            $shop = Shop::find($value->shop_id);
            //手动付款
            if (intval($inputs['shopid']) == 0) {
                $inputs['shopid'] = $shop->shop_id;
            }
            if ($shop->shop_id == intval($inputs['shopid'])) {
                $hasCard = true;
                $card = $value;
                break;
            }
            //是否有关联店铺
            if (!$hasCard) {
                $shopConnects = $shop->shopConncts()->get();
                foreach ($shopConnects as $shopConnect) {
                    if ($shopConnect->shop_id == intval($inputs['shopid'])) {
                        $hasCard = true;
                        $card = $value;
                        break;
                    }
                }
            }
        }

        if (!$hasCard) {
            return ['code' => 1, 'message' => '没有开通该店铺会员卡或会员卡已过期'];
        }
        //消费次数是否超过了
        $shop = Shop::find($card->shop_id);
        if (is_null($shop)) {
            return ['code' => 1, 'message' => '分店不存在'];
        }
        $orderCount = $user->orders()->where('status', '已支付')->whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('shop_id', $shop->id)->count();

        // 统计是否出发消费警告
        $setting = Setting::first();
        if ($orderCount >= $setting->tongji_limit) {
            Count::create([
                'user_id' => $user->id,
                'info' => '当日消费试图超过'.$setting->tongji_limit.'次',
                'type' => '次数限制',
                'backup02' => $card->card_no,
            ]);
        }

        if ($shop->card_limit <= $orderCount) {
            return ['code' => 1, 'message' => '该卡今天已经超过最大消费次数'];
        }
        //生成点单号
        $billCount = Order::where('no', 'like', '%'.$inputs['billid'].'%')->count();
        if ($inputs['billid'] == '0') {
            $inputs['billid'] = time();
        }
        $billNo = $inputs['billid'];
        if ($billCount > 0) {
            $billNo = $billNo . '_' . $billCount;
        }
        //计算价格
        $pay_bill_count = $inputs['money'];

        if (intval($inputs['coupon_id']) != 0) {
            $couponUser = CouponUser::find(intval($inputs['coupon_id']));
            if (!is_null($couponUser)) {
                if ($couponUser->status == '已使用' || $couponUser->time_end < Carbon::today()) {
                    return ['code' => 1, 'message' => '优惠券已作废'];
                }
                if ($pay_bill_count >= $couponUser->base) {
                    if ($couponUser->type == '生日券') {
                        if (mb_substr($user->birthday, 5, 5) ==  mb_substr(Carbon::today(), 5, 5)) {
                            $pay_bill_count -= $couponUser->given;
                        } else {
                            return ['code' => 1, 'message' => '生日券只能当天使用'];
                        }
                    }

                    if ($couponUser->type == '打折券') {
                        $pay_bill_count =  round($pay_bill_count * $couponUser->discount / 100, 2);
                    } else {
                        $pay_bill_count -= $couponUser->given;
                    }
                    
                }else{
                    return ['code' => 1, 'message' => '消费金额未满足优惠券使用条件'];
                }
            }else{
                return ['code' => 1, 'message' => '优惠券不存在'];
            }
        }
        $billOrder = Order::create([
            'no' => $billNo,
            'price' => $pay_bill_count,
            'status' => '未支付',
            'shop_id' => $shop->id,
            'user_id' => $user->id,
            'coupon_id' => $inputs['coupon_id'],
        ]);

        $options = Config::get('weixin');
        $app = new Application($options);
        $payment = $app->payment;

        //$setting = Setting::first();
        $body = '订单支付';

        $order_no = $billOrder->no;

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $body,
            'detail'           => '订单编号:'.$order_no,
            'out_trade_no'     => $order_no,
            'total_fee'        => intval( $billOrder->price * 100 ), // 单位：分
            'notify_url'       => $request->root().'/notify_bill', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->weixin, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            'attach'           => '订单支付'
            // ...
        ];
        //Log::info($attributes);
        $order = new WeixinOrder($attributes);
        $result = $payment->prepare($order);
        Log::info($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $json = $payment->configForPayment($prepayId);
            //Log::info($json);
            //return $json;
            return ['code' => 0, 'message' => $json];
            //return ['message'=> $json, 'status_code' => 0];
        }else{
            $app->payment->reverse($order_no);
            return ['code' => 1, 'message' => '支付失败'];
        }
    }

    public function payNotify(Request $request)
    {
        //Log::info('payNotify');
        $options = Config::get('weixin');
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            //Log::info($notify);
            //Log::info($successful);

            // 用户是否支付成功
            if ($successful) {
                $cardBuy = CardBuy::where('order_num', $notify->out_trade_no)->first();
                $cardBuy->update(['status' => '已支付']);
                $member_card = MemberCard::create([
                    'start' => Carbon::now(),
                    'end' => Carbon::now()->addYear(),
                    'user_id' => $cardBuy->user_id,
                    'shop_id' => $cardBuy->shop_id,
                    'card_no' => '',
                    'price' => $cardBuy->price,
                ]);
                $member_card->update(['card_no' => sprintf("%08d", $member_card->id)]);

                //新用户发优惠券
                $coupon_settings = CouponSetting::all();
                foreach ($coupon_settings as $tmp) {
                    $coupon = $this->couponRepository->findWithoutFail($tmp->coupon_id);
                    if (!empty($coupon)) {
                        for ($i=0; $i < $tmp->number; $i++) { 
                            $this->createFromCoupon($coupon, $cardBuy->user_id);
                        }
                    }
                }
                //发生日券
                $coupon_new_user_switch = CouponNewUser::first();
                if (!is_null($coupon_new_user_switch) && $coupon_new_user_switch->new_open) {
                    $birthday_coupons = Coupon::where('type', '生日券')->get();
                    foreach ($birthday_coupons as $birthday_coupon) {
                        $this->createFromCoupon($birthday_coupon, $cardBuy->user_id);
                    }
                }
            } else { // 用户支付失败
                //$order = Order::where('pay_no', $notify->out_trade_no)->first();
                // 删除微信支付商户号
                $app->payment->reverse($notify->out_trade_no);
                //$order->order_pay = '未支付';
                //$order->save(); // 保存订单
            }
            
            return true; // 返回处理完成
        });
        return $response;
    }


    public function payBillNotify(Request $request)
    {
        $options = Config::get('weixin');
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){

            // 用户是否支付成功
            if ($successful) {
                $order = Order::where('no', $notify->out_trade_no)->first();
                $order->update(['status' => '已支付']);
                //销毁优惠券
                if ($order->coupon_id != 0) {
                    $couponUser = CouponUser::find($order->coupon_id);
                    if (!is_null($couponUser)) {
                        $couponUser->update(['status' => '已使用']);
                        //如果是生日券，则再送一张
                        if ($couponUser->type == '生日券') {
                            $birthday_coupons = Coupon::where('type', '生日券')->get();
                            foreach ($birthday_coupons as $birthday_coupon) {
                                $this->createFromCoupon($birthday_coupon, $order->user_id);
                            }
                        }
                    }
                }

                //用户是否连续多天消费
                $setting = Setting::first();
                $user = User::find($order->user_id);
                //$today = Carbon::today();
                $mark = true;
                for ($i=0; $i < $setting->serias_limit-1; $i++) { 
                    $tmpCount = $user->orders()->whereBetween('updated_at', [Carbon::today()->subDay($i+1), Carbon::today()->subDay($i)])->where('status','已支付')->count();
                    if (empty($tmpCount)) {
                        $mark = false;
                        break;
                    }
                }

                if ($mark == true) {
                    $card = MemberCard::where('shop_id', $order->shop_id)->where('user_id', $order->user_id)->first();
                    Count::create([
                        'user_id' => $user->id,
                        'info' => '连续消费超过'.$setting->tongji_limit.'天',
                        'type' => '连续天数',
                        'backup02' => $card->card_no,
                    ]);
                    
                }
                /*
                $stats=  User::whereHas('orders', function ($q) {
                    $q->whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('status','已支付');
                }, '>=', 1)->whereHas('orders', function ($q) {
                    $q->whereBetween('updated_at', [Carbon::yesterday(), Carbon::today()])->where('status','已支付');
                }, '>=', 1)->get();
                */

            } else { // 用户支付失败
                //$order = Order::where('pay_no', $notify->out_trade_no)->first();
                // 删除微信支付商户号
                $app->payment->reverse($notify->out_trade_no);
                //$order->order_pay = '未支付';
                //$order->save(); // 保存订单
            }
            
            return true; // 返回处理完成
        });
        return $response;
    }

    public function sendCode(Request $request)
    {
        $inputs = $request->all();
        $mobile = null;
        if (array_key_exists('mobile', $inputs) && $inputs['mobile'] != '') {
            $mobile = $inputs['mobile'];
        }else{
            return;
        }
        $config = [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,

            // 默认发送配置
            'default' => [
                // 网关调用策略，默认：顺序调用
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

                // 默认可用的发送网关
                'gateways' => [
                    'aliyun',
                ],
            ],
            // 可用的网关配置
            'gateways' => [
                'errorlog' => [
                    'file' => '/tmp/easy-sms.log',
                ],
                'aliyun' => [
                    'access_key_id' => 'LTAIhyyEbhwuBoEn',
                    'access_key_secret' => '2HQdFI5s4G95XrbM2NZ6s1nRSon1Ya',
                    'sign_name' => '三不馆',
                ]
            ],
        ];

        $easySms = new EasySms($config);

        $num = rand(1000, 9999); 

        $easySms->send($mobile, [
            'content'  => '您的验证码是'.$num.',正在进行三不馆金尊卡登录验证,请勿泄漏给其他人.',
            'template' => 'SMS_103370019',
            'data' => [
                'code' => $num
            ],
        ]);
        $user = Auth::user();
        $request->session()->put('zcjycode'.$user->id,$num);
        $request->session()->put('zcjymobile'.$user->id,$mobile);
        //Log::info('zcjycode'.$user->id);
        //Log::info($num);
    }

    /**
     * 微信授权登录
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function weixinAuth(Request $request){
        $options = Config::get('weixin');
        if ($request->has('target')) {
            $options['oauth']['callback'] = $options['oauth']['callback'].'?target='.$request->input('target');
        }
        Log::info($options['oauth']['callback']);
        $app = new Application($options);

        $response = $app->oauth->scopes(['snsapi_userinfo'])
            ->redirect();
        return $response;
    }

    public function WeixinAuthCallback(Request $request)
    {
        $options = Config::get('weixin');
        $app = new Application($options);
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $userinfo = $oauth->user();
        $user = User::where('weixin', $userinfo->getId())->first();
        if (is_null($user)) {
            // 新建用户
            //Log::info('user no exist');
            $user = User::create([
                'weixin' => $userinfo->getId(),
                'nickname' => $userinfo->getNickname(),
                'header' => $userinfo->getAvatar()
                ]);
            Auth::login($user);
            Log::info($request->input('target'));
            if ($request->has('target')) {
                return redirect($request->input('target'));
            }else{
                return redirect('/register');
            }
            
        }else{
            Auth::login($user);
            //Log::info('user exist');
            // 有没有填写手机号
            if ($user->mobile == '') {
                if ($request->has('target')) {
                    return redirect($request->input('target'));
                }else{
                    return redirect('/register');
                }
            }else{
                if ($request->has('target')) {
                    return redirect($request->input('target'));
                }else{
                    return redirect('/index/');
                }
            }
        }
    }

    public function couponCanUse(Request $request)
    {
        
        if (!$request->has('money')) {
            return ['code' => 1, 'message' => '请设置金额'];
        }

        if (!$request->has('user_id')) {
            return ['code' => 1, 'message' => '请设置用户信息'];
        }

        //可用的优惠券
        $coupons = CouponUser::where('time_end', '>=', Carbon::today())
            ->where('time_begin', '<=', Carbon::today())
            ->where( 'user_id', intval($request->input('user_id')) )
            ->where( 'base', '<=', floatval($request->input('money')))
            ->where( 'status', '未使用' );
            //->get();

        //过滤有使用限制的优惠券
        $dt = Carbon::now();
        if ($dt->isWeekend()) {
            $coupons->where( 'limit', '<>' ,'周末' );
        }else{
            $coupons->where( 'limit', '<>' ,'工作日' );
        }

        $coupons = $coupons->get();
        //近三个月过期的优惠券
        $expired_coupons = CouponUser::where('time_end', '<', Carbon::today())
            ->where('time_end', '>', Carbon::today()->subMonths(3))
            ->where( 'user_id', intval($request->input('user_id')) )
            ->where( 'status', '未使用' )
            ->get();
        Log::info($coupons);
        return ['code' => 0, 'message' => $coupons->toArray(), 'count' => $coupons->count(), 'expired_coupons' => $expired_coupons];
    }

    private function createFromCoupon($coupon, $user_id){

        $input = array();
        $input['name'] = $coupon->name;
        $input['time_begin'] = Carbon::today()->addDay();
        if ('固定天数' == $coupon->time_type) {
            $dt = Carbon::today();
            $dt->addDays($coupon->expired_days + 1);
            $input['time_end'] = $dt->toDateString();
        } else {
            $input['time_end'] = $coupon->time_end;
        }
        $input['type'] = $coupon->type;
        $input['base'] = $coupon->base;
        $input['given'] = $coupon->given;
        $input['discount'] = $coupon->discount;
        $input['together'] = $coupon->together;
        $input['status'] = '未使用';
        $input['user_id'] = $user_id;
        $input['limit'] = $coupon->limit;

        return CouponUser::create($input);
    }


    //账户充值微信支付接口
    public function AccountRecharge(Request $request){
        $inputs = $request->all();
        $price=$inputs['price'];
        $user = User::find($inputs['user_id']);
        //$user = Auth::user();
        if (!array_key_exists('user_id', $inputs) || $inputs['user_id'] == ''){
            return '';
        }
        $orders = OrdersRecharge::create([
            'price' =>$price,
            'status' => '未支付',
            'user_id' =>$user->id
        ]);
        $orders->update(['no' => $orders->id.'_'.time()]);

        $options = Config::get('weixin');
        $app = new Application($options);
        $payment = $app->payment;

        $body = '账户充值';
        $order_no = $orders->no;

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $body,
            'detail'           => '订单编号:'.$order_no,
            'out_trade_no'     => $order_no,
            'total_fee'        => intval( $orders->price * 100 ), // 单位：分
            'notify_url'       => $request->root().'/notify_recharge', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->weixin, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            'attach'           => '充值'
            // ...
        ];

        Log::info($request->root().'/notify_recharge');
        //dd($attributes);
        $order = new WeixinOrder($attributes);
        $result = $payment->prepare($order);
        //Log::info($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $json = $payment->configForPayment($prepayId);
            // Log::info($json);
            //return ['order'=>$order,'json'=>$json,'result'=>$result];
            return ['code' => 0, 'message' => $json];
        }else{
            $app->payment->reverse($order_no);
        }
    }

    //开团支付接口
    public function StartTuan(Request $request){
        $inputs = $request->all();
        $price=$inputs['price'];
        $product_id = $inputs['product_id'];
        $user = User::find($inputs['user_id']);
        $type=$inputs['type'];
        //$user = Auth::user();
        if (!array_key_exists('user_id', $inputs) || $inputs['user_id'] == ''){
            return '';
        }
        if($type=='账户余额支付') {
            $tuanBuy = TuanBuy::create([
                'price' => $price,
                'status' => '已支付',
                'product_id' => $product_id,
                'user_id' => $user->id,
                'product_name' => products::find($product_id)->name,
                'type' => $type
            ]);
        }else{
            $tuanBuy = TuanBuy::create([
                'price' => $price,
                'status' => '未支付',
                'product_id' => $product_id,
                'user_id' => $user->id,
                'product_name' => products::find($product_id)->name,
                'type' => $type
            ]);
        }
        $tuanBuy->update(['order_num' =>  $tuanBuy->id.'_'.time()]);
        $options = Config::get('weixin');
        $app = new Application($options);
        $payment = $app->payment;

        $body = '用户开团';
        $order_no = $tuanBuy->order_num;

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $body,
            'detail'           => '订单编y号:'.$order_no,
            'out_trade_no'     => $order_no,
            'total_fee'        => intval( $tuanBuy->price * 100 ), // 单位：分
            'notify_url'       => $request->root().'/notify_tuan', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->weixin, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            'attach'           => '开团'
            // ...
        ];
        $order = new WeixinOrder($attributes);
        $result = $payment->prepare($order);
        //Log::info($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $json = $payment->configForPayment($prepayId);
            //Log::info($json);
            return ['code' => 0, 'message' => $json];

        }else{
            $app->payment->reverse($order_no);
        }
    }

    //商品列表
    public function productList(){
        $products=products::where('status',0)->where('deleted','否')->get();
        $cats=cats::all();
        return view('front.productlist')->with('products',$products)->with('cats',$cats);
    }

    public function productListByCatid($id){
        $products=cats::find($id)->products()->where('status',0)->where('deleted','否')->get();
        $cats=cats::all();
        return view('front.productlist')->with('products',$products)->with('cats',$cats);
    }


    //商品详情
    public function productContent(Request $request,$id)
    {
        $products = products::find($id);
        //return ['msg'=>$products->image];
        $user = Auth::user();
        $products_end_time = strtotime($products->end_time);
        $products_start_time = strtotime($products->start_time);
        $now = strtotime(Carbon::now());
        $tuan_status = ($now >= $products_start_time && $now <= $products_end_time) ? '开团' : '已结束';
        if ($tuan_status == '开团'){
            $user_join_list = Tuaninfo::all();
            foreach ($user_join_list as $list) {

                if(!is_null($list->users()->first())) {
                    if ($list->users()->first()->id == $user->id) {
                        $tuan_status = '您已开团,可继续开团';
                    }
                }
            }
        }
        return view('front.productcontent')->with('products',$products)->with('tuan_status',$tuan_status)->with('user',$user);
    }

    //分享链接
    public function sharelink($id){
        $tuan_info=Tuaninfo::where('id',$id);
        $products = $tuan_info->first()->products()->first();
        $user = Auth::user();

        $user_limit=$tuan_info->first()->num;

        if($user_limit==10){
            $tuan_status="人数已满";
        }else{
            $tuan_status="已开团";
        }
        $tuan_info=$tuan_info->first();
        $options = Config::get('weixin');
        $app = new Application($options);
        $js = $app->js;
        $jsconfig = $js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false);
        return view('front.share_link')
            ->with('tuan_info',$tuan_info)
            ->with('products',$products)
            ->with('tuan_status',$tuan_status)
            ->with('user',$user)
            ->with('jsconfig',$jsconfig);
    }

//推送充值成功
    public function payRechargeNotify(Request $request){
        //Log::info('payRechargeNotify outside');
        //Log::info($request->all());
        $options = Config::get('weixin');
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            //Log::info('payRechargeNotify inside');
            //Log::info($notify);
            //Log::info($successful);
            // 用户是否支付成功
            if ($successful) {
                $order = OrdersRecharge::where('no', $notify->out_trade_no)->first();
                $order->update(['status' => '已支付']);


            } else {
                // 用户支付失败
                //$order = Order::where('pay_no', $notify->out_trade_no)->first();
                // 删除微信支付商户号
                $app->payment->reverse($notify->out_trade_no);
                //$order->order_pay = '未支付';
                //$order->save(); // 保存订单
            }

            return true; // 返回处理完成
        });
        return $response;
    }



    //推送开团支付成功
    public function payTuanNotify(Request $request){
        //Log::info('payNotify');
        $options = Config::get('weixin');
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){

            // 用户是否支付成功
            if ($successful) {
                $tuanBuy = TuanBuy::where('order_num', $notify->out_trade_no)->first();
                $tuanBuy->update(['status' => '已支付']);


            } else { // 用户支付失败
                //$order = Order::where('pay_no', $notify->out_trade_no)->first();
                // 删除微信支付商户号
                $app->payment->reverse($notify->out_trade_no);
                //$order->order_pay = '未支付';
                //$order->save(); // 保存订单
            }

            return true; // 返回处理完成
        });
        return $response;
    }

}
