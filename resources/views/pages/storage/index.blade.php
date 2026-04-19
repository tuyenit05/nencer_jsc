 @extends('main')
 @section('content')

 <div id="content">
     <div class="col-md-12">
         <h3>Quản lý kho</h3>
         <a class="btn btn-primary float-right" href="{{ url('/storages/create') }}">thêm mới</a>
         <div class='clear-fix'></div>
         <table class="table table-bordered table-hover">
             <thead>
                 <td>#</td>
                 <td>tên kho</td>
                 <td>phí duy trì</td>
                 <td>tổng đơn hàng trong kho</td>
                 <td>Thao tác</td>
             </thead>
             <tbody>
                 @foreach ($storages as $storage)
                 <tr>
                     <td>{{ $storage->id }}</td>
                     <td>{{ $storage->name }}</td>
                     <td>{{ number_format($storage->cost,0) }}</td>
                     <td>{{ $storage->total }}</td>
                     <td>
                         <a class="btn btn-primary" href="{{url('/storages/edit/'.$storage->id) }}">chi tiết</a>
                         <a class="btn btn-danger" href="{{ url('/storages/delete/'.$storage->id) }}">xóa</a>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
 @endsection