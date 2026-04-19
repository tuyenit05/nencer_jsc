<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $employees = User::select(
            'users.id', 
            'users.email',
            'storages.name as storage_name', // Đặt alias để tránh trùng tên nếu cần
            DB::raw('COUNT(receipts.user_id) as total_receipt')
        )
        ->join('storages', 'users.storage_id', '=', 'storages.id') 
        ->leftJoin('receipts', 'receipts.user_id', '=', 'users.id')
        ->where('users.role', 0)
        ->groupBy('users.id', 'users.email', 'storages.name')
        ->get();

    return view('pages.employee.index', compact('employees'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $storages = Storage::get();
        return view('pages.employee.create', compact('storages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $user = new User();
        $user->email =$param['email'];
        $user->password = $param['password'];
        $user->storage_id = $param['storages'];
        $user->role = User::ROLE_EMPLOYEE;
        $user->save();
        return redirect('/employee/index');
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $employee = User::find($id);
        $storages = Storage::all();
        $receipts = Receipt::join(
            'categories', 'receipts.category_id', 'categories.id'
        ) -> select(
            'receipts.id', 'receipts.name as receipts_name',
            'categories.name as category_name',
             'receipts.quantity','receipts.delivery_date',
              'receipts.status'
        )   
            ->where('user_id', $id)
            ->orderBy('status', 'ASC')
            ->paginate(30);
        return view('pages.employee.detail', compact('employee', 'storages', 'receipts'));
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
        $param = $request ->all();
        $user = User::find($id);
        $user -> storage_id = $param['storages'];
        $user -> password = $param['password'];
        $user -> update();
        return redirect('/employee/detail/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
