@extends('main')
@section('content')
<div id="content">
    <div class="col-md-12">
        <h3>Quản lý hóa đơn</h3>
        <div class='clear-fix'></div>
        <form action="{{url('/receipts/index') }}" method="get">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="search"
                        placeholder="tìm kiếm theo mã hóa đơn">
                </div>
                <div class="col-md-3">
                    <select name="storage_id" class="form-control" id="storages">
                        @foreach($storage as $storage)
                        <option value="{{$storage->id}}">{{$storage->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="employee_id" class="form-control" id="">
                        <option value="">------</option>
                        <option value="1">Đã xử lý</option>
                        <option value="0">chưa xử lý</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <td>#</td>
                <td>kho</td>
                <td>danh mục</td>
                <td>chi phí</td>
                <td>số lượng</td>
                <td>ghi chú</td>
                <td>ngày giao</td>
                <td>loại</td>
                <td>người tạo</td>
                <td>tên hóa đơn</td>
                <td>trạng thái</td>
                <td>Thao tác</td>
            </thead>

            <tbody class="text-center">
                @if (count($receipts) > 0)
                @foreach ($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->storage_name }}</td>
                    <td>{{ $receipt->category_name }}</td>
                    <td>{{ $receipt->total_price }}</td>
                    <td>{{ $receipt->quantity }}</td>
                    <td>{{ $receipt->note }}</td>
                    <td>{{ $receipt->delivery_date }}</td>
                    <td>{{ $receipt->type_txt }}</td>
                    <td>{{ $receipt->email }}</td>
                    <td>{{ $receipt->receipt_name }}</td>
                    <td>{{ $receipt->status_txt }}</td>
                    <td>
                        <a href="{{ url('receipts/detail/' . $receipt->id) }}" class="btn btn-primary">
                            chi tiết
                        </a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ $receipts->links() }}
    </div>
</div>
@endsection