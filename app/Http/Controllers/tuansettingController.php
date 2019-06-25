<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetuansettingRequest;
use App\Http\Requests\UpdatetuansettingRequest;
use App\Repositories\tuansettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class tuansettingController extends AppBaseController
{
    /** @var  tuansettingRepository */
    private $tuansettingRepository;

    public function __construct(tuansettingRepository $tuansettingRepo)
    {
        $this->tuansettingRepository = $tuansettingRepo;
    }

    /**
     * Display a listing of the tuansetting.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tuansettingRepository->pushCriteria(new RequestCriteria($request));
        $tuansettings = $this->tuansettingRepository->all();

        return view('tuansettings.index')
            ->with('tuansettings', $tuansettings);
    }

    /**
     * Show the form for creating a new tuansetting.
     *
     * @return Response
     */
    public function create()
    {
        return view('tuansettings.create');
    }

    /**
     * Store a newly created tuansetting in storage.
     *
     * @param CreatetuansettingRequest $request
     *
     * @return Response
     */
    public function store(CreatetuansettingRequest $request)
    {
        $input = $request->all();

        $tuansetting = $this->tuansettingRepository->create($input);

        Flash::success('Tuansetting saved successfully.');

        return redirect(route('tuansettings.index'));
    }

    /**
     * Display the specified tuansetting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tuansetting = $this->tuansettingRepository->findWithoutFail($id);

        if (empty($tuansetting)) {
            Flash::error('Tuansetting not found');

            return redirect(route('tuansettings.index'));
        }

        return view('tuansettings.show')->with('tuansetting', $tuansetting);
    }

    /**
     * Show the form for editing the specified tuansetting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tuansetting = $this->tuansettingRepository->findWithoutFail($id);

        if (empty($tuansetting)) {
           // Flash::error('Tuansetting not found');
          //  return redirect(route('tuansettings.index'));
            $this->tuansettingRepository->create([
                'tuan_num'=>'',
                'man_num'=>''
            ]);
            return redirect(route('tuansettings.edit', [1]));
        }

        return view('tuansettings.edit')->with('tuansetting', $tuansetting);
    }

    /**
     * Update the specified tuansetting in storage.
     *
     * @param  int              $id
     * @param UpdatetuansettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetuansettingRequest $request)
    {
        $tuansetting = $this->tuansettingRepository->findWithoutFail($id);

        if (empty($tuansetting)) {
            Flash::error('Tuansetting not found');

            return redirect(route('tuansettings.index'));
        }

        $tuansetting = $this->tuansettingRepository->update($request->all(), $id);

        Flash::success('拼团信息设置成功.');

        return redirect(route('tuansettings.edit', [1]));
    }

    /**
     * Remove the specified tuansetting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tuansetting = $this->tuansettingRepository->findWithoutFail($id);

        if (empty($tuansetting)) {
            Flash::error('Tuansetting not found');

            return redirect(route('tuansettings.index'));
        }

        $this->tuansettingRepository->delete($id);

        Flash::success('Tuansetting deleted successfully.');

        return redirect(route('tuansettings.index'));
    }
}
