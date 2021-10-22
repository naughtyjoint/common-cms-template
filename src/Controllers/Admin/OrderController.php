<?php

namespace App\Http\Controllers\Admin;

use Excel, PDF;
use App\Models\Item;
use App\Models\Type;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function export(Request $request, $type)
    {
        $today = Carbon::now()->toDateString();
        $input = $request->all();
        $validity = true;
        if ($input['start_date'] || $input['end_date']) {
            $validated = $request->validate([
                'start_date' => 'required|date|before:end_date',
                'end_date' => "required|date|before_or_equal:$today",
            ]);
            $validity = false;
        }
        if ((!is_null($input['start_id']) || !is_null($input['end_id'])) || $validity) {
            $validated = $request->validate([
                'start_id' => 'required|integer|lt:end_id|min:0',
                'end_id' => "required|integer|min:1",
            ]);
        }
        if ($type == 'excel') {
            $timeName = Date('YmdHis', time());
            return Excel::download(new OrdersExport($input['start_date'], $input['end_date'], $input['start_id'], $input['end_id']), "orders$timeName.xlsx");
        } elseif ($type == 'pdf') {
            $data = new Order();
            if ($input['start_date'] && $input['end_date']) {
                $endPoint = Carbon::parse($input['end_date'])->add(1, 'day')->toDateTimeString();
                $data = $data->where('created_at', '>=', $input['start_date'])
                    ->where('created_at', '<', $endPoint);
            }
            if ($input['start_id'] && $input['end_id']) $data = $data->whereBetween('id', [$input['start_id'], $input['end_id']]);
            $data = $data->get();
            $defaultTypeSort = Type::find(99999)->ship_sort;
            foreach ($data as $order) {
                $sortingData = collect(json_decode($order->order_detail, true)['data'])
                    ->sortBy(function ($item) {
                        $target = Item::withTrashed()->find($item['item_id']);
                        return $target->type ? $target->id : null;
                    })
                    ->sortBy(function ($item) use ($defaultTypeSort) {
                        $target = Item::withTrashed()->find($item['item_id']);
                        return $target->type ? $target->type->ship_sort : $defaultTypeSort;
                    });
                $order->order_detail = json_encode(['data' => $sortingData]);
            }
            $pdf = PDF::loadView('admin.pdf', ['data' => $data]);
            $timeName = Date('YmdHi', time());
            return $pdf->download("配送單-$timeName.pdf");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect()->route('admin.dashboard')->with('alert.message', '刪除成功');
    }
}
