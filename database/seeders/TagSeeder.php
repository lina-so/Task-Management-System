<?php

namespace Database\Seeders;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tags')->delete();

        $bgs = ['tag 1', 'tag 2', 'tag 3', 'tag 4', 'tag 5', 'tag 6'];

        foreach($bgs as  $bg){
            Tag::create(['name' => $bg]);
        }
    }
}
