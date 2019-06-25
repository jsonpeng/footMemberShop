<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Tuaninfo;
use App\Models\account_user;
use App\Models\products;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            //从所有商品中找到对应团的信息
            $products=products::all();
            $tuan_arr=[];
            $times=0;
            /*
            foreach($products as $product) {
                //筛选出已拼满切未开奖的商品
                if ($product->chatuannum == '已拼满' && $product->hadwined !='是') {

                    //记录这个中奖的商品id
                    $products_id = $product->id;
                    //遍历该商品中所有团id信息
                    foreach ($product->tuaninfo()->get() as $tuan) {
                        array_push($tuan_arr, $tuan->id);
                    }
                    //取出其中的一个随机id
                    $tuan_id = $tuan_arr[array_rand($tuan_arr)];
                    //将这个中奖的团给予奖励

                    Tuaninfo::where('id', $tuan_id)->where('winner', '否')->where('whether_fanxian','否')->update([
                        'winner' => '是',
                    ]);

                }
                //将已经有人中奖的商品中未中奖的团进行返现
                if($product->hadwined =='是'){
                    $products_win_id=$product->id;
                    //取出未中奖切没返现的团
                   $not_fanxian_tuan=Tuaninfo::where('products_id',$products_win_id)->where('winner','否')->where('whether_fanxian','否')->get();
                    foreach($not_fanxian_tuan as $tuans){
                        $tuans->update([
                            'whether_fanxian'=>'是'
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
            }
            */

        //先把已经过期的且未返现的团标注出来
        $tuan_all=Tuaninfo::where('whether_fanxian','否')->where('winner','否')->get();
        foreach ($tuan_all as $tuan){
            if($tuan->whetherguoqi=='已过期'){
                $tuan->update([
                    'guoqi'=>'是',
                    'whether_fanxian'=>'是'
                ]);
                $price = $tuan->products->price;
                //更新该团的返现状态 已经返现过的团不能重复返现
                foreach ($tuan->users()->get() as $not_users) {
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
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
