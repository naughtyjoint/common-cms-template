<div class="card" id="type">
    <div class="card-header widget-block">
        <h3 class="card-title">
            <strong>分類管理</strong>
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
                <a href="{{ route('admin.type.create') }}">
                    <button type="button" class="btn btn-primary">新增分類</button>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <a href={{ request()->fullUrlWithQuery(['type_sort' => 'ASC']) }}>
                            排序
                        </a>
                    </th>
                    <th>出貨單排序</th>
                    <th>名稱</th>
                    <th>資訊</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->sort }}</td>
                        <td>{{ $type->ship_sort }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->description }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm text-white"
                               href="{{ route('admin.type.edit', ['id' => $type->id]) }}">編輯</a>
                            @if($type->id != 99999)
                                <a class="btn btn-danger btn-sm text-white"
                                   href="{{ route('admin.type.delete', ['id' => $type->id]) }}">刪除</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="ml-3">
                {{ $types->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
</div>
