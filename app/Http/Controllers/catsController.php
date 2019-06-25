<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecatsRequest;
use App\Http\Requests\UpdatecatsRequest;
use App\Repositories\catsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\cats;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class catsController extends AppBaseController
{
    /** @var  catsRepository */
    private $catsRepository;

    public function __construct(catsRepository $catsRepo)
    {
        $this->catsRepository = $catsRepo;
    }

    /**
     * Display a listing of the cats.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cats=cats::where('id','>',0);
        $cats=$cats->paginate(20);
        return view('cats.index')
            ->with('cats', $cats);
    }

    /**
     * Show the form for creating a new cats.
     *
     * @return Response
     */
    public function create()
    {
        return view('cats.create');
    }

    /**
     * Store a newly created cats in storage.
     *
     * @param CreatecatsRequest $request
     *
     * @return Response
     */
    public function store(CreatecatsRequest $request)
    {
        $input = $request->all();

        $cats = $this->catsRepository->create($input);

        Flash::success('商品分类更新成功');

        return redirect(route('cats.index'));
    }

    /**
     * Display the specified cats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('Cats not found');

            return redirect(route('cats.index'));
        }

        return view('cats.show')->with('cats', $cats);
    }

    /**
     * Show the form for editing the specified cats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('Cats not found');

            return redirect(route('cats.index'));
        }

        return view('cats.edit')->with('cats', $cats);
    }

    /**
     * Update the specified cats in storage.
     *
     * @param  int              $id
     * @param UpdatecatsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecatsRequest $request)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('Cats not found');

            return redirect(route('cats.index'));
        }

        $cats = $this->catsRepository->update($request->all(), $id);

        Flash::success('商品分类更新成功.');

        return redirect(route('cats.index'));
    }

    /**
     * Remove the specified cats from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('Cats not found');

            return redirect(route('cats.index'));
        }

        $this->catsRepository->delete($id);

        Flash::success('商品分类删除成功.');

        return redirect(route('cats.index'));
    }
}
