<?php
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Category::insert([
            ['name' => 'mengverf1', 'slug' => 'mengverf1', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'mengverf2', 'slug' => 'mengverf2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'mengverf3', 'slug' => 'mengverf3', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'mengverf4', 'slug' => 'mengverf4', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'mengverf5', 'slug' => 'mengverf5', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'mengverf6', 'slug' => 'mengverf6', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'mengverf7', 'slug' => 'mengverf7', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
