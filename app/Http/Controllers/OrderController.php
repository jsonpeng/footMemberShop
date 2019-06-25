<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Order;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

use App\Models\Shop;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->orderRepository->pushCriteria(new RequestCriteria($request));
        //$orders = $this->orderRepository->all();
        $orders = Order::orderBy('created_at','desc');

        $input=$request->all();
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        if (array_key_exists('create_start', $input)) {
            $orders = $orders->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $input['create_start'])->setTime(0, 0, 0));
        }
        if (array_key_exists('create_end', $input)) {
            $orders = $orders->where('created_at', '<', Carbon::createFromFormat('Y-m-d', $input['create_end'])->addDay()->setTime(0, 0, 0));
        }
        if (array_key_exists('order_delivery', $input) && $input['order_delivery'] != "全部") {
            //if($input['order_delivery']=="全部"){
            //    $orders = $this->orderRepository->all();
            //}else{
                $orders=$orders->where('status',$input['order_delivery']);
            //}
        }
        if (array_key_exists('mobile', $input)) {
            $orders=  Order::whereHas('user', function ($q) {
                $q->where('mobile','like','%'.Input::get('mobile').'%');
            });
        }
        if (array_key_exists('uid', $input)) {
            $orders = $orders->where('user_id', $input['uid']);

        }
        if (array_key_exists('shop_id', $input) && $input['shop_id'] != 0) {
            $orders = $orders->where('shop_id', $input['shop_id']);

        }

        $shops = Shop::all();
        $orders=$orders->paginate(15);
        return view('orders.index')
            ->with('orders', $orders)->with('shops', $shops)->withInput(Input::all());
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('保存成功');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('订单信息不存在');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('订单信息不存在');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('订单信息不存在');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success('订单更新成功');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('订单信息不存在');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('订单删除成功');

        return redirect(route('orders.index'));
    }
}
