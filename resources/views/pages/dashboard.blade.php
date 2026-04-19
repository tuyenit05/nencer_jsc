@extends("main")
@section("content")
<div id="content">
    <div id="total" class="col-md-3"></div>
    <div class="row">
        <div id="order-shipping" class="box-total ">
            <h1>99</h1>
            <hr>
            <p>tổng số đơn hàng đang vận chuyển</p>
        </div>
        <div id="order-in-stock" class="box-total ">
            <h1>99</h1>
            <hr>
            <p>tổng số đơn nhập kho</p>
        </div>
        <div id="order-out-stock" class="box-total ">
            <h1>99</h1>
            <hr>
            <p>tổng số đơn xuất kho</p>
        </div>
        <div id="order-profit" class="box-total ">
            <h1>99</h1>
            <hr>
            <p>tỷ xuất lợi nhuận</p>
        </div>
    </div>
</div>
<!--begin charts-->
<div id="charts" class="col-md-12">
    <div class="row">
        <div id="areaExportInMonth" class="col-md-8">
            <h4>Biểu đồ thống kê đơn nhập xuất theo tháng </h4>
            <div class=" col-md-12 d-flex">
                <input type="datetime-local" id="txtChooseMonthForChart" class="form-control txt-choose-month" />
                &nbsp;
                <button class="btn btn-primary">thống kê</button>
            </div>
            <div class="clear-fix"></div>
            <div>
                <canvas id="chartExportInMonth"></canvas>
            </div>
        </div>
        <div id="areaImportExportRatioMonth" class="col-md-8">
            <h4>Thống kê tỉ lệ giữa nhập và xuất theo tháng </h4>
            <div class=" col-md-12 d-flex">
                <input type="datetime-local" id="txtChooseMonthForChart" class="form-control txt-choose-month" />
                &nbsp;
                <button class="btn btn-primary">thống kê</button>
            </div>
            <div class="clear-fix"></div>
            <div>
                <canvas id="chartExportInMonth"></canvas>
            </div>
        </div>
        <div id="areaChartInterestRate" class="col-md-7">
            <h4>Biểu đồ thể hiện lãi suất </h4>
            <div class=" col-md-12 d-flex">
                <input type="datetime-local" id="txtChooseMonthForChart" class="form-control txt-choose-month" />
                &nbsp;
                <input type="datetime-local" id="txtChooseMonthForChart" class="form-control txt-choose-month" />
                &nbsp;
                <button class="btn btn-primary">thống kê</button>
            </div>
            <div class="clear-fix"></div>
            <div>
                <canvas id="chartInterestRate"></canvas>
            </div>
        </div>
        <div id="areaChartProductCategory" class="col-md-7">
            <h4>Thống kê số lượng sản phẩm theo danh mục</h4>
            <div class="clear-fix"></div>
            <div class="clear-fix"></div>
            <div>
                <canvas id="chartProductCategory"></canvas>
            </div>
            <p>thống kê theo các mốc thời gian mà bạn có thể lựa chọn tùy ý</p>
            <p>Đối với biểu đồ thể hiện lãi suất sẽ thống kê theo một khoảng thời gian</p>
            <p>Đối với biểu đồ tổng số đơn hàng theo danh mục sẽ là tổng thời gian từ đầu đến cuối</p>
        </div>

        <div class="col-md-4"></div>
        <div class="clear-fix"></div>
        <div class="col-md-7"></div>
        <div class="col-md-5"></div>
    </div>
</div>
<!--end charts-->
@endsection