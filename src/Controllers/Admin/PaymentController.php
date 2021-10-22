<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class  PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.operation.edit_payment')->with('action', 'create');
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
            'description' => 'string|nullable',
            'image' => 'image|nullable',
            'last_code' => 'boolean|nullable',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid())
                return back()->with('status', '圖片上傳失敗，請重試');
            else
                $path = $request->image->store('images');
        }

        $input = $request->except('_token');
        $input['image'] = isset($path) ? '/' . $path : null;

        Payment::create($input);

        return redirect()->route('admin.dashboard')->with('alert.message', '新增成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment, $id)
    {
        $data = $payment->find($id);
        return view('admin.operation.edit_payment')->with([
            'data' => $data,
            'action' => 'update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment, $id = null)
    {
        if ($request->routeIs('admin.payment.open')) {
            $payment->where('id', $id)->update(['status' => 1]);
        } elseif ($request->routeIs('admin.payment.close')) {
            $payment->where('id', $id)->update(['status' => 0]);
        } else {
            $validated = $request->validate([
                'name' => 'required|string',
                'description' => 'string|nullable',
                'image' => 'image|nullable',
                'last_code' => 'boolean|nullable',
                'status' => 'required|boolean',
            ]);

            $target = $payment->where('id', $id);
            $input = $request->except('_token');
            if (!isset($input['last_code'])) $input['last_code'] = null;

            if ($request->hasFile('image')) {
                if (!$request->file('image')->isValid()) {
                    return back()->with('status', '圖片上傳失敗，請重試');
                } else {
                    $path = $request->image->store('images');
                    $input['image'] = '/' . $path;
                }
            }
            if ($request->input('delete_img')) {
                $input['image'] = null;
                unset($input['delete_img']);
            }

            $target->update($input);
        }

        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment, $id)
    {
        $payment->destroy($id);

        return redirect()->route('admin.dashboard')->with('alert.message', '刪除成功');
    }
}
