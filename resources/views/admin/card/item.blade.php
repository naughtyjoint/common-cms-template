<div class="card" id="item">
    <div class="card-header widget-block">
        <h3 class="card-title">
            <strong>品項管理</strong>
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
                <a href="{{ route('admin.item.create') }}">
                    <button type="button" class="btn btn-primary">新增品項</button>
                </a>
                <div class="mt-3">群組操作</div>
                <button type="button" class="btn btn-success" onclick="processBatch('{{ route('admin.item.batch_open') }}')">開啟</button>
                <button type="button" class="btn btn-danger" onclick="processBatch('{{ route('admin.item.batch_close') }}')">關閉</button>
            </div>
        </div>
        <div class="table-responsive">
            <form action="" id="itemForm" method="post">
                @csrf
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th class="text-center text-primary" style="width: 10px; cursor: pointer;" onclick="selectAll()">全選</th>
                        <th>#</th>
                        <th>名稱</th>
                        <th>份量</th>
                        <th>價格</th>
                        <th>分類</th>
                        <th>折扣分類</th>
                        <th>狀態</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="select_ids[]" value="{{ $item->id }}" class="item-check-box">
                            </td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->portion }}</td>
                            <td>NT${{ $item->price }}</td>
                            <td>{{ $item->type->name ?? '' }}</td>
                            <td>{{ $item->discount ? $item->discount->name . "(" . $item->discount->id . ")" : '' }}</td>
                            <td>
                                @if($item->status)
                                    <span class="badge badge-success">開啟</span>
                                @else
                                    <span class="badge badge-secondary">關閉</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm text-white"
                                   href="{{ route('admin.item.open', ['id' => $item->id]) }}">開啟</a>
                                <a class="btn btn-secondary btn-sm text-white"
                                   href="{{ route('admin.item.close', ['id' => $item->id]) }}">關閉</a>
                                <a class="btn btn-danger btn-sm text-white"
                                   href="{{ route('admin.item.delete', ['id' => $item->id]) }}">刪除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            <div class="ml-3">
                {{ $items->links("pagination::bootstrap-4") }}
            </div>
        </div>
        <div class="row p-3">
            <div class="col-12">排序管理</div>
        </div>
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="defaultTypeTab" data-toggle="pill" href="#defaultTypeOrder" role="tab" aria-controls="defaultTypeOrder" aria-selected="true">預設分類</a>
                </li>
                @foreach($types as $type)
                    @if ($type->id !== 99999)
                        <li class="nav-item">
                            <a class="nav-link" id="typeTab{{ $type->id }}" data-toggle="pill" href="#typeOrder{{ $type->id }}" role="tab" aria-controls="typeOrder{{ $type->id }}" aria-selected="false">{{ $type->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="card-body p-0">
            <form action="{{ route('admin.item.sort.update') }}" method="POST">
                @csrf
                <div class="tab-content" id="tabContent">
                    <div class="tab-pane fade active show" id="defaultTypeOrder" role="tabpanel" aria-labelledby="defaultTypeTab">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th style="width: 10%">#</th>
                                <th>名稱</th>
                            </tr>
                            </thead>
                            <tbody class="sort_type_table">
                            @foreach($orphanItems as $child)
                                <tr>
                                    <input type="hidden" name="sort_default[]" value="{{ $child->id }}">
                                    <td>{{ $child->id }}</td>
                                    <td>{{ $child->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach($types as $type)
                        @if ($type->id !== 99999)
                            <div class="tab-pane fade" id="typeOrder{{ $type->id }}" role="tabpanel" aria-labelledby="typeOrder{{ $type->id }}">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th>名稱</th>
                                        </tr>
                                    </thead>
                                    <tbody class="sort_type_table">
                                        @foreach($type->items->where('status', 1)->sortBy('sort') as $child)
                                            <tr>
                                                <input type="hidden" name="sort_{{ $type->id }}[]" value="{{ $child->id }}">
                                                <td>{{ $child->id }}</td>
                                                <td>{{ $child->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="m-3">
                    <button type="submit" class="btn btn-primary">儲存</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-body -->
    <script>
        function processBatch(url) {
            if ($('.item-check-box:checked').length > 0) {
                $('#itemForm')[0].action = url;
                $('#itemForm')[0].submit();
            }
        }
    </script>
</div>
