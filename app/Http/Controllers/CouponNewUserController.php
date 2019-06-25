<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCouponNewUserRequest;
use App\Http\Requests\UpdateCouponNewUserRequest;
use App\Repositories\CouponNewUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\CouponNewUser;

class CouponNewUserController extends AppBaseController
{
    /** @var  CouponNewUserRepository */
    private $couponNewUserRepository;

    public function __construct(CouponNewUserRepository $couponNewUserRepo)
    {
        $this->couponNewUserRepository = $couponNewUserRepo;
    }

    /**
     * Display a listing of the CouponNewUser.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->couponNewUserRepository->pushCriteria(new RequestCriteria($request));
        //$couponNewUsers = $this->couponNewUserRepository->all();
        $couponNewUser = CouponNewUser::first();
        if (is_null($couponNewUser)) {
            $couponNewUser = CouponNewUser::create([
                'new_open' => 0,
            ]);
        }

        return view('coupon_new_users.index')
            ->with('couponNewUser', $couponNewUser);
    }

    /**
     * Show the form for creating a new CouponNewUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('coupon_new_users.create');
    }

    /**
     * Store a newly created CouponNewUser in storage.
     *
     * @param CreateCouponNewUserRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponNewUserRequest $request)
    {
        $input = $request->all();

        $couponNewUser = $this->couponNewUserRepository->create($input);

        Flash::success('Coupon New User saved successfully.');

        return redirect(route('couponNewUsers.index'));
    }

    /**
     * Display the specified CouponNewUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $couponNewUser = $this->couponNewUserRepository->findWithoutFail($id);

        if (empty($couponNewUser)) {
            Flash::error('Coupon New User not found');

            return redirect(route('couponNewUsers.index'));
        }

        return view('coupon_new_users.show')->with('couponNewUser', $couponNewUser);
    }

    /**
     * Show the form for editing the specified CouponNewUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $couponNewUser = $this->couponNewUserRepository->findWithoutFail($id);

        if (empty($couponNewUser)) {
            Flash::error('Coupon New User not found');

            return redirect(route('couponNewUsers.index'));
        }

        return view('coupon_new_users.edit')->with('couponNewUser', $couponNewUser);
    }

    /**
     * Update the specified CouponNewUser in storage.
     *
     * @param  int              $id
     * @param UpdateCouponNewUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponNewUserRequest $request)
    {
        $couponNewUser = $this->couponNewUserRepository->findWithoutFail($id);

        if (empty($couponNewUser)) {
            Flash::error('Coupon New User not found');

            return redirect(route('couponNewUsers.index'));
        }

        $couponNewUser = $this->couponNewUserRepository->update($request->all(), $id);

        Flash::success('设置成功');

        return redirect(route('couponNewUsers.index'));
    }

    /**
     * Remove the specified CouponNewUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $couponNewUser = $this->couponNewUserRepository->findWithoutFail($id);

        if (empty($couponNewUser)) {
            Flash::error('Coupon New User not found');

            return redirect(route('couponNewUsers.index'));
        }

        $this->couponNewUserRepository->delete($id);

        Flash::success('Coupon New User deleted successfully.');

        return redirect(route('couponNewUsers.index'));
    }
}
