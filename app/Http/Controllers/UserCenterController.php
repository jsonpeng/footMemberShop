<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Tuaninfo;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\account_user;
use App\Models\bankinfo;
use App\Models\TuanBuy;

class UserCenterController extends Controller
{
    //用户个人中心
    public function index(){
        $user= Auth::user();
        $account_price=$user->account_price;
        if($account_price==''){
            $account_price=0;
        }

        return view('front.usercenter')->with('account_price',$account_price)->with('user',$user);
    }

    //获取用户银行卡信息
    public function get_user_bankinfo(){
        $user= Auth::user();
        $bank_info=$user->bankinfo()->get();
        $status= $user->bankinfo()->count()>0?true:false;
        return ['status'=>$status,'msg'=>$bank_info];
    }

    //参与记录
    public  function mejoinlist(){
        $user= Auth::user();
        $tuan_list=Tuaninfo::all();
        $tuan_info='';
        $product=products::all();
        foreach ($tuan_list as $tuans){
            $userlist= $tuans->users()->get();
            foreach ($userlist as $user_lists){
                if($user_lists->id==$user->id){
                    //用户加入了该团
                    //return ['msg'=>'join'];
                    $tuan_info=  Tuaninfo::where([])->whereHas('users', function ($q) use($user) {
                        $q->where('user_id',$user->id);
                    })->orderBy('created_at','desc')->get();
                }
            }
        }
        return view('front.mejoinlist')->with('tuan_info',$tuan_info)->with('product',$product);
    }

    //用户钱包
    public function useraccount(){
        $user=Auth::user();
        $account_price=$user->account_price;
        if($account_price==''){
            $account_price=0;
        }
        return view('front.useraccount')->with('account_price',$account_price)->with('user',$user);
    }


    //用户银行卡管理
    public function bank_manage(){
        $bank_list=Auth::user()->bankinfo()->get();
        return view('front.bank_manage')->with('bank_list',$bank_list);
    }

    //删除银行卡
    public function del_bank_card(Request $request){
        $bankid=$request->get('bankid');
        bankinfo::find($bankid)->delete();
        return ['status'=>true,'msg'=>'删除成功'];
    }

    //账户充值
    public function recharge_account(Request $request){
        $user_id=Auth::user()->id;

        $price=$request->get('price');
        $type=$request->get('type');
        //return['status'=>true,'msg'=>$user_id];
        $account_user= account_user::create([
            'user_id'=>$user_id,
            'type'=>$type,
            'price'=>$price,
        ]);
        $yuan_price= User::where('id',$user_id)->first()->account_price;
        if($yuan_price==''){
            $yuan_price=0;
        }
        $account_user->update(['no' => $account_user->id.'_'.time(), 'account_tem'=>$yuan_price+$price,]);

        User::where('id',$user_id)->update([
            'account_price'=>$yuan_price+$price
        ]);
        return['status'=>true,'msg'=>'充值成功'];
    }

    //充值记录
    public function recharge_record(){
        $user=Auth::user();
        $user_id=$user->id;
        $account_record=account_user::where('user_id',$user_id)->where('type','账户充值')->orderBy('created_at','desc')->get();
        return view('front.record_recharge')->with('account_record',$account_record)->with('user',$user);
    }

    //提现记录
    public function withdraw_record(){
        $user=Auth::user();
        $user_id=$user->id;
        $account_record=account_user::where('user_id',$user_id)->where('type','账户提现')->orderBy('created_at','desc')->get();
        return view('front.record_withdraw')->with('account_record',$account_record)->with('user',$user);
    }

    //返现记录
    public function return_money(){
        $user=Auth::user();
        $user_id=$user->id;
        $account_record=account_user::where('user_id',$user_id)->where('type','账户返现')->orderBy('created_at','desc')->get();
        return view('front.return_money')->with('account_record',$account_record)->with('user',$user);
    }

    //提现详情
    public function withdraw_record_detail($no){
        $account_record=account_user::where('no',$no)->first();
        return view('front.record_withdraw_datail')->with('account_record',$account_record);
    }

    //消费记录
    public function consume_record(){
        $user_id=Auth::user()->id;
        $consume_record=TuanBuy::where('user_id',$user_id)->orderBy('created_at','desc')->get();
        return view('front.record_consume')->with('consume_record',$consume_record);
    }

    //绑定银行卡
    public function blind_bank_card(Request $request){
        $user_id=Auth::user()->id;
        $card_name=$request->get('bank_name');
        $starthu=$request->get('bank_kaihu');
        $user_name=$request->get('user_name');
        $user_mobile=$request->get('bank_mobile');
        $card_no=$request->get('bank_account');
        $type=$request->get('bank_type');
        bankinfo::create([
            'user_id'=>$user_id,
            'card_name'=>$card_name,
            'starthu'=>$starthu,
            'user_name'=>$user_name,
            'user_mobile'=>$user_mobile,
            'card_no'=>$card_no,
            'type'=>$type
        ]);
        return ['status'=>true,'msg'=>'绑定成功'];
    }

    //账户提现
    public function withdraw_account(Request $request){
        $user_id=Auth::user()->id;
        $bankinfo_id=$request->get('bankid');
        $price=$request->get('price');
        $type=$request->get('type');
        $status=$request->get('status');
        $yuan_price= User::where('id',$user_id)->first()->account_price;
        if($yuan_price==''){
            $yuan_price=0;
        }
        if($price>$yuan_price){
            return ['status'=>false,'msg'=>'您的余额不足以提现'];
        }

        $account_user= account_user::create([
            'user_id'=>$user_id,
            'type'=>$type,
            'price'=>$price,
            'status'=>$status,
            'bankinfo_id'=>$bankinfo_id,
        ]);
        $bankinfo=$account_user->bankinfo()->first();
        $account_user->update([
            'account_tem'=>$yuan_price-$price,
            'no' => $account_user->id.'_'.time(),
            'arrive_time'=>$account_user->created_at->addDay(),
            'card_name'=>$bankinfo->card_name,
            'starthu'=>$bankinfo->starthu,
            'user_name'=>$bankinfo->user_name,
            'user_mobile'=>$bankinfo->user_mobile,
            'card_no'=>$bankinfo->card_no,
        ]);
        //  $account_user->update(['no' => '200000'.$account_user->id,'arrive_time'=>$account_user->created_at->addDay()]);

        User::where('id',$user_id)->update([
            'account_price'=>$yuan_price-$price
        ]);

        return['status'=>true,'msg'=>'发起提现,等待处理,预计到达时间为'.$account_user->arrive_time];
    }

    //success_callback
    public function success_callback(Request $request){
        $msg=$request->get('text');
        $info=$request->get('info');
        return view('front.success');
    }
}
