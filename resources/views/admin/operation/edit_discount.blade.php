@extends('admin.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>新增折扣群組</h1>
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
                <form action="@if($action === 'create') {{ route('admin.discount.create') }} @else {{ route('admin.discount.edit', $data->id) }} @endif" method="POST">
                    @csrf
                    @if($action === 'update')
                        <div class="row mb-3">
                            <div class="col-sm-2">編號</div>
                            <div class="col-sm-10">{{ $data->id }}</div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">名稱</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="第一類"
                                value="@if($action === 'create'){{ old('name') }}@else{{ $data->name }}@endif"
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
                        <label for="letter" class="col-sm-2 col-form-label">代表字(限一字)</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="letter"
                                name="letter"
                                value="@if($action === 'create'){{ old('letter') }}@else{{ $data->letter }}@endif"
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="letter" class="col-sm-2 col-form-label">達標數量<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input
                                type="number"
                                min="1"
                                class="form-control"
                                id="amount"
                                name="amount"
                                value="@if($action === 'create'){{ old('amount') }}@else{{ $data->amount }}@endif"
                                required
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">折扣價格<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input
                                type="number"
                                class="form-control"
                                min="1"
                                id="price"
                                name="price"
                                value="@if($action === 'create'){{ old('price') }}@else{{ $data->price }}@endif"
                                required
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="hex" class="col-sm-2 col-form-label">標籤顏色<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input
                                type="color"
                                class="form-control w-25"
                                id="hex"
                                name="hex"
                                value="@if($action === 'create'){{ old('hex') }}@else{{ $data->hex }}@endif"
                            >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">狀態</label>
                        <div class="col-sm-10">
                            <select class="custom-select form-control-border" id="status" aria-label="status select" name="status">
                                <option value="1" @if($action === 'update' && $data->status) selected @endif>開啟</option>
                                <option value="0" @if($action === 'create' || ($action === 'update' && !$data->status)) selected @endif>關閉</option>
                            </select>
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
