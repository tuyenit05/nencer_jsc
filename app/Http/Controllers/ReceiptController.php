<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Exports\ReceiptExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $storage = Storage::get();
        $param = request()->all();
        //list all receipt
        $receipts = Receipt::join(
            'storages', 'receipts.storage_id', '=', 'storages.id'
        )->join(
            'categories', 'receipts.category_id', '=', 'categories.id'
        )->join(
            'users', 'receipts.user_id', '=', 'users.id'
        )->select(
            'receipts.id','storages.name as storage_name', 'categories.name as category_name', 
             'receipts.total_price', 'receipts.quantity', 'receipts.note',
             'receipts.delivery_date', 'receipts.type','users.email',
             'receipts.name as receipt_name', 'receipts.status'
        )->where(function($query) use ($param) {
            if(isset($param['receipt_id'])) {
                $query->where('receipts.id', $param['receipt_id']);
            }
            if(isset($param['storage_id'])) {
                $query->where('storages.id', $param['storage_id']);
            }
            if(isset($param['status'])) {
                $query->where('receipts.status', $param['status']);
            }
               
         }     
        )->orderBy('receipts.status', 'desc')
        ->paginate(30);
        if(count($receipts) > 0) {
            foreach($receipts as $receipt) {
                $delivery_date =  Carbon::create($receipt->delivery_date);
                $receipt->delivery_date = $delivery_date->format('d/m/Y');
                $receipt->type_txt = $receipt->type == Receipt::Instock ? "Đơn nhập" : "Đơn xuất";
                $receipt->status_txt = $receipt::STATUS_DONE ? "Đã hoàn thành" : "đang sử lý";
            }
        }
        return view ('pages.receipt.index', compact('storage', 'receipts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        //list all receipt
        $receipt = Receipt::join(
            'storages', 'receipts.storage_id', '=', 'storages.id'
        )->join(
            'categories', 'receipts.category_id', '=', 'categories.id'
        )->join(
            'users', 'receipts.user_id', '=', 'users.id'
        )->select(
            'receipts.id','storages.name as storage_name', 'categories.name as category_name', 
             'receipts.total_price', 'receipts.quantity', 'receipts.note',
             'receipts.delivery_date', 'receipts.type','users.email',
             'receipts.name as receipt_name', 'receipts.status'
        )->where('receipts.id', $id)->first();
                $delivery_date =  Carbon::create($receipt->delivery_date);
                $receipt->delivery_date = $delivery_date->format('d/m/Y');
                $receipt->type_txt = $receipt->type == Receipt::Instock ? "Đơn nhập" : "Đơn xuất";
                $receipt->status_txt = $receipt::STATUS_DONE ? "Đã hoàn thành" : "đang sử lý";
        return view ('pages.receipt.detail', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // lay toan bo du lieu tu form gui len
        $param = $request->all();
        $receipt = Receipt::find($id);
        $receipt->status = $param['status'];
        $receipt->update();
        //sau khi aipdate xong se quay tro ve trang cu
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * controller methor export excel receipt flie
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function export()
    {
        //goi class export de xuat file excel
        $param = request()->all();
        // Tham so se la [ class export, ten file excel]
        return Excel::download(new ReceiptExport($param['date']), 'receipts.xlsx');
    }
}
