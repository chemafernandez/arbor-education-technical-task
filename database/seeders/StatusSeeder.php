<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['name' => $_ENV['MESSAGE_TYPE_SENT']]);
        Status::create(['name' => $_ENV['MESSAGE_TYPE_DELIVERED']]);
        Status::create(['name' => $_ENV['MESSAGE_TYPE_FAILED']]);
        Status::create(['name' => $_ENV['MESSAGE_TYPE_REJECTED']]);
    }
}
