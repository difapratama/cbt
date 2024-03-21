<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Navigation::create([
            'name' => 'Master',
            'url' => 'master',
            'icon' => 'ti-setting',
            'main_menu' => null,
        ]);

        Navigation::create([
            'name' => 'Roles',
            'url' => 'master/roles  ',
            'icon' => '',
            'main_menu' => 1,
        ]);

        Navigation::create([
            'name' => 'Category',
            'url' => 'master/categories  ',
            'icon' => '',
            'main_menu' => 1,
        ]);

        Navigation::create([
            'name' => 'Logout',
            'url' => 'logout',
            'icon' => 'ti-setting',
            'main_menu' => null,
        ]);
    }
}
