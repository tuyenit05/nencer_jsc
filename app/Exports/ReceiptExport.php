<?php

namespace App\Exports;
use App\Models\Receipt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class ReceiptExport implements FromCollection
{
    private $date;
    /**
     * @param mixed $date fiter
     */
    public function __construct($date)
    {
        $this->date = $date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //lenh query de lay du lieu export
        $receipts = Receipt::join('categories', 'receipts.category_id', 'categories.id')
        ->select(
            'receipts.id','receipts.name','categories.name as category_name',
            'receipts.total_price','receipts.quantity','receipts.delivery_date',
            'receipts.note','receipts.type' ,'receipts.status'
              
        )->where('receipts.created_at', '>=', $this->date)->get();
        //kiem tra  neu co du lieu thi convert lai truonng type vaf stauts
        if(count($receipts) > 0) {
            foreach ($receipts as $receipt) {
                if ($receipt->type == Receipt::Instock) {
                    $receipt->type_txt = "đơn nhập" ;
                }
                if($receipt->type == Receipt::Outstock) {
                    $receipt->type_txt = "đơn xuất" ;
                }

                //convert status 0:processing, 1:done
                if($receipt->status == Receipt::STATUS_PROCESSING) {
                    $receipt->status_txt = "đang xử lý" ;
                }
                if($receipt->status == Receipt::STATUS_DONE) {
                    
                    $receipt->status_txt = "hoàn thành" ;
                }
                unset($receipt->type, $receipt->status);
            }
        }
        $delyvery_date = Carbon::create($receipt->delyvery_date);
        $receipt->delyvery_date = $delyvery_date->format('d/m/Y');
        unset($receipt->type, $receipt->status);

    }
    /**
     * set heading for sheet
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'ID',
            'Tên đơn hàng',
            'Danh mục',
            'Tổng chi phí(VNĐ)',
            'Số sản phẩm',
            'Ngày giao ',
            'Ghi chú',
            'Loại',
            'Trạng thái'
        ];
    }
}
