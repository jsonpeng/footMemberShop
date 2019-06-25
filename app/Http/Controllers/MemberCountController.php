<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Order;
use App\Models\Shop;
use App\Models\CardBuy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Input;

class MemberCountController extends Controller
{
    //

    public function index(Request $request){
        $all=$request->all();
        $shop=Shop::all();

        $all = array_filter( $all, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );
        $card_buy=CardBuy::whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('status','已支付');
        $stats=Order::whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('status','已支付');


        if(array_key_exists('fendian',$all)) {
            if ($all['fendian'] != '全部') {
                $stats =$stats ->where('shop_id', $all['fendian']);
                $card_buy = $card_buy->where('shop_id', $all['fendian']);
            }
        }

        $stats_dingdan_count=$stats->count();
        $stats_price_count=$stats->sum('price');
        $stats=$stats->orderBy('created_at','desc')->paginate(20);
        $card_buy_num=$card_buy->count();
        $card_buy_price=$card_buy->sum('price');
        
        //dd($orders->first()->user);

        return view('statics.index')
                ->with('stats',$stats)
                ->with('shop',$shop)
                ->with('card_buy',$card_buy)
                ->with('stats_dingdan_count',$stats_dingdan_count)
                ->with('stats_price_count',$stats_price_count)
                ->with('card_buy_num',$card_buy_num)
                ->with('card_buy_price',$card_buy_price)
                ->withInput(Input::all());
    }




    public function month(Request $request){
        $all=$request->all();
        $shop=Shop::all();
        $all = array_filter( $all, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        $card_buy=CardBuy::where('updated_at', '>', Carbon::today()->startOfMonth())->where('status','已支付');
        $stats=Order::where('updated_at', '>', Carbon::today()->startOfMonth())->where('status','已支付');

        if(array_key_exists('fendian',$all)){
            if($all['fendian']!='全部'){
                $stats=  $stats->where('shop_id', $all['fendian']);
                $card_buy=$card_buy->where('shop_id', $all['fendian']);
            }
        }
        $stats_dingdan_count=$stats->count();
        $stats_price_count=$stats->sum('price');
        $stats=$stats->orderBy('created_at','desc')->paginate(20);
        $card_buy_num=$card_buy->count();
        $card_buy_price=$card_buy->sum('price');

        return view('statics.month')
                ->with('stats',$stats)
                ->with('shop',$shop)
                ->with('card_buy',$card_buy)
                ->with('stats_dingdan_count',$stats_dingdan_count)
                ->with('stats_price_count',$stats_price_count)
                ->with('card_buy_num',$card_buy_num)
                ->with('card_buy_price',$card_buy_price)
                ->withInput(Input::all());
    }


    public function custom(Request $request){
        $all=$request->all();
        $shop=Shop::all();
        $all = array_filter( $all, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        $stats=Order::where('status','已支付');
        $card_buy=CardBuy::where('status','已支付');

        if (array_key_exists('create_start', $all)) {
            $stats = $stats->where('updated_at', '>=', Carbon::createFromFormat('Y-m-d', $all['create_start'])->setTime(0, 0, 0));
            $card_buy=$card_buy->where('updated_at', '>=', Carbon::createFromFormat('Y-m-d', $all['create_start'])->setTime(0, 0, 0));
        }
        if (array_key_exists('create_end', $all)) {
            $stats =  $stats->where('updated_at', '<', Carbon::createFromFormat('Y-m-d', $all['create_end'])->addDay()->setTime(0, 0, 0));
            $card_buy=$card_buy->where('updated_at', '<', Carbon::createFromFormat('Y-m-d', $all['create_end'])->addDay()->setTime(0, 0, 0));
        }
        if(array_key_exists('fendian',$all) && $all['fendian']!='全部'){
            $stats=   $stats->where('shop_id', $all['fendian']);
            $card_buy=$card_buy->where('shop_id', $all['fendian']);
        }
        $stats_dingdan_count=$stats->count();
        $stats_price_count=$stats->sum('price');
        $stats=$stats->orderBy('created_at','desc')->paginate(20);
        $card_buy_num=$card_buy->count();
        $card_buy_price=$card_buy->sum('price');

        return view('statics.custom')
                ->with('stats',$stats)
                ->with('shop',$shop)
                ->with('card_buy',$card_buy)
                ->with('stats_dingdan_count',$stats_dingdan_count)
                ->with('stats_price_count',$stats_price_count)
                ->with('card_buy_num',$card_buy_num)
                ->with('card_buy_price',$card_buy_price)
                ->withInput(Input::all());
    }


    public function highday2(){
        $users = User::withCount(['orders' => function ($query) {
            $query->whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('status','已支付');
        }])->get();

        $stats = $users->filter(function ($value, $key) {
            return $value->orders_count >= 2;
        });



//        $stats=  User::whereHas('orders', function ($q) {
//            $q->whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('status','已支付')->groupBy('user_id')->select(DB::raw('sum(user_id)'));
//        }, '>=', 2)->get();
        //dd($stats);
        return view('statics.onedyhign2')->with('stats',$stats);
    }

    public function allday2(){
        $stats=  User::whereHas('orders', function ($q) {
            $q->whereBetween('updated_at', [Carbon::today(), Carbon::tomorrow()])->where('status','已支付');
        }, '>=', 1)->whereHas('orders', function ($q) {
            $q->whereBetween('updated_at', [Carbon::yesterday(), Carbon::today()])->where('status','已支付');
        }, '>=', 1)->get();
        return view('statics.alldayhign2')->with('stats',$stats);
    }



}
