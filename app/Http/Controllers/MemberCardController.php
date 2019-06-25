<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberCardRequest;
use App\Http\Requests\UpdateMemberCardRequest;
use App\Repositories\MemberCardRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\MemberCard;
use App\Models\CardBuy;
use App\Models\Shop;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class MemberCardController extends AppBaseController
{
    /** @var  MemberCardRepository */
    private $memberCardRepository;

    public function __construct(MemberCardRepository $memberCardRepo)
    {
        $this->memberCardRepository = $memberCardRepo;
    }

    /**
     * Display a listing of the MemberCard.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->memberCardRepository->pushCriteria(new RequestCriteria($request));
        $memberCards = MemberCard::where('id','>','0');
        $shop=Shop::all();
        $input=$request->all();
        $card_buy=CardBuy::where('status','已支付');
        if (array_key_exists('create_start', $input)) {
            if($input['create_start'] !="") {
                $memberCards = $memberCards->where('updated_at', '>=', Carbon::createFromFormat('Y-m-d', $input['create_start'])->setTime(0, 0, 0));
            }
        }

        if (array_key_exists('create_end', $input)) {
            if( $input['create_end'] !="") {
                $memberCards = $memberCards->where('updated_at', '<', Carbon::createFromFormat('Y-m-d', $input['create_end'])->addDay()->setTime(0, 0, 0));
            }
        }

        if (array_key_exists('status', $input)) {
            if($input['status']=='全部'){

            }else if($input['status']=='未过期'){
                $memberCards = $memberCards->where('end', '>', Carbon::now());
            }else if($input['status']=='已过期') {
                $memberCards = $memberCards->where('end', '<', Carbon::now());
            }
        }

        if(array_key_exists('fendian',$input)){
            if( Input::get('fendian')=='全部') {
            }else {
                $memberCards = $memberCards->whereHas('shop', function ($q) {
                    $q->where('name', Input::get('fendian'));
                });
            }
        }

        if(array_key_exists('mobile',$input) && !empty($input['mobile'])){
            $memberCards = $memberCards->whereHas('user', function ($q) {
                $q->where('mobile', Input::get('mobile'));
            });
        }

        $memberCards=$memberCards->orderBy('created_at','desc')->paginate(20);
        return view('member_cards.index')
            ->with('memberCards', $memberCards)->with('shop',$shop)->with('card_buy',$card_buy)->withInput(Input::all());
    }

    /**
     * Show the form for creating a new MemberCard.
     *
     * @return Response
     */
    public function create()
    {
        return view('member_cards.create');
    }

    /**
     * Store a newly created MemberCard in storage.
     *
     * @param CreateMemberCardRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberCardRequest $request)
    {
        $input = $request->all();

        $memberCard = $this->memberCardRepository->create($input);

        Flash::success('Member Card saved successfully.');

        return redirect(route('memberCards.index'));
    }

    /**
     * Display the specified MemberCard.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $memberCard = $this->memberCardRepository->findWithoutFail($id);

        if (empty($memberCard)) {
            Flash::error('Member Card not found');

            return redirect(route('memberCards.index'));
        }

        return view('member_cards.show')->with('memberCard', $memberCard);
    }

    /**
     * Show the form for editing the specified MemberCard.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $memberCard = $this->memberCardRepository->findWithoutFail($id);

        if (empty($memberCard)) {
            Flash::error('Member Card not found');

            return redirect(route('memberCards.index'));
        }

        return view('member_cards.edit')->with('memberCard', $memberCard);
    }

    /**
     * Update the specified MemberCard in storage.
     *
     * @param  int              $id
     * @param UpdateMemberCardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberCardRequest $request)
    {
        $memberCard = $this->memberCardRepository->findWithoutFail($id);

        if (empty($memberCard)) {
            Flash::error('Member Card not found');

            return redirect(route('memberCards.index'));
        }

        $memberCard = $this->memberCardRepository->update($request->all(), $id);

        Flash::success('Member Card updated successfully.');

        return redirect(route('memberCards.index'));
    }

    /**
     * Remove the specified MemberCard from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $memberCard = $this->memberCardRepository->findWithoutFail($id);

        if (empty($memberCard)) {
            Flash::error('会员卡不存在');

            return redirect(route('memberCards.index'));
        }

        $this->memberCardRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('memberCards.index'));
    }
}
