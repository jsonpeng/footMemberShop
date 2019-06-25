<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTuaninfoRequest;
use App\Http\Requests\UpdateTuaninfoRequest;
use App\Repositories\TuaninfoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use App\User;
use App\Models\products;
use App\Models\Tuaninfo;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class TuaninfoController extends AppBaseController
{
    /** @var  TuaninfoRepository */
    private $tuaninfoRepository;

    public function __construct(TuaninfoRepository $tuaninfoRepo)
    {
        $this->tuaninfoRepository = $tuaninfoRepo;
    }

    /**
     * Display a listing of the Tuaninfo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $all=$request->all();
        $this->tuaninfoRepository->pushCriteria(new RequestCriteria($request));
        $tuaninfos = Tuaninfo::where('id','>',0);
        $user=User::all();
        $product=products::all();
        $tuan_num=$tuaninfos->count();
        $tuan_man_num=$tuaninfos->sum('num');
        $tuan_all_price=0;
        $tuan_all_s=$tuaninfos->get();
        foreach ($tuan_all_s as $tuaninfo){
            if(!empty(products::find($tuaninfo->products_id))) {
                $one_price = products::where('id', $tuaninfo->products_id)->first()->price;
            }else{
                $one_price=0;
            }
            $tuan_all_price +=$tuaninfo->num*$one_price;
        }
        if(array_key_exists('product_name',$all)) {
            $products_rel=products::where('name','like','%'.$all['product_name'].'%')->first();
            if(!empty($products_rel)){
                $products_id=$products_rel->id;

                $tuaninfos=$tuaninfos->where('products_id',$products_id);
                $tuan_num=$tuaninfos->count();
                $tuan_man_num=$tuaninfos->sum('num');
                $tuan_all_price=0;
                foreach ($tuaninfos as $tuaninfo){
                    $one_price=products::where('id',$tuaninfo->products_id)->first()->price;
                    $tuan_all_price +=$tuaninfo->num*$one_price;
                }

            }
        }

        if (array_key_exists('create_start', $all)) {
            if(!empty($all['create_start'])) {
                $tuaninfos = $tuaninfos->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $all['create_start'])->setTime(0, 0, 0));
            }
        }
        if (array_key_exists('create_end', $all)) {
            if(!empty($all['create_end'])) {
                $tuaninfos = $tuaninfos->where('created_at', '<', Carbon::createFromFormat('Y-m-d', $all['create_end'])->addDay()->setTime(0, 0, 0));
            }

        }

            if(array_key_exists('create_start', $all)||array_key_exists('create_end', $all)){
                $tuan_num=$tuaninfos->count();
                $tuan_man_num=$tuaninfos->sum('num');
                $tuan_all_price=0;
                foreach ($tuaninfos->get() as $tuaninfo){
                    $one_price=products::where('id',$tuaninfo->products_id)->first()->price;
                    $tuan_all_price +=$tuaninfo->num*$one_price;
                }
            }

        if(count($tuaninfos)>0) {
            $tuaninfos = $tuaninfos->orderBy('created_at','desc')->paginate(10);
        }
        return view('tuaninfos.index')
                ->with('tuaninfos', $tuaninfos)
                ->with('user',$user)
                ->with('product',$product)
                ->with('tuan_num',$tuan_num)
                ->with('tuan_man_num',$tuan_man_num)
                ->with('tuan_all_price',$tuan_all_price)
                ->withInput(Input::all());
    }

    /**
     * Show the form for creating a new Tuaninfo.
     *
     * @return Response
     */
    public function create()
    {
        return view('tuaninfos.create');
    }

    /**
     * Store a newly created Tuaninfo in storage.
     *
     * @param CreateTuaninfoRequest $request
     *
     * @return Response
     */
    public function store(CreateTuaninfoRequest $request)
    {
        $input = $request->all();

        $tuaninfo = $this->tuaninfoRepository->create($input);

        Flash::success('Tuaninfo saved successfully.');

        return redirect(route('tuaninfos.index'));
    }

    /**
     * Display the specified Tuaninfo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tuaninfo = $this->tuaninfoRepository->findWithoutFail($id);

        if (empty($tuaninfo)) {
            Flash::error('Tuaninfo not found');

            return redirect(route('tuaninfos.index'));
        }

        return view('tuaninfos.show')->with('tuaninfo', $tuaninfo);
    }

    /**
     * Show the form for editing the specified Tuaninfo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tuaninfo = $this->tuaninfoRepository->findWithoutFail($id);

        if (empty($tuaninfo)) {
            Flash::error('Tuaninfo not found');

            return redirect(route('tuaninfos.index'));
        }

        return view('tuaninfos.edit')->with('tuaninfo', $tuaninfo);
    }

    /**
     * Update the specified Tuaninfo in storage.
     *
     * @param  int              $id
     * @param UpdateTuaninfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTuaninfoRequest $request)
    {
        $tuaninfo = $this->tuaninfoRepository->findWithoutFail($id);

        if (empty($tuaninfo)) {
            Flash::error('Tuaninfo not found');

            return redirect(route('tuaninfos.index'));
        }

        $tuaninfo = $this->tuaninfoRepository->update($request->all(), $id);

        Flash::success('Tuaninfo updated successfully.');

        return redirect(route('tuaninfos.index'));
    }

    /**
     * Remove the specified Tuaninfo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tuaninfo = $this->tuaninfoRepository->findWithoutFail($id);

        if (empty($tuaninfo)) {
            Flash::error('Tuaninfo not found');

            return redirect(route('tuaninfos.index'));
        }

        $this->tuaninfoRepository->delete($id);

        Flash::success('Tuaninfo deleted successfully.');

        return redirect(route('tuaninfos.index'));
    }
}
