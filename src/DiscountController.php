<?php

namespace Abolfazlrastegar\LaravelDiscount;
use Abolfazlrastegar\LaravelDiscount\models\Discount;
use Abolfazlrastegar\LaravelDiscount\models\HistoryDiscount;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    /**
     * @param $request
     * @return bool|\Illuminate\Support\MessageBag
     */
    public function create(Request $request) {
        $validation = Validator::make($request->all(), [
            'code' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        if (!$validation->fails()) {
            $discount = new Discount();
            $discount->code = $request->get('code');
            $discount->quantity = $request->get('quantity');
            $discount->price = str_replace(',', '', $request->get('price'));
            $discount->start_date = $request->get('start_date');
            $discount->end_date = $request->get('end_date');
            if ($discount->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'کد تخفیف مورد نظر شما ثبت شد'
                ]);
            }
            return false;
        }
        return $validation->errors();
    }

    /**
     * @param $discount_id
     * @param $section_used
     * @return bool
     */
    public static function historyDiscount ($discount_id, $section_used) {
        $history_discount = new HistoryDiscount();
        $history_discount->discount_id = $discount_id;
        $history_discount->user_id = Auth::id();
        $history_discount->section_used = $section_used;
        return $history_discount->save();
    }

    /**
     * @param $discount_id
     * @return mixed
     */
    public function removeDiscount ($discount_id) {
       $delete = Discount::query()->where('id', '=', $discount_id)->delete();
       if ($delete) {
           return response()->json([
               'status' => 200,
               'message' => 'کد تخفیف مورد نظر شما حذف شد.'
           ]);
       }
        return response()->json([
            'status' => 401,
            'message' => 'در انجام حذف کد تخفیف مورد نظر مشکلی پیش آمد.'
        ]);
    }

    public function statusDiscount (Request $request) {
        $status = Discount::query()->where('id', '=', $request->get('discount_id'))
            ->update(['approved' => $request->get('status')]);
        if ($status) {
            return response()->json([
                'status' => 200,
                'message' => 'وضیعت کد تخفیف مورد نظر شما تعقییر کرد.'
            ]);
        }
        return response()->json([
            'status' => 401,
            'message' => 'درانجام عملیات مورد نظر مشکلی پیش آمد.'
        ]);
    }


    public static function getDiscountUsedUser ($user_id) {
        return HistoryDiscount::query()
            ->with(['discount'])
            ->where('user_id', '=', $user_id)
            ->get();
    }

    public function getUserOneDiscount (Request $request) {
        $users_discount = HistoryDiscount::query()
           ->with(['user', 'discount'])->where('discount_id', '=', $request->get('discount_id'))
           ->paginate(config('discount.paginate'));

        return view('discount::users-discount', ['users_discount', $users_discount]);
    }


    public static function getHistoryDiscount () {
        return HistoryDiscount::query()->with(['user', 'discount'])->paginate(config('discount.paginate'));
    }

    public static function getDiscount () {
        return Discount::query()->with(['historyDiscount' => function($query) {
            $query->with(['user']);
        }])
            ->select('*')
            ->selectRaw("(SELECT count(`hid`.`id`) FROM `history_discounts` AS hid WHERE `hid`.`discount_id` = `discounts`.`id`) AS 'discunt_used'")
            ->paginate(config('discount.paginate'));
    }
}
