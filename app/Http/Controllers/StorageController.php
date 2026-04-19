<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Models\Storage;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storages = Storage::leftJoin('receipts', 'storages.id', 'receipts.storage_id')
            ->select(
                'storages.id', 'storages.name', 'storages.cost',
                DB::raw('SUM(receipts.quantity) as total')
                )->whereNull('storages.deleted_at')
                ->groupBy('storages.id', 'storages.name', 'storages.cost')->get();
        return view('pages.storage.index', compact('storages'));
    }

    /**
     * controller method soft delete storage.
     * @param [int] $id of storage
     * 
     * return \Illuminate\Http\RedirectResponse
     */

    public function delete($id)
    {
    $storage = Storage::find($id);
    $storage->deleted_at = date('Y-m-d h:i:s');
    $storage->update();
    return redirect('/storages/index');
    }
    public function create()
    {
        return view('pages.storage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pararm = $request->all();
        $storage = new Storage();
        $storage->name = $pararm['name'];
        $storage->cost = $pararm['cost'];
        $storage->save();
        return redirect('/storages/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $storage = Storage::find($id);
        // neu khong tim thay storage thi dieu huong ve man hinh index. "khong":Unknown
        if (!$storage) {
            return redirect('/storages/index');
        }
        $receipts = Receipt::join('categories', 'receipts.category_id', 'categories.id')
        ->select(
            'receipts.id','receipts.name','categories.name as category_name',
            'receipts.total_price','receipts.quantity','receipts.delivery_date',
            'receipts.note','receipts.type' ,'receipts.status'
              
        )->where('storage_id',$storage->id)->get();
        $totalReceipted = 0;
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
                    $totalReceipted ++;
                    $receipt->status_txt = "hoàn thành" ;
                }
            }
        }

        return view('pages.storage.edit', compact('storage', 'receipts','totalReceipted'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $storage = Storage::find($id);
        // neu khong tim thay storage   
        $param = $request->all();
        $storage->name = $param['name'];
        $storage->cost = $param['cost'];
        $storage->update();
        return redirect('/storages/edit/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
