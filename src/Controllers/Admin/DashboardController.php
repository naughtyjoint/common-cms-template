<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Carbon\Carbon;
use App\Models\Discount;
use App\Models\Payment;
use App\Models\Type;
use App\Models\Item;
use App\Models\Order;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $orders = new Order();
        $input = $request->all();
        $today = Carbon::now()->toDateString();
        if (($request->has('start_date') && $request->has('end_date')) && ($input['start_date'] || $input['end_date'])) {
            $validated = $request->validate([
                'start_date' => 'required|date|before:end_date',
                'end_date' => "required|date|before_or_equal:$today",
            ]);
            $endPoint = Carbon::parse($input['end_date'])->add(1, 'day')->toDateTimeString();
            $orders = $orders->where('created_at', '>=', $input['start_date'])
                ->where('created_at', '<', $endPoint);
        }
        if ($request->has('start_id') && $request->has('end_id')) {
            if (!is_null($input['start_id']) && !is_null($input['end_id'])) {
                $validated = $request->validate([
                    'start_id' => 'required|integer|lt:end_id|min:0',
                    'end_id' => "required|integer|min:1",
                ]);
                $orders = $orders->whereBetween('id', [$input['start_id'], $input['end_id']]);
            }
        }

        $optionsData = Option::all();
        $options = [];
        foreach ($optionsData as $val) {
            $options[$val->option_key] = $val->option_value;
        }
        if ($request->has('sort')) {
            $orders = $orders->orderBy('created_at', $request->input('sort'));
        } else {
            $orders = $orders->orderBy('id', 'DESC');
        }
        $orders = $orders->paginate(10, ['*'], 'orderpage')
            ->fragment('order')
            ->appends($input)
            ->setPageName('orderpage');

        $items = Item::paginate(10)
            ->fragment('item')
            ->appends($input);

        $orphans = Item::select('id', 'name')
            ->whereNull('type_id')
            ->where('status', 1)
            ->orderBy('sort')
            ->get();

        $types = new Type();
        if ($request->has('type_sort')) $types = $types->orderBy('sort', $request->input('type_sort'));
        $types = $types->paginate(10, ['*'], 'typepage')
            ->fragment('type')
            ->appends($input)
            ->setPageName('typepage');

        $payments = Payment::paginate(10, ['*'], 'paymentpage')
            ->fragment('payment')
            ->appends($input)
            ->setPageName('paymentpage');

        $discounts = Discount::paginate(10, ['*'], 'discountpage')
            ->fragment('discount')
            ->appends($input)
            ->setPageName('discountpage');

        return view('admin.dashboard')->with([
            'options' => $options,
            'orders' => $orders,
            'items' => $items,
            'types' => $types,
            'payments' => $payments,
            'discounts' => $discounts,
            'orphanItems' => $orphans,
        ]);
    }

    public function updateOption(Request $request)
    {
        $validated = $request->validate([
            'website_open' => 'required|string',
            'banner_text' => 'string|nullable',
            'announcement_text' => 'string|nullable',
            'heaven_key' => 'required|string',
            'deliver_free' => 'required|integer|min:0',
            'deliver_fee' => 'required|integer|min:0',
            'open_area' => 'array',
        ]);

        foreach($request->input() as $key => $value) {
            if ($key == 'deliver_free') {
                Option::where('option_key', 'deliver_free.price')->update(['option_value' => $value ?? '']);
            } elseif ($key == 'deliver_fee') {
                Option::where('option_key', $key)->update(['option_value' => $value ?? '']);
            } elseif ($key == 'open_area') {
                Option::where('option_key', 'open.area')->update(['option_value' => json_encode($value) ?? '']);
            } else {
                Option::where('option_key', str_replace('_', '.', $key))->update(['option_value' => $value ?? '']);
            }
        }

        return back()->with('alert.message', '更新成功');
    }

    public function updateGlobalDiscount(Request $request)
    {
        $validated = $request->validate([
            'discount.price' => 'integer|nullable',
            'discount.condition' => 'integer|nullable'
        ]);

        foreach($request->input() as $key => $value) {
            Option::where('option_key', str_replace('_', '.', $key))->update(['option_value' => $value ?? '']);

        }

        return back()->with('alert.message', '更新成功');
    }
}
