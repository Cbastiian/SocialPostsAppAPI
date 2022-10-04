<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ReportReasesonsSeeder extends Seeder
{
    public function run()
    {
        DB::table('report_reasons')->delete();
        $json = File::get('database/data/report_reasons.json');
        $data = json_decode($json);

        foreach ($data as $obj) {
            DB::table('report_reasons')->insert([
                'name' => $obj->name,
                'description' => $obj->description,
                'code' => $obj->code,
                'auto_punish_limit' => $obj->auto_punish_limit
            ]);
        }
    }
}
