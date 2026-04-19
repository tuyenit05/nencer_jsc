@extends('main')
@section('content')
<div id="content">
    <div class="col-md-12">
        <h3>Quản lý nhân viên:
            <span class="txt-strorage-name">{{ $employee->email }}</span>
        </h3>
        <div class="clear-fix"></div>
        <form action="{{ url('employee/update/' . $employee->id) }}" method="post" id="employee_edit_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="storage-name">kho phụ trách<span class="text-danger">*</span></label>
                    <select name="storages" id="storages" class="form-control">
                        @foreach($storages as $storage)
                        <option @if($storage->id == $employee->storage_id) selected @endif value="{{$storage->id}}">
                            {{$storage->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="password">mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" required class="form-control" name="password" value="">
                </div>
                <div class="col-md-3">
                    <br>
                    <button class="btn btn-primary float-right">chỉnh sửa</button>
                </div>
            </div>
        </form>
        <div class="col-md-12">
            <h4>tổng số đơn đã sử lý :<strong>44</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <p>Đơn hàng của nhân viên</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead>
                        <td>#</td>
                        <td>tên đơn hàng</td>
                        <td>danh mục đơn hàng </td>
                        <td>số lượng sản phẩm</td>
                        <td>Ngày giao hàng</td>
                        <td>tình trạng đơn hàng </td>
                </thead>
                <tbody>
                    @if (count($receipts) > 0)
                    @foreach ($receipts as $receipt)

                    <form id="form_update_receipt_{{$receipt->id}}" action="{{ url('receipts/update/' . $receipt->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <tr>
                            <td>{{$receipt->id}}</td>
                            <td>{{$receipt->name}}</td>
                            <td>{{$receipt->category_name}}</td>
                            <td>{{$receipt->quantity}}(VND)</td>
                            <td>{{$receipt->delivery_date}}</td>
                            <td>
                                <select name="status" id="status" class="form-control" onchange="updateReceipt({{ $receipt->id }})">
                                    <option @if($receipt->status == 0) selected @endif value="0">chưa xử lý</option>
                                    <option @if($receipt->status == 1) selected @endif value="1">đang xử lý</option>
                                </select>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script>
    //js method send update receipt tosever
    function updateReceipt(receiptId) {
        $('#form_update_receipt_' + receiptId).submit();
    }
</script>