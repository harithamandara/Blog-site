<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        (new Department())->create([
            'name' => 'Department 1',
            'sort_order' => 1,
            'status' => 1,
        ]);

        (new Department())->create([
            'name' => 'Department 2',
            'sort_order' => 1,
            'status' => 1,
        ]);

        (new Department())->create([
            'name' => 'Department 3',
            'sort_order' => 1,
            'status' => 1,
        ]);

        \App\Models\Post::factory(100)->create();
        \App\Models\Category::factory(5)->create();

         \App\Models\User::factory()->create([
             'name' => 'User',
             'email' => 'user@user.lk',
             'password' => bcrypt('123456789'),
             'department_id' => 1,
             'academic_year' => 1,
             'role' => 'ADMIN'
         ]);

        \App\Models\User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@editor.lk',
            'password' => bcrypt('123456789'),
            'department_id' => 1,
            'academic_year' => 1,
            'role' => 'EDITOR'
        ]);
    }
}
