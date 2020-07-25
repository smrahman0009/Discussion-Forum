<?php

use App\Reply;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content_1 = "It is a long established fact that a reader will be distracted by the readable content__ of a page when looking at its layout. ";
        $content_2 = "It is a long established fact that a reader will be distracted by the readable content_ of a page when looking at its layout. ";
        $content_3 = "It is a long established fact that a reader will be distracted by the readable content__ of a page when looking at its layout. ";
        $content_4 = "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ";

        $reply_1 =   [
            'user_id' => '1',
            'discussion_id'=>'1',
            'content' => $content_1,
        ];
        $reply_2 =   [
            'user_id' => '1',
            'discussion_id'=>'2',
            'content' => $content_2,
        ];
        $reply_3 =   [
            'user_id' => '2',
            'discussion_id'=>'3',
            'content' => $content_3,
        ];
        $reply_4 =   [
            'user_id' => '2',
            'discussion_id'=>'4',
            'content' => $content_3,
        ];

        Reply::create($reply_1);
        Reply::create($reply_2);
        Reply::create($reply_3);
        Reply::create($reply_4);
    }
}
