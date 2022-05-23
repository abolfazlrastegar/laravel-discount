<?php

namespace Abolfazlrastegar\LaravelDiscount;
use Abolfazlrastegar\LaravelDiscount\Models\Discount;
use Abolfazlrastegar\LaravelDiscount\Models\HistoryDiscount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'percent' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        if (!$validation->fails()) {
            $discount = new Discount();
            $discount->code = $request->get('code');
            $discount->quantity = $request->get('quantity');
            $discount->percent = $request->get('percent');
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

    public function edit (Request $request) {
        $validation = Validator::make($request->all(), [
            'code' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|string',
            'percent' => 'required|numeric',
        ]);

        if (!$validation->fails()) {
            $discount = Discount::find($request->get('discountId'));
            $discount->code = $request->get('code');
            $discount->quantity = $request->get('quantity');
            $discount->percent = $request->get('percent');
            $discount->price = str_replace(',', '', $request->get('price'));
            $discount->start_date = $request->get('start_date');
            $discount->end_date = $request->get('end_date');
            if ($discount->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'کد تخفیف مورد نظر شما ویرایش شد'
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'عملیات مورد نظر شما انجام نشد لطفا دوباره انجام بدید.'
            ]);
        }
        return $validation->errors();
    }
    /**
     * @param $discount_id
     * @param $section_used
     * @return bool
     */
    public static function historyDiscount ($discount_id, $user_id, $section_used) {
        $history_discount = new HistoryDiscount();
        $history_discount->discount_id = $discount_id;
        $history_discount->user_id = $user_id;
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

    public function statusDiscount(Request $request) {
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


    public static function getDiscountUsedUser($user_id) {
        $discount_user = HistoryDiscount::query()->with(['discount'])
            ->where('user_id', '=', $user_id)
            ->orderByDesc('created_at')
            ->paginate(config('discount.paginate'));
        return view('discount::discounts-user', ['discount_user' => $discount_user]);
    }

    public function getUserOneDiscount($discount_id) {
        $users_discount = HistoryDiscount::query()
            ->with(['user', 'discount'])->where('discount_id', '=', $discount_id)
            ->orderByDesc('created_at')
            ->paginate(config('discount.paginate'));
        return view('discount::users-discount', ['users_discount' => $users_discount]);
    }

    public static function getHistoryDiscount () {
        return HistoryDiscount::query()->with(['user', 'discount'])->paginate(config('discount.paginate'));
    }

    public static function getDiscount () {
        return Discount::query()->with(['historyDiscount' => function($query) {
            $query->with(['user' => function ($query) {
                $query->limit(config('discount.limit'));
            }]);
        }])
            ->select('*')
            ->selectRaw("(SELECT count(`hid`.`id`) FROM `".config('discount.prefix_database')."history_discounts` AS hid WHERE `hid`.`discount_id` = `".config('discount.prefix_database')."discounts`.`id`) AS 'discunt_used'")
            ->orderByDesc('start_date')
            ->paginate(config('discount.paginate'));
    }

    public static function validationDiscount ($code, $user_id) {
        $discount = Discount::query()->with(['historyDiscount' => function($query) {
            $query->select(['id', 'user_id', 'discount_id']);
        }])
            ->select('*')
            ->selectRaw("(SELECT count(`hid`.`id`) FROM `".config('discount.prefix_database')."history_discounts` AS hid WHERE `hid`.`discount_id` = `".config('discount.prefix_database')."discounts`.`id`) AS 'discunt_used'")
            ->where('code', '=', $code)
            ->first();
        if ($discount) {
            $discount = $discount->toArray();
            $history_discount = [];
            foreach ($discount['history_discount'] as $item) {
                array_push( $history_discount, $item['user_id']);
            }
            if ($discount['end_date'] > date('Y-m-d')) {
                if (in_array($user_id, $history_discount) == 0 && $discount['quantity'] > $discount['discunt_used'] && $discount['approved'] == 1) {
                    return [
                        'id' => $discount['id'],
                        'price' => (int)$discount['price'],
                        'percent' => $discount['percent']
                    ];
                }
                return ['user' => true];
            }
            return  ['date' => false];
        }
        return ['code' => false];
    }
}
