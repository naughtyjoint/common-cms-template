<div class="card" id="discount">
    <div class="card-header widget-block">
        <h3 class="card-title">
            <strong>折扣管理</strong>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-12">
                <a href="{{ route('admin.discount.create') }}">
                    <button type="button" class="btn btn-primary">新增折扣群組</button>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    <th>名稱</th>
                    <th>資訊</th>
                    <th>代表字</th>
                    <th>滿足數量</th>
                    <th>折扣金額</th>
                    <th>標籤顏色</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($discounts as $discount)
                    <tr>
                        <td>{{ $discount->id }}</td>
                        <td>{{ $discount->name }}</td>
                        <td>{{ $discount->description }}</td>
                        <td>{{ $discount->letter }}</td>
                        <td>{{ $discount->amount }}</td>
                        <td>{{ $discount->price }}</td>
                        <td>
                            <span class="badge text-white" style="background-color: {{ $discount->hex }}">
                                {{ $discount->hex }}
                            </span>
                        </td>
                        <td>
                            @if($discount->status)
                                <span class="badge badge-success">開啟</span>
                            @else
                                <span class="badge badge-secondary">關閉</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm text-white"
                               href="{{ route('admin.discount.open', ['id' => $discount->id]) }}">開啟</a>
                            <a class="btn btn-secondary btn-sm text-white"
                               href="{{ route('admin.discount.close', ['id' => $discount->id]) }}">關閉</a>
                            <a class="btn btn-primary btn-sm text-white"
                               href="{{ route('admin.discount.edit', ['id' => $discount->id]) }}">編輯</a>
                            <a class="btn btn-danger btn-sm text-white"
                               href="{{ route('admin.discount.delete', ['id' => $discount->id]) }}">刪除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="ml-3">
                {{ $discounts->links("pagination::bootstrap-4") }}
            </div>
            <hr>
            <div class="p-3">
                <form action="{{ route('admin.option.discount.update') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="discountCondition" class="col-sm-2 col-form-label">全站折扣滿額條件</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" class="form-control" id="discountCondition" value="{{ $options['discount.condition'] }}" name="discount_condition" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="discountPrice" class="col-sm-2 col-form-label">全站折扣金額</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" class="form-control" id="discountPrice" value="{{ $options['discount.price'] }}" name="discount_price" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">儲存</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
