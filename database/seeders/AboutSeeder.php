<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        //
        $about = new \App\Models\About;
        $about->title = 'Tentang kami';
        $about->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse gravida dui id ultricies bibendum. Maecenas elit nisl, varius volutpat interdum viverra, euismod eget augue. Nam ante odio, viverra ac risus a, bibendum euismod tortor. Etiam imperdiet ullamcorper lacus, at sagittis lorem facilisis sagittis. Praesent sed enim sed risus efficitur facilisis in at elit. Curabitur ac turpis vestibulum, rutrum lorem eu, bibendum sem. Etiam semper vel dolor et laoreet. Curabitur velit sem, faucibus id molestie quis, efficitur nec justo. ';
        $about->img = 'about.jpg';
        $about->save();

    }
}
