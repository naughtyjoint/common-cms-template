<div class="card" id="order">
    <div class="card-header widget-block">
        <h3 class="card-title">
            <strong>訂單管理</strong>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <form method="GET" class="row p-3" id="orderTable">
            <div class="col-6">
                <div class="form-group">
                    <label for="startDate">起始日期</label>
                    <input
                        id="startDate"
                        name="start_date"
                        type="date"
                        class="form-control"
                        value="{{ old('start_date', request()->get('start_date')) }}"
                    >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="endDate">結束日期</label>
                    <input
                        id="endDate"
                        name="end_date"
                        type="date"
                        class="form-control"
                        value="{{ old('end_date', request()->get('end_date')) }}"
                    >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="startId">起始編號</label>
                    <input
                        id="startId"
                        name="start_id"
                        type="number"
                        class="form-control"
                        value="{{ old('start_id', request()->get('start_id')) }}"
                    >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="endId">結束編號</label>
                    <input
                        id="endId"
                        name="end_id"
                        type="number"
                        min="0"
                        class="form-control"
                        value="{{ old('end_id', request()->get('end_id')) }}"
                    >
                </div>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="d-inline-block ml-auto mr-2 btn btn-primary" onclick="exportSubmit('order')">搜尋</button>
                <button type="submit" class="d-inline-block ml-auto mr-2 btn btn-primary" onclick="exportSubmit('excel')">匯出表單</button>
                <button type="submit" class="d-inline-block ml-auto btn btn-primary" onclick="exportSubmit('pdf')">匯出出貨單</button>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table-responsive mt-3">
            <table class="table table-hover table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    @if(request()->has('sort') && request()->input('sort') == 'DESC')
                        <th>
                            <a href={{ request()->fullUrlWithQuery(['sort' => 'ASC']) }}>
                                時間戳記
                            </a>
                        </th>
                    @else
                        <th>
                            <a href={{ request()->fullUrlWithQuery(['sort' => 'DESC']) }}>
                                時間戳記
                            </a>
                        </th>
                    @endif
                    <th>收貨人資訊</th>
                    <th>訂購品項</th>
                    <th>優惠扣除額</th>
                    <th>訂單總價</th>
                    <th>付款方式</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <p>
                                {{ $order->customer['name'] }}<br>
                                {{ $order->customer['address'] }}<br>
                                {{ $order->customer['phone'] }}<br>
                                {{ $order->customer['line'] }}<br>
                            </p>
                        </td>
                        <td>@foreach($order->order_detail_text as $item){{ $item }}<br>@endforeach</td>
                        <td>{{ number_format($order->discount) }}</td>
                        <td>{{ number_format($order->price) }}</td>
                        <td>{{ $order->payment }}</td>
                        <td>
                            <a class="btn btn-danger btn-sm text-white"
                               href="{{ route('admin.order.delete', ['id' => $order->id]) }}">刪除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="ml-3">
                {{ $orders->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
