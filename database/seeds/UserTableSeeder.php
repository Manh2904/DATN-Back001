<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::Class,1000)->create();
        // factory(App\Models\Rating::class,1000)->create();
        factory(App\Models\Category::class, 1000)->create();
        factory(App\Models\Keyword::class, 1000)->create();
        factory(App\Models\Admin::class, 1000)->create();
        factory(App\Models\Product::class, 1000)->create();
    }
}
