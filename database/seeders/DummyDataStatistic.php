<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DummyDataStatistic extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert to table users
        $userData = [];
        for ($i = 6 ; $i < 300; $i++) {
            $userData[] = [
                "id" => $i,
                "email" => "employee" . $i . "@gmail.com",
                "password" => "12345678",
                "role" => User::ROLE_EMPLOYEE,
                "storage_id" => rand(1, 4)
            ];
        }
        //insert to table storages
        $receiptData = [];//3000 record
        for ($i = 0; $i < 3000; $i++) {
            $receiptData[] = [
                "storage_id" => rand(1,4),
                "category_id" => rand(1,4),
                "total_price" => rand(1000, 9999),
                "quantity" => rand(1, 99),
                "note" => "DUMMY",
                "delivery_date" => Carbon::now()->subDays(rand(1,365)),
                "type" => rand(1,2),
                "user_id" => rand(6,306),
                "image" => null,
                "name" => "DUMMY" .$i,
                "logistics_provider_id" => rand(1,3),
                "status" => rand(0,1)
            ];
        }
        //begin insert to db

        try{
            DB::beginTransaction();
            DB::table('users')->insert($userData);
            $chunkData = array_chunk($receiptData, 1000);
            foreach ($chunkData as $data) {
                DB::table('receipts')->insert($data);
            }
            DB::commit();
        }catch(\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
        }
    }
}
