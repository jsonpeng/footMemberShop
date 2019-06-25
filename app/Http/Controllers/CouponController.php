<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\Order;
use App\User;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\MemberCard;
use DB;

class CouponController extends AppBaseController
{
    /** @var  CouponRepository */
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }

    /**
     * Display a listing of the Coupon.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->couponRepository->pushCriteria(new RequestCriteria($request));
        $coupons = $this->couponRepository->all();

        return view('coupons.index')
            ->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param CreateCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
        $input = $request->all();

        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        $coupon = $this->couponRepository->create($input);

        Flash::success('优惠券创建成功');

        return redirect(route('coupons.index'));
    }

    /**
     * Display the specified Coupon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            Flash::error('优惠券不存在');

            return redirect(route('coupons.index'));
        }

        return view('coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            Flash::error('优惠券不存在');

            return redirect(route('coupons.index'));
        }

        return view('coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param  int              $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            Flash::error('优惠券不存在');

            return redirect(route('coupons.index'));
        }

        $coupon = $this->couponRepository->update($request->all(), $id);

        Flash::success('优惠券更新成功');

        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            Flash::error('优惠券不存在');

            return redirect(route('coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success('优惠券删除成功');

        return redirect(route('coupons.index'));
    }


    public function giveCoupon(Request $request){
        $input = $request->all();
        //处理用户输入
        if (!$request->has('time_start')) {
            //$input['time_start'] = Carbon::today();
            $input['time_start'] = Carbon::createFromDate(2016, 1, 1);
        }

        if (!$request->has('time_end')) {
            $input['time_end'] = Carbon::tomorrow();
        }

        if ($request->has('jine')) {
            $input['jine'] = floatval($request->input('jine'));
        }else{
            $input['jine'] = 0;
        }

        if ($request->has('times')) {
            $input['times'] = floatval($request->input('times'));
        }else{
            $input['times'] = 0;
        }
/*
        $users = DB::table('users')
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->select(DB::raw('count(*) as user_count, user_id, sum(price) as amount'))
            ->get();
            dd($users);
*/

        $orders = Order::whereBetween('updated_at', [$input['time_start'], $input['time_end']])
           ->where('status','已支付')
           ->select(DB::raw('count(*) as user_count, user_id, sum(price) as amount'))
           ->groupBy('user_id')
           ->get();
        
        //消费金额过滤
        $orders = $orders->filter(function ($value, $key) use ($input) {
            return $value->user_count >= $input['times'] && $value->amount >= $input['jine'];
        });

        $coupons = Coupon::where(function($query){ 
            $query->where('time_end', '>', Carbon::today())->where('time_type', '固定日期')->orWhere('time_type', '固定天数');  
        })->where('type', '<>', '生日券')->get();

        //没有消费过的用户
        $users = [];
        $user_ids = [];
        if ($input['jine'] == 0 || $input['times'] == 0) {
            foreach ($orders as $order) {
                array_push($user_ids, $order->user_id);
            }
            //购买过会员卡的客户
            $tmp_mem_cards = MemberCard::where('end', '>', Carbon::now())->select('user_id')->get();
            $user_hascard_ids = [];
            foreach ($tmp_mem_cards as $tmp_mem_card) {
                array_push($user_hascard_ids, $tmp_mem_card->user_id);
            }

            $users = User::whereNotIn('id', $user_ids)->whereIn('id', $user_hascard_ids)->where('mobile', '<>', '')->select('id', 'nickname', 'mobile')->get();
        }

        return view('coupons.coupon_given')->with('orders', $orders)->with('coupons', $coupons)->with('users', $users)->withInput($input);
    }

    public function giveCouponPost(Request $request)
    {
        $input = $request->all();
        //是否选择了用户
        if (!$request->has('users')) {
            Flash::error('请选择用户');
            return redirect(route('coupons.giveCoupon'));
        }
        if (!$request->has('coupon_count')) {
            Flash::error('请设置赠送优惠券数量');
            return redirect(route('coupons.giveCoupon'));
        }
        // 取得要赠送的优惠券
        $coupon = null;
        if ($request->has('coupon_id')) {
            $coupon = Coupon::find($input['coupon_id']);
        }else{
            Flash::error('优惠券不存在');
            return redirect(route('coupons.giveCoupon'));
        }

        //发券
        foreach ($input['users'] as $key => $value) {
            //计算优惠券过期时间
            for ($i=0; $i < $input['coupon_count']; $i++) { 
                $this->createFromCoupon($coupon, $value);
            }
        }

        return redirect(route('couponUsers.index'));
    }


    private function createFromCoupon($coupon, $user_id){

        $input = array();
        $input['name'] = $coupon->name;
        $input['time_begin'] = Carbon::tomorrow();
        if ('固定天数' == $coupon->time_type) {
            $dt = Carbon::now();
            $dt->addDays($coupon->expired_days);
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

        return CouponUser::create($input);
    }
}
