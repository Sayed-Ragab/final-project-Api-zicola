<?php

namespace Database\Seeders;

use App\Models\Boold_Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Boold_GroupFactory extends Seeder
{
    
    public function run(): void
    {
        Boold_Group::factory()->count(7)->create();
    }
}
