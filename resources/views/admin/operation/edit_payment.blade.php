@extends('admin.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>新增支付</h1>
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
                <form action="@if($action === 'create') {{ route('admin.payment.create') }} @else {{ route('admin.payment.edit', $data->id) }} @endif" method="POST" enctype="multipart/form-data">
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
                                placeholder="匯款"
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
                        <label for="image" class="col-sm-2 col-form-label">QRCode</label>
                        <div class="col-sm-10">
                            <input
                                type="file"
                                class="form-control-file"
                                id="image"
                                name="image"
                                accept="image/jpg, image/jpeg,image/png"
                            >
                        </div>
                    </div>
                    @if($action === 'update' && !empty($data->image))
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10" id="qrCodeImg">
                                <img src="{{ asset($data->image) }}" alt="QRCode" width="150">
                                <button type="button" class="btn btn-danger" onclick="deleteImg()">清除圖片</button>
                            </div>
                        </div>
                        <input type="checkbox" name="delete_img" id="deleteImgInput" class="d-none" value="true">
                    @endif
                    <div class="row mb-3">
                        <label for="lastCode" class="col-sm-2 col-form-label">匯款資訊(ex: 後五碼)</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input
                                    class="form-check-input position-static"
                                    type="checkbox"
                                    id="lastCode"
                                    name="last_code"
                                    value="1"
                                    @if($action === 'update' && $data->last_code) checked @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">狀態</label>
                        <div class="col-sm-10">
                            <select class="custom-select form-control-border" id="status" aria-label="status select" name="status">
                                <option value="1" @if(($action === 'update' && $data->status)) selected @endif>開啟</option>
                                <option value="0" @if($action === 'create' || ($action === 'update' && !$data->status)) selected @endif>關閉</option>
                            </select>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
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
