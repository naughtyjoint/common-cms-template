<div class="card" id="payment">
    <div class="card-header widget-block">
        <h3 class="card-title">
            <strong>支付管理</strong>
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
                <a href="{{ route('admin.payment.create') }}">
                    <button type="button" class="btn btn-primary">新增支付方式</button>
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
                    <th>QR code</th>
                    <th>必須輸入後五碼</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->name }}</td>
                        <td>{{ $payment->description }}</td>
                        <td>
                            @if(!empty($payment->image))
                                <a href="{{ $payment->image }}" target="_blank">{{ $payment->image }}</a>
                            @endif
                        </td>
                        <td>@if($payment->last_code)是@else否@endif</td>
                        <td>
                            @if($payment->status)
                                <span class="badge badge-success">開啟</span>
                            @else
                                <span class="badge badge-secondary">關閉</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm text-white"
                               href="{{ route('admin.payment.open', ['id' => $payment->id]) }}">開啟</a>
                            <a class="btn btn-secondary btn-sm text-white"
                               href="{{ route('admin.payment.close', ['id' => $payment->id]) }}">關閉</a>
                            <a class="btn btn-primary btn-sm text-white"
                               href="{{ route('admin.payment.edit', ['id' => $payment->id]) }}">編輯</a>
                            <a class="btn btn-danger btn-sm text-white"
                               href="{{ route('admin.payment.delete', ['id' => $payment->id]) }}">刪除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="ml-3">
                {{ $payments->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
