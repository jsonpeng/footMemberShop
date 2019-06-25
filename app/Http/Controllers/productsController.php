<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductsRequest;
use App\Http\Requests\UpdateproductsRequest;
use App\Repositories\productsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\cats;
use App\Models\products;
use App\Models\Tuaninfo;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class productsController extends AppBaseController
{
    /** @var  productsRepository */
    private $productsRepository;

    public function __construct(productsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    /**
     * Display a listing of the products.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $products =products::where('id','>',0);
        $products=$products->orderBy('created_at','desc')->paginate(20);
        return view('products.index')
            ->with('products', $products);
    }



    /**
     * Show the form for creating a new products.
     *
     * @return Response
     */
    public function create()
    {
        $cats=cats::all();
        return view('products.create')->with('cats',$cats);
    }

    /**
     * Store a newly created products in storage.
     *
     * @param CreateproductsRequest $request
     *
     * @return Response
     */
    public function store(CreateproductsRequest $request)
    {
        $request['img_content']=str_replace('../../..','/',$request['img_content']);
        $input = $request->all();

        $products = $this->productsRepository->create($input);
        //return $input['cats'];
        if ( array_key_exists('cats', $input) ) {
            $products->cats()->sync($input['cats']);
        }
        Flash::success('商品信息更新成功');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified products.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $products = $this->productsRepository->findWithoutFail($id);

        if (empty($products)) {
            Flash::error('没有找到该商品');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('products', $products);
    }

    /**
     * Show the form for editing the specified products.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $products = $this->productsRepository->findWithoutFail($id);

        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }
        $cats=cats::all();
        $selectedcats=[];
        $select_cat=products::find($id)->cats()->get();
        for($i =0;$i<count($select_cat);$i++){
            Array_push($selectedcats,$select_cat[$i]->id);
        }


        return view('products.edit')->with('products', $products)->with('cats',$cats)->with('selectedcats',$selectedcats);
    }

    /**
     * Update the specified products in storage.
     *
     * @param  int              $id
     * @param UpdateproductsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductsRequest $request)
    {
        $products = $this->productsRepository->findWithoutFail($id);
        $request['img_content']=str_replace('../../..','/',$request['img_content']);
        $input = $request->all();
        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }

        $products = $this->productsRepository->update($request->all(), $id);
        if ( array_key_exists('cats', $input) ) {
            $products->cats()->sync($input['cats']);
        }else{
            $products->cats()->sync([]);
        }
        Flash::success('商品信息更新成功');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified products from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $products = $this->productsRepository->findWithoutFail($id);

        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }

        $this->productsRepository->update(['deleted'=>'是'],$id);
       // $products->cats()->sync([]);
        Flash::success('商品删除成功');
        //Tuaninfo::where('products_id',$id)->delete();
        return redirect(route('products.index'));
    }

    //商品回收站
    public function recycle(){
        $products=products::where('deleted','是')->orderBy('created_at','desc')->get();
        return view('products.recycle')
                ->with('products',$products);
    }

    //商品恢复
    public function recover($id){
        products::where('id',$id)->update([
           'deleted'=>'否'
        ]);
        return redirect(route('products.index'));

    }


}
