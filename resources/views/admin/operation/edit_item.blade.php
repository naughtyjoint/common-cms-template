@extends('admin.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>新增品項</h1>
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
                <form action="{{ route('admin.item.create') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="A菜" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="portion" class="col-sm-2 col-form-label">份量<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="portion" name="portion" placeholder="一份(約250g)" value="{{ old('portion') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">價格<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="number" min="0" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="type" class="col-sm-2 col-form-label">分類</label>
                        <div class="col-sm-10">
                            <select class="custom-select form-control-border" id="type" aria-label="websiteOpen select" name="type_id">
                                <option value="" disabled selected>請選擇分類</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->id }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="group" class="col-sm-2 col-form-label">折扣分類</label>
                        <div class="col-sm-10">
                            <select class="custom-select form-control-border" id="group" aria-label="group select" name="group_id">
                                <option value="" disabled selected>請選擇群組</option>
                                @foreach($discounts as $discount)
                                    <option value="{{ $discount->id }}">{{ $discount->name }} ({{ $discount->id }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">狀態</label>
                        <div class="col-sm-10">
                            <select class="custom-select form-control-border" id="status" aria-label="status select" name="status">
                                <option value="1">開啟</option>
                                <option value="0" selected>關閉</option>
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
