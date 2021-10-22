<?php

namespace App\Http\Controllers\Admin;

use App\Models\Discount;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::where('id', '!=', 99999)->get();
        $discount = Discount::where('status', 1)->get();

        return view('admin.operation.edit_item')->with([
            'types' => $types,
            'discounts' => $discount,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'portion' => 'required|string',
            'price' => 'required|integer|min:1',
            'type_id' => 'integer|nullable',
            'group_id' => 'integer|nullable',
            'status' => 'required|boolean',
        ]);

        $input = $request->except('_token');
        Item::create($input);

        return redirect()->route('admin.dashboard')->with('alert.message', '新增成功');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, $id)
    {
        if ($request->routeIs('admin.item.open')) {
            $item->where('id', $id)->update(['status' => 1]);
        } elseif ($request->routeIs('admin.item.close')) {
            $item->where('id', $id)->update(['status' => 0]);
        }

        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);

        return redirect()->route('admin.dashboard')->with('alert.message', '刪除成功');
    }

    public function batchOpen(Request $request)
    {
        $ids = $request->except('_token');
        $ids = $ids['select_ids'];
        Item::whereIn('id', $ids)->update([
            'status' => 1,
        ]);
        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }

    public function batchClose(Request $request)
    {
        $ids = $request->except('_token');
        $ids = $ids['select_ids'];
        Item::whereIn('id', $ids)->update([
            'status' => 0,
        ]);
        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }

    public function updateSort(Request $request)
    {
        $input = $request->except('_token');
        foreach($input as $key => $sortAry) {
            foreach($sortAry as $index => $sort) {
                $target = Item::find(intval($sort));
                $target->sort = $index + 1;
                $target->save();
            }
        }
        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }
}
