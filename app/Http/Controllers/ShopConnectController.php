<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopConnectRequest;
use App\Http\Requests\UpdateShopConnectRequest;
use App\Repositories\ShopConnectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Shop;

class ShopConnectController extends AppBaseController
{
    /** @var  ShopConnectRepository */
    private $shopConnectRepository;

    public function __construct(ShopConnectRepository $shopConnectRepo)
    {
        $this->shopConnectRepository = $shopConnectRepo;
    }

    /**
     * Display a listing of the ShopConnect.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->shopConnectRepository->pushCriteria(new RequestCriteria($request));
        $shopConnects = $this->shopConnectRepository->all();

        return view('shop_connects.index')
            ->with('shopConnects', $shopConnects);
    }

    /**
     * Show the form for creating a new ShopConnect.
     *
     * @return Response
     */
    public function create()
    {
        $shopes = Shop::all();

        $shops = array();
        foreach ($shopes as $shop) {
            $shops[$shop->id] = $shop->name;
        }
        return view('shop_connects.create')->with('shops', $shops);
    }

    /**
     * Store a newly created ShopConnect in storage.
     *
     * @param CreateShopConnectRequest $request
     *
     * @return Response
     */
    public function store(CreateShopConnectRequest $request)
    {
        $input = $request->all();

        $shopConnect = $this->shopConnectRepository->create($input);

        Flash::success('Shop Connect saved successfully.');

        return redirect(route('shopConnects.index'));
    }

    /**
     * Display the specified ShopConnect.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shopConnect = $this->shopConnectRepository->findWithoutFail($id);

        if (empty($shopConnect)) {
            Flash::error('Shop Connect not found');

            return redirect(route('shopConnects.index'));
        }

        return view('shop_connects.show')->with('shopConnect', $shopConnect);
    }

    /**
     * Show the form for editing the specified ShopConnect.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shopConnect = $this->shopConnectRepository->findWithoutFail($id);

        if (empty($shopConnect)) {
            Flash::error('Shop Connect not found');

            return redirect(route('shopConnects.index'));
        }

        $shopes = Shop::all();

        $shops = array();
        foreach ($shopes as $shop) {
            $shops[$shop->id] = $shop->name;
        }

        return view('shop_connects.edit')->with('shopConnect', $shopConnect)->with('shops', $shops);
    }

    /**
     * Update the specified ShopConnect in storage.
     *
     * @param  int              $id
     * @param UpdateShopConnectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShopConnectRequest $request)
    {
        $shopConnect = $this->shopConnectRepository->findWithoutFail($id);

        if (empty($shopConnect)) {
            Flash::error('Shop Connect not found');

            return redirect(route('shopConnects.index'));
        }

        $shopConnect = $this->shopConnectRepository->update($request->all(), $id);

        Flash::success('Shop Connect updated successfully.');

        return redirect(route('shopConnects.index'));
    }

    /**
     * Remove the specified ShopConnect from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shopConnect = $this->shopConnectRepository->findWithoutFail($id);

        if (empty($shopConnect)) {
            Flash::error('Shop Connect not found');

            return redirect(route('shopConnects.index'));
        }

        $this->shopConnectRepository->delete($id);

        Flash::success('Shop Connect deleted successfully.');

        return redirect(route('shopConnects.index'));
    }
}
