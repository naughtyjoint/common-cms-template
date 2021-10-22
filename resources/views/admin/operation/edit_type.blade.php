@extends('admin.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>新增分類</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>新增表格</strong>
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="@if($action === 'create') {{ route('admin.type.create') }} @else {{ route('admin.type.edit', $data->id) }} @endif" method="POST">
                    @csrf
                    @if($action === 'update')
                        <div class="row mb-3">
                            <div class="col-sm-2">編號</div>
                            <div class="col-sm-10">{{ $data->id }}</div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="葉菜類"
                                value="@if($action === 'create'){{ old('name') }}@else{{ $data->name }}@endif"
                                required
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">資訊</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="description"
                                name="description"
                                value="@if($action === 'create'){{ old('description') }}@else{{ $data->description }}@endif"
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sort" class="col-sm-2 col-form-label">排序</label>
                        <div class="col-sm-10">
                            <input
                                type="number"
                                class="form-control"
                                id="sort"
                                name="sort"
                                value="@if($action === 'create'){{ old('sort') }}@else{{ $data->sort }}@endif"
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="shipSort" class="col-sm-2 col-form-label">出貨單排序</label>
                        <div class="col-sm-10">
                            <input
                                type="number"
                                class="form-control"
                                id="shipSort"
                                name="ship_sort"
                                value="@if($action === 'create'){{ old('ship_sort') }}@else{{ $data->ship_sort }}@endif"
                            >
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">儲存</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
