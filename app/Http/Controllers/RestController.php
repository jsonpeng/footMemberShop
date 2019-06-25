<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use App\Models\products;
use App\Models\Tuaninfo;
use App\Models\tuansetting;
use App\Models\product_images;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class RestController extends Controller
{
    //用户开团
    public function KaiProductTuan(Request $request){
        $product_id=$request->get('product_id');
        $name=$request->get('name');
        $uid=$request->get('uid');
        $end_time=$request->get('end_time');

        $tuan_this=  Tuaninfo::create([
                'products_id' => $product_id,
                'status' => '已开团',
                'name' => $name,
                'man_num'=>products::find($product_id)->man_num,
                'num'=>1,
                'end_time'=>$end_time,
                'guoqi'=>'否'
        ]);
        $products=products::find($product_id);
        $product_name=$products->name;
        $tuan_this->update(['name'=>$product_name.$tuan_this->id.'团']);
        $tuan_this->users()->sync([$uid]);
//        if($products->chatuannum == '已拼满'){
//            \Illuminate\Support\Facades\Artisan::call('schedule:run');
//        }

        return ['status'=>true,'msg'=>$end_time];
    }

    //用户参团
    public function JoinProductTuan(Request $request){
        $tuan_id=$request->get('tuan_id');
        $uid=$request->get('uid');
        //获取当前团的信息
        $tuan_info=Tuaninfo::where('id',$tuan_id)->first();
        $products=products::find($tuan_info->products_id);
        $num=$tuan_info->num;
        $num_update=$num+1;

        $user_id_list=[];
        $user_id_arr= $tuan_info->users()->get();
        foreach ($user_id_arr as $arr){
            array_push($user_id_list,$arr->id);
        }
        array_push($user_id_list,$uid);

        Tuaninfo::where('id', $tuan_id)->update([
            'num'=>$num_update,
        ]);
        $max_tuan_num=$products->man_num;
        if($num_update>=$max_tuan_num){
            Tuaninfo::where('id', $tuan_id)->update([
                'status'=>'参团人数已满',
            ]);
        }
       $tuan_info->users()->sync($user_id_list);
//        if($products->chatuannum == '已拼满'){
//            \Illuminate\Support\Facades\Artisan::call('schedule:run');
//        }
        return ['status'=>true,'msg'=>'参团成功'];
    }

    //验证开团状态
    public function varifyKaituan(Request $request){
        $product_id=$request->get('product_id');
        $tuan_limit_num=products::find($product_id)->tuan_num;
        $man_limit_num=products::find($product_id)->man_num;
        $tuan_num=Tuaninfo::where('products_id',$product_id)->where('num',$man_limit_num)->where('guoqi','否')->count();
        if($tuan_num>=$tuan_limit_num){
            return ['status'=>false,'msg'=>'当前团已达到上限,无法继续开团'];
        }
        if(products::find($product_id)->chatuannum=='已拼满'){
            return ['status'=>false,'msg'=>'当前商品已拼满,请选择其他的团参加'];
        }
        return ['status'=>true,'msg'=>'通过开团'];
    }

    //验证手机号
    public function varifyMobile(Request $request){
        $uid=$request->get('uid');
        $mobile=$request->get('mobile');
        User::where('id',$uid)->update(['mobile'=>$mobile]);
        return ['status'=>true,'msg'=>'手机号验证成功'];
    }

    //验证参团状态
    public function varifyCantuan(Request $request){
        $tuan_id=$request->get('tuan_id');
        $uid=$request->get('uid');
        $product_id=$request->get('product_id');
        //获取当前团的信息
        $tuan_info=Tuaninfo::where('id',$tuan_id)->first();
          //获取团设置单个团的最大参团人数
         $man_limit_num=products::find($product_id)->man_num;
        $user_id_list=[];
        $user_id_arr= $tuan_info->users()->get();
        foreach ($user_id_arr as $arr){
            if($uid==$arr->id){
                return ['status'=>false,'msg'=>'您已参加过该团,请选择其他的团参加'];
            }
            array_push($user_id_list,$arr->id);
        }
        array_push($user_id_list,$uid);

        if(count($user_id_list)>$man_limit_num){
            Tuaninfo::where('id',$tuan_id)->update(['status'=>'参团人数已满']);
            return ['status'=>false,'msg'=>'参团人数已满,请选择其他的团参加'];

        }
        if(products::find($product_id)->chatuannum=='已拼满'){
            return ['status'=>false,'msg'=>'当前商品已拼满,请选择其他的团参加'];
        }
        return ['status'=>true,'msg'=>'通过参团'];
    }

    //上传多张产品图片
    public function productImages(Request $request){
        $url=$request->get('url');
        $products_id=$request->get('product_id');
        $products=product_images::create([
            'url'=>$url,
            'products_id'=>$products_id
        ]);
        return ['msg'=>'','status'=>true,'url'=>$products->url,'id'=>$products->id];

    }

    //删除产品的图片
    public function delProductImage($id){
        product_images::where('id',$id)->delete();
        return ['msg'=>'','status'=>true];
    }

    //上传图片
    public function  uploadimg(){
        $file = Input::file('thumbnail');;
        $allowed_extensions = ["png", "jpg", "gif"];
//        return response()->json([
//            'error' => false,
//            'path' => $file,
//        ]);

        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $host="/";
        // DB::insert('insert into articles (load_url) VALUES (?)',[$host.$destinationPath.$fileName]);

        return response()->json([
            'error' => false,
            'path' => $host.$destinationPath.$fileName,
        ]);
    }

    //从余额中扣除
    public  function updateAccountprice(Request $request){
        $user=Auth::user();
        $price=$request->get('price');
        $user->update([
           'account_price'=>$user->account_price-$price
        ]);
        return ['status'=>true,'msg'=>''];
    }

    public function zhongjiang(Request $request){
        $products=products::find($request->get('product_id'));
        $tuan_id=$request->get('tuan_id');
        if($products->chatuannum == '已拼满'){
            Tuaninfo::where('id', $tuan_id)->update([
                'winner' => '是',
            ]);
            if($products->hadwined =='是'){
                $products_win_id=$request->get('product_id');
                //取出未中奖切没返现的团
                $not_fanxian_tuan=Tuaninfo::where('products_id',$products_win_id)->where('winner','否')->where('whether_fanxian','否')->get();
                foreach($not_fanxian_tuan as $tuans) {
                    $tuans->update([
                        'whether_fanxian' => '是'
                    ]);
                    $price = $tuans->products->price;
                    foreach ($tuans->users()->get() as $not_users) {
                        $accout_user = account_user::create([
                            'user_id' => $not_users->id,
                            'type' => '账户返现',
                            'price' => $price
                        ]);
                        $accout_user->update(['no' => $accout_user->id . '_' . time()]);
                        $not_users->update(['account_price' => $not_users->account_price + $price]);
                    }
                }
                }
            return ['status'=>true,'msg'=>'设置中奖成功'];
        }else{
            return ['status'=>false,'msg'=>'当前商品还未拼满,无法中奖'];
        }
    }

}
