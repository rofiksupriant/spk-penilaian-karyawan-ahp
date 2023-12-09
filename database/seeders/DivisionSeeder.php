<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("divisions")->insert([
            [
                "name"       => "Keuangan & SDM",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Suply Chain",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Marketing",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Riset & Pengembangan",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Produksi",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Instalasi & Perbaikan",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Desain",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Umum",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name"       => "Admin",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
        ]);
    }
}
