<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use Illuminate\Console\Command;

class DemoCrontab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo-crontab';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Thêm 3 category mới
        for ($i = 7; $i <= 9; $i++) {
            DB::table('categories')->insert([
                'name'       => 'Category' . $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
