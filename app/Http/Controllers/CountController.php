<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountRequest;
use App\Http\Requests\UpdateCountRequest;
use App\Repositories\CountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Count;

class CountController extends AppBaseController
{
    /** @var  CountRepository */
    private $countRepository;

    public function __construct(CountRepository $countRepo)
    {
        $this->countRepository = $countRepo;
    }

    /**
     * Display a listing of the Count.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->countRepository->pushCriteria(new RequestCriteria($request));
        //$counts = $this->countRepository->all();
        $counts = Count::paginate(15);
        return view('counts.index')
            ->with('counts', $counts);
    }

    /**
     * Show the form for creating a new Count.
     *
     * @return Response
     */
    public function create()
    {
        return view('counts.create');
    }

    /**
     * Store a newly created Count in storage.
     *
     * @param CreateCountRequest $request
     *
     * @return Response
     */
    public function store(CreateCountRequest $request)
    {
        $input = $request->all();

        $count = $this->countRepository->create($input);

        Flash::success('Count saved successfully.');

        return redirect(route('counts.index'));
    }

    /**
     * Display the specified Count.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $count = $this->countRepository->findWithoutFail($id);

        if (empty($count)) {
            Flash::error('Count not found');

            return redirect(route('counts.index'));
        }

        return view('counts.show')->with('count', $count);
    }

    /**
     * Show the form for editing the specified Count.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $count = $this->countRepository->findWithoutFail($id);

        if (empty($count)) {
            Flash::error('Count not found');

            return redirect(route('counts.index'));
        }

        return view('counts.edit')->with('count', $count);
    }

    /**
     * Update the specified Count in storage.
     *
     * @param  int              $id
     * @param UpdateCountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountRequest $request)
    {
        $count = $this->countRepository->findWithoutFail($id);

        if (empty($count)) {
            Flash::error('Count not found');

            return redirect(route('counts.index'));
        }

        $count = $this->countRepository->update($request->all(), $id);

        Flash::success('Count updated successfully.');

        return redirect(route('counts.index'));
    }

    /**
     * Remove the specified Count from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $count = $this->countRepository->findWithoutFail($id);

        if (empty($count)) {
            Flash::error('Count not found');

            return redirect(route('counts.index'));
        }

        $this->countRepository->delete($id);

        Flash::success('Count deleted successfully.');

        return redirect(route('counts.index'));
    }
}
