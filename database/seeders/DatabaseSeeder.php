<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Program;
use App\Models\Research;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Department::factory(4)->create();

        Program::factory(count: 4)->create();

        User::factory(6)->create();
        User::factory(1)->admin()->create();
        User::factory(19)->fullDetails()->create();


    }
}
