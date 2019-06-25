<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCardBuyRequest;
use App\Http\Requests\UpdateCardBuyRequest;
use App\Repositories\CardBuyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CardBuyController extends AppBaseController
{
    /** @var  CardBuyRepository */
    private $cardBuyRepository;

    public function __construct(CardBuyRepository $cardBuyRepo)
    {
        $this->cardBuyRepository = $cardBuyRepo;
    }

    /**
     * Display a listing of the CardBuy.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cardBuyRepository->pushCriteria(new RequestCriteria($request));
        $cardBuys = $this->cardBuyRepository->all();

        return view('card_buys.index')
            ->with('cardBuys', $cardBuys);
    }

    /**
     * Show the form for creating a new CardBuy.
     *
     * @return Response
     */
    public function create()
    {
        return view('card_buys.create');
    }

    /**
     * Store a newly created CardBuy in storage.
     *
     * @param CreateCardBuyRequest $request
     *
     * @return Response
     */
    public function store(CreateCardBuyRequest $request)
    {
        $input = $request->all();

        $cardBuy = $this->cardBuyRepository->create($input);

        Flash::success('Card Buy saved successfully.');

        return redirect(route('cardBuys.index'));
    }

    /**
     * Display the specified CardBuy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cardBuy = $this->cardBuyRepository->findWithoutFail($id);

        if (empty($cardBuy)) {
            Flash::error('Card Buy not found');

            return redirect(route('cardBuys.index'));
        }

        return view('card_buys.show')->with('cardBuy', $cardBuy);
    }

    /**
     * Show the form for editing the specified CardBuy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cardBuy = $this->cardBuyRepository->findWithoutFail($id);

        if (empty($cardBuy)) {
            Flash::error('Card Buy not found');

            return redirect(route('cardBuys.index'));
        }

        return view('card_buys.edit')->with('cardBuy', $cardBuy);
    }

    /**
     * Update the specified CardBuy in storage.
     *
     * @param  int              $id
     * @param UpdateCardBuyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCardBuyRequest $request)
    {
        $cardBuy = $this->cardBuyRepository->findWithoutFail($id);

        if (empty($cardBuy)) {
            Flash::error('Card Buy not found');

            return redirect(route('cardBuys.index'));
        }

        $cardBuy = $this->cardBuyRepository->update($request->all(), $id);

        Flash::success('Card Buy updated successfully.');

        return redirect(route('cardBuys.index'));
    }

    /**
     * Remove the specified CardBuy from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cardBuy = $this->cardBuyRepository->findWithoutFail($id);

        if (empty($cardBuy)) {
            Flash::error('Card Buy not found');

            return redirect(route('cardBuys.index'));
        }

        $this->cardBuyRepository->delete($id);

        Flash::success('Card Buy deleted successfully.');

        return redirect(route('cardBuys.index'));
    }
}
