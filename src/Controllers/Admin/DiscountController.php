<?php

namespace App\Http\Controllers\Admin;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.operation.edit_discount')->with('action', 'create');
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
            'name' => 'string|nullable',
            'description' => 'string|nullable',
            'letter' => 'string|nullable|size:1',
            'amount' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'hex' => 'string|nullable',
            'status' => 'required|boolean',
        ]);

        $input = $request->except('_token');
        Discount::create($input);

        return redirect()->route('admin.dashboard')->with('alert.message', '新增成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount, $id)
    {
        $data = $discount->find($id);
        return view('admin.operation.edit_discount')->with([
            'data' => $data,
            'action' => 'update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount, $id)
    {
        if ($request->routeIs('admin.discount.open')) {
            $discount->where('id', $id)->update(['status' => 1]);
        } elseif ($request->routeIs('admin.discount.close')) {
            $discount->where('id', $id)->update(['status' => 0]);
        } else {
            $validated = $request->validate([
                'name' => 'string|nullable',
                'description' => 'string|nullable',
                'letter' => 'string|nullable|size:1',
                'amount' => 'required|integer|min:1',
                'price' => 'required|integer|min:1',
                'hex' => 'string|nullable',
                'status' => 'required|boolean',
            ]);
            $target = $discount->where('id', $id);
            $input = $request->except('_token');
            $target->update($input);
        }

        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount, $id)
    {
        $discount->destroy($id);

        return redirect()->route('admin.dashboard')->with('alert.message', '刪除成功');
    }
}
