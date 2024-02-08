<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FetchnStoreCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-store:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and Store Cities Data From https://api.rajaongkir.com/starter/city';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = 'https://api.rajaongkir.com/starter/city';

        $response = Http::get($baseUrl, [
            'key' => '0df6d5bf733214af6c6644eb8717c92c'
        ]);

        $result = json_decode($response->getBody(), true);

        $data = $result['rajaongkir']['results'];

        foreach($data as $item)
        {
            DB::beginTransaction();
            try {
                DB::table('cities')->insert([
                    'city_id' => $item['city_id'],
                    'province_id' => $item['province_id'],
                    'province' => $item['province'],
                    'type' => $item['type'],
                    'city_name' => $item['city_name'],
                    'postal_code' => $item['postal_code'],
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
