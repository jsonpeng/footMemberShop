<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebankinfoRequest;
use App\Http\Requests\UpdatebankinfoRequest;
use App\Repositories\bankinfoRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\bankinfo;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class bankinfoController extends AppBaseController
{
    /** @var  bankinfoRepository */
    private $bankinfoRepository;

    public function __construct(bankinfoRepository $bankinfoRepo)
    {
        $this->bankinfoRepository = $bankinfoRepo;
    }

    /**
     * Display a listing of the bankinfo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bankinfoRepository->pushCriteria(new RequestCriteria($request));
        $bankinfos = bankinfo::where('id','>',0)->orderBy('created_at','desc')->paginate(20);

        return view('bankinfos.index')
            ->with('bankinfos', $bankinfos);
    }

    /**
     * Show the form for creating a new bankinfo.
     *
     * @return Response
     */
    public function create()
    {
        return view('bankinfos.create');
    }

    /**
     * Store a newly created bankinfo in storage.
     *
     * @param CreatebankinfoRequest $request
     *
     * @return Response
     */
    public function store(CreatebankinfoRequest $request)
    {
        $input = $request->all();

        $bankinfo = $this->bankinfoRepository->create($input);

        Flash::success('Bankinfo saved successfully.');

        return redirect(route('bankinfos.index'));
    }

    /**
     * Display the specified bankinfo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bankinfo = $this->bankinfoRepository->findWithoutFail($id);

        if (empty($bankinfo)) {
            Flash::error('Bankinfo not found');

            return redirect(route('bankinfos.index'));
        }

        return view('bankinfos.show')->with('bankinfo', $bankinfo);
    }

    /**
     * Show the form for editing the specified bankinfo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bankinfo = $this->bankinfoRepository->findWithoutFail($id);

        if (empty($bankinfo)) {
            Flash::error('Bankinfo not found');

            return redirect(route('bankinfos.index'));
        }

        return view('bankinfos.edit')->with('bankinfo', $bankinfo);
    }

    /**
     * Update the specified bankinfo in storage.
     *
     * @param  int              $id
     * @param UpdatebankinfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebankinfoRequest $request)
    {
        $bankinfo = $this->bankinfoRepository->findWithoutFail($id);

        if (empty($bankinfo)) {
            Flash::error('Bankinfo not found');

            return redirect(route('bankinfos.index'));
        }

        $bankinfo = $this->bankinfoRepository->update($request->all(), $id);

        Flash::success('Bankinfo updated successfully.');

        return redirect(route('bankinfos.index'));
    }

    /**
     * Remove the specified bankinfo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bankinfo = $this->bankinfoRepository->findWithoutFail($id);

        if (empty($bankinfo)) {
            Flash::error('Bankinfo not found');

            return redirect(route('bankinfos.index'));
        }

        $this->bankinfoRepository->delete($id);

        Flash::success('Bankinfo deleted successfully.');

        return redirect(route('bankinfos.index'));
    }
}
