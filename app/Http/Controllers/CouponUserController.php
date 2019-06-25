<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCouponUserRequest;
use App\Http\Requests\UpdateCouponUserRequest;
use App\Repositories\CouponUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\CouponUser;
use Carbon\Carbon;
use DB;

class CouponUserController extends AppBaseController
{
    /** @var  CouponUserRepository */
    private $couponUserRepository;

    public function __construct(CouponUserRepository $couponUserRepo)
    {
        $this->couponUserRepository = $couponUserRepo;
    }

    /**
     * Display a listing of the CouponUser.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->couponUserRepository->pushCriteria(new RequestCriteria($request));
        //$couponUsers = $this->couponUserRepository->all();


        $input = $request->all();
        //处理用户输入
        if (!$request->has('time_start')) {
            $input['time_start'] = Carbon::createFromDate(2016, 1, 1);
        }

        if (!$request->has('time_end')) {
            $input['time_end'] = Carbon::tomorrow();
        }
        //未过期未使用
        $coupons01 = CouponUser::whereBetween('created_at', [$input['time_start'], $input['time_end']])
            ->where('status','未使用')
            ->where('time_end', '>=', Carbon::today())
            ->select(DB::raw('count(*) as count, name, type, sum(given) as amount'))
            ->groupBy('name', 'type')->get();
        //过期未使用
        $coupons02 = CouponUser::whereBetween('created_at', [$input['time_start'], $input['time_end']])
            ->where('status','未使用')
            ->where('time_end', '<', Carbon::today())
            ->select(DB::raw('count(*) as count, name, type, sum(given) as amount'))
            ->groupBy('name', 'type')->get();
        //已使用
        $coupons03 = CouponUser::whereBetween('created_at', [$input['time_start'], $input['time_end']])
            ->where('status','已使用')
            ->select(DB::raw('count(*) as count, name, type, sum(given) as amount'))
            ->groupBy('name', 'type')->get();

        //$couponUsers = CouponUser::orderBy('created_at', 'desc')->paginate(15);
        return view('coupon_users.index')
            ->with('coupons01', $coupons01)->with('coupons02', $coupons02)->with('coupons03', $coupons03)->withInput($input);
    }

    /**
     * Show the form for creating a new CouponUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('coupon_users.create');
    }

    /**
     * Store a newly created CouponUser in storage.
     *
     * @param CreateCouponUserRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponUserRequest $request)
    {
        $input = $request->all();

        $couponUser = $this->couponUserRepository->create($input);

        Flash::success('保存成功');

        return redirect(route('couponUsers.index'));
    }

    /**
     * Display the specified CouponUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $couponUser = $this->couponUserRepository->findWithoutFail($id);

        if (empty($couponUser)) {
            Flash::error('优惠券不存在');

            return redirect(route('couponUsers.index'));
        }

        return view('coupon_users.show')->with('couponUser', $couponUser);
    }

    /**
     * Show the form for editing the specified CouponUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $couponUser = $this->couponUserRepository->findWithoutFail($id);

        if (empty($couponUser)) {
            Flash::error('优惠券不存在');

            return redirect(route('couponUsers.index'));
        }

        return view('coupon_users.edit')->with('couponUser', $couponUser);
    }

    /**
     * Update the specified CouponUser in storage.
     *
     * @param  int              $id
     * @param UpdateCouponUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponUserRequest $request)
    {
        $couponUser = $this->couponUserRepository->findWithoutFail($id);

        if (empty($couponUser)) {
            Flash::error('优惠券不存在');

            return redirect(route('couponUsers.index'));
        }

        $couponUser = $this->couponUserRepository->update($request->all(), $id);

        Flash::success('更新成功');

        return redirect(route('couponUsers.index'));
    }

    /**
     * Remove the specified CouponUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $couponUser = $this->couponUserRepository->findWithoutFail($id);

        if (empty($couponUser)) {
            Flash::error('优惠券不存在');

            return redirect(route('couponUsers.index'));
        }

        $this->couponUserRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('couponUsers.index'));
    }
}
