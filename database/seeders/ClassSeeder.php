<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Run Seeder Bahkan Jika Table Sudah Terisi Data
        Schema::disableForeignKeyConstraints();
        ClassRoom::truncate();
        Schema::enableForeignKeyConstraints();

        # Seeder Loop
        $data = [
            ['name' => '1A', 'teacher_id' => '1'],
            ['name' => '1B', 'teacher_id' => '2'],
            ['name' => '1C', 'teacher_id' => '3'],
            ['name' => '1D', 'teacher_id' => '4'],
            ['name' => '1E', 'teacher_id' => '5'],
        ];

        # Run Seeder Loop
        foreach ($data as $val)
        {
            ClassRoom::insert([
                'name' => $val['name'],
                'teacher_id' => $val['teacher_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
