<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        'name' => 'verf-1',
        'slug' => 'verf-1',
        'details' => 'test, test, test',
        'volume' => '1, 2, 5',
        'price' => 149999,
        'description' => 'lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum
            lorem ipsum test lorem ipsum'


        ])->categories()->attach(1);

        $product = Product::find(1);
        $product->categories()->attach(2);


        Product::create([
            'name' => 'verf-2',
            'slug' => 'verf-2',
            'details' => 'test, test, test',
            'volume' => '1, 2, 5',
            'price' => 149999,
            'description' => 'lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum
            lorem ipsum test lorem ipsum'

        ])->categories()->attach(2);

        Product::create([
            'name' => 'verf-3',
            'slug' => 'verf-3',
            'details' => 'test, test, test',
            'volume' => '1, 2, 5',
            'price' => 149999,
            'description' => 'lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum
            lorem ipsum test lorem ipsum'

        ])->categories()->attach(3);

        Product::create([
            'name' => 'verf-4',
            'slug' => 'verf-4',
            'details' => 'test, test, test',
            'volume' => '1, 2, 5',
            'price' => 149999,
            'description' => 'lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum
            lorem ipsum test lorem ipsum'

        ])->categories()->attach(4);

        Product::create([
            'name' => 'verf-5',
            'slug' => 'verf-5',
            'details' => 'test, test, test',
            'volume' => '1, 2, 5',
            'price' => 149999,
            'description' => 'lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum
            lorem ipsum test lorem ipsum'

        ])->categories()->attach(5);

        Product::create([
            'name' => 'verf-6',
            'slug' => 'verf-6',
            'details' => 'test, test, test',
            'volume' => '1, 2, 5',
            'price' => 149999,
            'description' => 'lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum lorem ipsum test lorem ipsum
            lorem ipsum test lorem ipsum'

        ])->categories()->attach(6);
    }
}
