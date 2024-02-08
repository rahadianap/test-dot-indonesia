<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FetchnStoreProvinces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-store:provinces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and Store Cities Data From https://api.rajaongkir.com/starter/province';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = 'https://api.rajaongkir.com/starter/province';

        $response = Http::get($baseUrl, [
            'key' => '0df6d5bf733214af6c6644eb8717c92c'
        ]);

        $result = json_decode($response->getBody(), true);

        $data = $result['rajaongkir']['results'];

        foreach($data as $item)
        {
            DB::beginTransaction();
            try {
                DB::table('provinces')->insert([
                    'province_id' => $item['province_id'],
                    'province' => $item['province'],
                    'created_at' => Carbon::now()->toDateTimeString()
                ]);
                DB::commit();
            } catch(\Exception $e) {
                DB::rollback();
                echo '--- Data Fetched and Stored Unsuccessfully ---';
                return false;
            }
        }
        echo '--- Data Fetched and Stored Successfully ---';
    }
}
