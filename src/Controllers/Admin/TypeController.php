<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.operation.edit_type')->with('action', 'create');
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
            'sort' => 'integer|nullable',
            'ship_sort' => 'integer|nullable',
        ]);

        $input = $request->except('_token');
        Type::create($input);

        return redirect()->route('admin.dashboard')->with('alert.message', '新增成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type, $id)
    {
        $data = $type->find($id);
        return view('admin.operation.edit_type')->with([
            'data' => $data,
            'action' => 'update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'string|nullable',
            'sort' => 'integer|nullable',
            'ship_sort' => 'integer|nullable',
        ]);

        $target = $type->where('id', $id);
        $input = $request->except('_token');
        $target->update($input);

        return redirect()->route('admin.dashboard')->with('alert.message', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type, $id)
    {
        $type->destroy($id);

        return redirect()->route('admin.dashboard')->with('alert.message', '刪除成功');
    }
}
