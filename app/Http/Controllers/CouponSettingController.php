<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCouponSettingRequest;
use App\Http\Requests\UpdateCouponSettingRequest;
use App\Repositories\CouponSettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Coupon;

class CouponSettingController extends AppBaseController
{
    /** @var  CouponSettingRepository */
    private $couponSettingRepository;

    public function __construct(CouponSettingRepository $couponSettingRepo)
    {
        $this->couponSettingRepository = $couponSettingRepo;
    }

    /**
     * Display a listing of the CouponSetting.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->couponSettingRepository->pushCriteria(new RequestCriteria($request));
        $couponSettings = $this->couponSettingRepository->all();

        return view('coupon_settings.index')
            ->with('couponSettings', $couponSettings);
    }

    /**
     * Show the form for creating a new CouponSetting.
     *
     * @return Response
     */
    public function create()
    {
        $coupons = Coupon::all();
        return view('coupon_settings.create')->with('coupons', $coupons);
    }

    /**
     * Store a newly created CouponSetting in storage.
     *
     * @param CreateCouponSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponSettingRequest $request)
    {
        $input = $request->all();

        $couponSetting = $this->couponSettingRepository->create($input);

        Flash::success('设置成功');

        return redirect(route('couponSettings.index'));
    }

    /**
     * Display the specified CouponSetting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $couponSetting = $this->couponSettingRepository->findWithoutFail($id);

        if (empty($couponSetting)) {
            Flash::error('信息不存在');

            return redirect(route('couponSettings.index'));
        }

        return view('coupon_settings.show')->with('couponSetting', $couponSetting);
    }

    /**
     * Show the form for editing the specified CouponSetting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $couponSetting = $this->couponSettingRepository->findWithoutFail($id);

        if (empty($couponSetting)) {
            Flash::error('信息不存在');

            return redirect(route('couponSettings.index'));
        }

        $coupons = Coupon::all();

        return view('coupon_settings.edit')->with('couponSetting', $couponSetting)->with('coupons', $coupons);
    }

    /**
     * Update the specified CouponSetting in storage.
     *
     * @param  int              $id
     * @param UpdateCouponSettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponSettingRequest $request)
    {
        $couponSetting = $this->couponSettingRepository->findWithoutFail($id);

        if (empty($couponSetting)) {
            Flash::error('信息不存在');

            return redirect(route('couponSettings.index'));
        }

        $couponSetting = $this->couponSettingRepository->update($request->all(), $id);

        Flash::success('更新成功');

        return redirect(route('couponSettings.index'));
    }

    /**
     * Remove the specified CouponSetting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $couponSetting = $this->couponSettingRepository->findWithoutFail($id);

        if (empty($couponSetting)) {
            Flash::error('信息不存在');

            return redirect(route('couponSettings.index'));
        }

        $this->couponSettingRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('couponSettings.index'));
    }
}
