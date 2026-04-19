<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     * 
     * return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::with('receipts')->get();
        foreach ($categories as $category) {
            // Duyet tung don hang cuar tung category
            $totalReceiptsInStock = 0;
            $totalReceiptsOutStock = 0;
            $totalProduct = 0;
            foreach ($category->receipts as $receipt) {
                //kiem tra xem do nhap thi cong tong
                if ($receipt->type == Receipt::Instock) {
                    $totalReceiptsInStock++;
                }
                //kiem tra xem don xuat thi cong tong
                if ($receipt->type == Receipt::Outstock) {
                    $totalReceiptsOutStock++;
                }
                //cong tong so san pham cua category
                $totalProduct += $receipt->quantity;
            }
            //sau khi tinh toan xong thi in ra gia tri cho doi tuong
            $category->total_receipts_in_stock = $totalReceiptsInStock;
            $category->total_receipts_out_stock = $totalReceiptsOutStock;
            $category->total_product = $totalProduct;
        }
        return view("pages.category.index", compact('categories'));
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
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
