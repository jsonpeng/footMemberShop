<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createaccount_userRequest;
use App\Http\Requests\Updateaccount_userRequest;
use App\Repositories\account_userRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\account_user;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class account_userController extends AppBaseController
{
    /** @var  account_userRepository */
    private $accountUserRepository;

    public function __construct(account_userRepository $accountUserRepo)
    {
        $this->accountUserRepository = $accountUserRepo;
    }

    /**
     * Display a listing of the account_user.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountUserRepository->pushCriteria(new RequestCriteria($request));
        $accountUsers = account_user::where('id','>',0)->orderBy('created_at','desc')->paginate(20);
        $chongzhi_price=account_user::where('type','账户充值')->sum('price');
        $tixian_price=account_user::where('type','账户提现')->sum('price');
        $fanxian_price=account_user::where('type','账户返现')->sum('price');
        return view('account_users.index')
                 ->with('accountUsers', $accountUsers)
                 ->with('tixian_price',$tixian_price)
                 ->with('zong_price',$chongzhi_price)
                ->with('fanxian_price',$fanxian_price);
    }

    /**
     * Show the form for creating a new account_user.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_users.create');
    }

    /**
     * Store a newly created account_user in storage.
     *
     * @param Createaccount_userRequest $request
     *
     * @return Response
     */
    public function store(Createaccount_userRequest $request)
    {
        $input = $request->all();

        $accountUser = $this->accountUserRepository->create($input);

        Flash::success('Account User saved successfully.');

        return redirect(route('accountUsers.index'));
    }

    /**
     * Display the specified account_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountUser = $this->accountUserRepository->findWithoutFail($id);

        if (empty($accountUser)) {
            Flash::error('Account User not found');

            return redirect(route('accountUsers.index'));
        }

        return view('account_users.show')->with('accountUser', $accountUser);
    }

    /**
     * Show the form for editing the specified account_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountUser = $this->accountUserRepository->findWithoutFail($id);

        if (empty($accountUser)) {
            Flash::error('Account User not found');

            return redirect(route('accountUsers.index'));
        }

        return view('account_users.edit')->with('accountUser', $accountUser);
    }

    /**
     * Update the specified account_user in storage.
     *
     * @param  int              $id
     * @param Updateaccount_userRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaccount_userRequest $request)
    {
        $accountUser = $this->accountUserRepository->findWithoutFail($id);
        $all=$request->all();
        if (empty($accountUser)) {
            Flash::error('Account User not found');

            return redirect(route('accountUsers.index'));
        }

        $accountUser = $this->accountUserRepository->update($all, $id);

        Flash::success('操作用户状态成功.');


        return redirect(route('accountUsers.index'));
    }

    /**
     * Remove the specified account_user from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountUser = $this->accountUserRepository->findWithoutFail($id);

        if (empty($accountUser)) {
            Flash::error('Account User not found');

            return redirect(route('accountUsers.index'));
        }

        $this->accountUserRepository->delete($id);

        Flash::success('Account User deleted successfully.');

        return redirect(route('accountUsers.index'));
    }
}
