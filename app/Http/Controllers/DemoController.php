<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Receipt;

class DemoController extends Controller
{
    public function index()
    {
        // tuong duong lenh sql select * from categories
        $categories = Category::get();// Eloquent
        // ten cua file file ,compact la bien dư lieu đuoc trar ve cho view.
        return view('demo', compact('categories'));

    }
    /**
     * controller method get data an category
     * 
     * @param Request $request
     * @param mixed $id of category
     * @return \Illuminate\View\View\Factory|\Illuminate\View\View
     */

    public function detail(Request $request, $id)
    {
        // tuong duong lenh sql select * from categories where id = $id
        $category = Category::where('id', $id)->first();
        return view('detail', compact('category'));
    }

    public function update(Request $request, $id)
    {
        //lay du lieu tu form 
        $param = $request->all();
        $category= Category::where('id', $id)->first();
        $category->name = $param['name'];// nam cua the input name = "name"
        $category->update();
        // goi lai file view detail sau khi update thanh cong
        return view('detail', compact('category'));
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::where('id', $id)->delete();
        // điều hướng theo router.
        return redirect('/demo-laravel');

    }

    public function queryBuilder(Request $request)
    {
        //sql get all cantegory
        $categories = DB::table('categories')
            ->where('created_at', '<>', null)
            ->orderBy('id', 'DESC')
            ->get();
            //sql get all receipts
        $receipts = DB::table('receipts')
        ->select(
            'receipts.id','receipts.total_price','receipts.quantity','receipts.note',
            'receipts.delivery_date','receipts.type','receipts.image','receipts.name',
            'receipts.status',
            'users.email',
            'storages.name',
            'logistics_providers.name',
            'categories.name',

        )
            ->join('users', 'receipts.user_id', '=', 'users.id')
            ->join('categories', 'receipts.category_id', '=', 'categories.id')
            ->join('storages', 'receipts.storage_id', '=', 'storages.id')
            ->join('logistics_providers', 'receipts.logistics_providers_id', '=', 'logistics_providers.id')
            ->where('users.created_at', '<>', null)
            ->orderBy('users.id', 'DESC')
            ->get();
        $sqlTotal = DB::table('categories') 
            ->select(
                'categories.name',
                DB::raw("COUNT(receipts.id) as total_receipts"),
            )
            ->leftjoin('receipts', 'categories.id', '=', 'receipts.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->get();
        return [
            "categories" => $categories,
            "receipts" => $receipts,
            "sqlTotal" => $sqlTotal
        ];
    }

    public function eloquent(Request $request)
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $receipts = Receipt::select(
            'receipts.id','receipts.total_price','receipts.quantity','receipts.note',
            'receipts.delivery_date','receipts.type','receipts.image','receipts.name',
            'receipts.status',
            'users.email',
            'storages.name',
            'logistics_providers.name',
            'categories.name'

        )
            ->join('users', 'receipts.user_id', '=', 'users.id')
            ->join('categories', 'receipts.category_id', '=', 'categories.id')
            ->join('storages', 'receipts.storage_id', '=', 'storages.id')
            ->join('logistics_providers', 'receipts.logistics_providers_id', '=', 'logistics_providers.id')
            ->where('users.created_at', '<>', null)
            ->orderBy('users.id', 'DESC')
            ->get();
            $relations = Category::with('receipts','receipts.storage','receipts.category'
            )->get();
        return [
            "categories" => $categories,
            "receipts" => $receipts,
            "relations" => $relations
        ];
    }
}
