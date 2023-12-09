<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $csvFile = fopen(base_path("database/data/employee-full.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Employee::create([
                    "ein"         => str_pad($data['0'], 6, '0', STR_PAD_LEFT),
                    "name"        => $data['1'],
                    "division_id" => $data['3'],
                    "assessor_id" => $data['4'],
                    "created_at"  => Carbon::now(),
                    "updated_at"  => Carbon::now(),
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
