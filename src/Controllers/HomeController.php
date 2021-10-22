<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Validator;
use App\Models\Discount;
use App\Models\Item;
use App\Models\Option;
use App\Models\Payment;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $options = Option::all();
        $option = [];
        foreach ($options as $val) {
            $option[$val->option_key] = $val->option_value;
        }
        $types = Type::select('id', 'name', 'description', 'sort')
            ->has('items')
            ->with(['items' => function ($query) {
                $query->where('status', 1)
                    ->orderBy('sort');
            }])
            ->orderBy('sort')
            ->get()
            ->toArray();

        $defaultItem = Item::select('id', 'name', 'portion', 'price', 'group_id', 'sort')
            ->where('status', 1)
            ->whereNull('type_id')
            ->orderBy('sort')
            ->get()
            ->toArray();

        if (count($defaultItem)) {
            $types[] = [
                'id' => null,
                'name' => null,
                'description' => null,
                'items' => $defaultItem
            ];
        }

        $types = collect(array_filter($types, function ($value) {
            return count($value['items']) > 0;
        }))->values()->all();

        $payments = Payment::select('id', 'name', 'description', 'image', 'last_code')
            ->where('status', 1)
            ->get()
            ->toArray();

        $discounts = Discount::where('status', 1)
            ->get()
            ->toArray();

        return view('index')->with([
            'options' => json_encode($option),
            'veggie_lists' => json_encode($types),
            'payments' => json_encode($payments),
            'discounts' => json_encode($discounts),
        ]);
    }

    public function order(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'customer_line' => 'string|nullable',
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'order_detail' => 'required|json',
            'payment' => 'required|string',
            'discount' => 'required|integer',
            'price' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => '驗證錯誤',
            ], 400);
        }
        $order_detail = [];
        foreach(json_decode($input['order_detail'], true) as $detail) {
            unset($detail['group_id']);
            $order_detail['data'][] = $detail;
        }
        $customer = [
            'line' => $input['customer_line'] ?? '',
            'name' => $input['customer_name'],
            'phone' => $input['customer_phone'],
            'address' => $input['customer_address'],
        ];

        $orderData = [
            'customer' => json_encode($customer),
            'order_detail' => json_encode($order_detail),
            'discount' => $input['discount'],
            'price' => $input['price'],
            'payment' => $input['payment'],
        ];

        $order = Order::create($orderData);
        if ($order) {
            return response()->json([
                'status' => 'success',
                'message' => '新增成功',
                'item' => $order->toArray(),
            ], 200);
        }

    }
}
