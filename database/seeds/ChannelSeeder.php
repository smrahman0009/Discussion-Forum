<?php

use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel','slug' =>Str::slug('Laravel')];
        $channel2 = ['title' => 'VueJS','slug' =>Str::slug('VueJS')];
        $channel3 = ['title' => 'NodeJS','slug' =>Str::slug('NodeJS')];
        $channel4 = ['title' => 'JAVA','slug' =>Str::slug('JAVA')];
        $channel5 = ['title' => 'dotNET','slug' =>Str::slug('dotNET')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
    }
}
