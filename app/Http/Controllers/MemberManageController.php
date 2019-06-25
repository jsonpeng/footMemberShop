<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use Flash;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;

class MemberManageController extends Controller
{
    //
    public function index(Request $request)
    {
        $user=User::where('type','会员');
        $all=$request->all();


        $all = array_filter( $all, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );
        
        $range = Carbon::now();

        if (array_key_exists('name', $all)) {
            $user = $user->where('nickname','like','%'.$all['name'].'%');
        }

        if (array_key_exists('moblie', $all)) {
            $user = $user->where('mobile','like','%'.$all['mobile'].'%');
        }

        if (array_key_exists('status',$all)){
            if($all['status']!='全部'){
                $user = $user->where('status', $all['status']);
            }
        }

        $users=$user->orderBy('created_at','desc')->paginate(20);


        return view('member_manage.index')->with('user',$users)->withInput(Input::all());

    }


    public function create()
    {
        return view('member_manage.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        //return $input;
        User::create($input);

        Flash::success('会员创建成功');

        return redirect(route('memberManage.index'));
    }

    public function destroy($id)
    {
        $user=User::find($id);
        if (empty($user)) {
            Flash::error('会员不存在');

            return redirect(route('memberManage.index'));
        }

        $user->delete();

        Flash::success('会员删除成功.');

        return redirect(route('memberManage.index'));
    }


    public function edit($id)
    {

        $user=User::find($id);
        if (empty($user)) {
            Flash::error('会员不存在');

            return redirect(route('memberManage.index'));
        }
        $status=$user->status;
        $selectedCount=[];
        $status_all=['禁止','开启'];
        for($i =0;$i<count($status_all);$i++){
            Array_push($selectedCount,$status_all[$i]);
        }


        return view('member_manage.edit')->with('user', $user)->with('status',$status);
    }


    public function update($id, Request $request)
    {
        $user=User::find($id);
        if (empty($user)) {
            Flash::error('会员不存在');

            return redirect(route('memberManage.index'));
        }
        unset($request['_method']);
        unset($request['_token']);
        User::where('id',$id)->update($request->all());

        Flash::success('会员信息更新成功');

        return redirect(route('memberManage.index'));
    }

}
