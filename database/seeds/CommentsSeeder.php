<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$faker = Faker\Factory::create();

        $limit = 10;
        // $limit1 = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('comments')->insert([ 
                'id_posts' => $faker->id_posts,
                'nama' => $faker->unique()->nama,
                'email' => $faker->unique()->email,
                'judul' => $faker->judul,
                'deskripsi' => $faker->deskripsi,
                'read' => $faker->read,
            ]);
        }*/

        /*for ($i = 0; $i < $limit1; $i++) {
            DB::table('comments')->insert([ 
                'id_posts' => $faker->id_posts,
                'nama' => $faker->unique()->nama,
                'email' => $faker->unique()->email,
                'judul' => $faker->judul,
                'deskripsi' => $faker->deskripsi,
                'read' => $faker->read,
                'parent' => $faker->parent,
            ]);
        }*/
    }
}
