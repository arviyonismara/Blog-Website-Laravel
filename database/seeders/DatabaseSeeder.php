<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // untuk menjalankan ketik php artisan db:seed

        // jika ingin buat ulang migrate fresh, ketik php artisan migrate:fresh --seed

        User::create([
            'name' => 'Arvie Yonismara',
            'username' => 'arviyonismara',
            'email' => 'arviyonismara@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // User::create([
        //     'name' => 'Arvie',
        //     'email' => 'arvie@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        // factory sudah dibuat di file PostFactory
        // disini kita tinggal memanggil perintah untuk membuat jumlah yang akan digenerate
        Post::factory(20)->create();
        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe,',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe, fuga inventore et totam voluptatem eos necessitatibus sunt, qui itaque enim magnam praesentium. Harum exercitationem aliquam quaerat voluptas dolorem, ipsa blanditiis dolore ratione voluptatum suscipit beatae optio vitae totam sapiente, nemo pariatur numquam recusandae maiores nihil.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe,',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe, fuga inventore et totam voluptatem eos necessitatibus sunt, qui itaque enim magnam praesentium. Harum exercitationem aliquam quaerat voluptas dolorem, ipsa blanditiis dolore ratione voluptatum suscipit beatae optio vitae totam sapiente, nemo pariatur numquam recusandae maiores nihil.',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe,',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe, fuga inventore et totam voluptatem eos necessitatibus sunt, qui itaque enim magnam praesentium. Harum exercitationem aliquam quaerat voluptas dolorem, ipsa blanditiis dolore ratione voluptatum suscipit beatae optio vitae totam sapiente, nemo pariatur numquam recusandae maiores nihil.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Keempat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe,',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita recusandae, minima quisquam repellendus saepe, fuga inventore et totam voluptatem eos necessitatibus sunt, qui itaque enim magnam praesentium. Harum exercitationem aliquam quaerat voluptas dolorem, ipsa blanditiis dolore ratione voluptatum suscipit beatae optio vitae totam sapiente, nemo pariatur numquam recusandae maiores nihil.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
