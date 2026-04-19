@extends('main')
@section('content')
 <div id="content">
                <div class="col-md-12">
                    <h3>Thêm mới</h3>
                    <a class="btn btn-primary float-right" href="{{ url('storages/index') }}">danh sách</a>
                    <div class='clear-fix'></div>
                    <div id="create_storage_box" class="card-section col-md-3">
                        <h1 class="text-center">Thêm mới</h1>
                        <br>
                        <form action="{{ url('storages/store') }}" method="post" id="login_form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="name"><strong>Tên kho</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Kho ngọc trục" class="form-control">
                            <br>
                            <label for="cost"><strong>Phí duy trì</strong> <span class="text-danger">*</span></label>
                            <input type="number" min="1" name="cost" placeholder="15,000,000" class="form-control">
                            <br>
                            <button type="submit" class="btn btn-primary float-right">Thêm Kho</button>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
@endsection "endsection":unknown