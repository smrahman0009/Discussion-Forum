<?php

use App\Discussion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title_1 = 'Laravel passwort tools not working';
        $title_2 = 'NodeJS front viewer tools not installed';
        $title_3 = 'JAVAFX framework suck?';
        $title_4 = 'Laravel vs NodeJs which one is best?';

        $discussion_1 = [
            'title' => $title_1,
            'slug' => Str::slug($title_1,'-'),
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
            'user_id' => '2',
            'channel_id' => '1',
        ];

        $discussion_2 = [
            'title' => $title_2,
            'slug' => Str::slug($title_2,'-'),
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
            'user_id' => '2',
            'channel_id' => '2',
        ];

        $discussion_3 = [
            'title' => $title_3,
            'slug' => Str::slug($title_3,'-'),
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
            'user_id' => '1',
            'channel_id' => '3',
        ];

        $discussion_4 = [
            'title' => $title_4,
            'slug' => Str::slug($title_4,'-'),
            'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
            'user_id' => '1',
            'channel_id' => '4',
        ];

        Discussion::create($discussion_1);
        Discussion::create($discussion_2);
        Discussion::create($discussion_3);
        Discussion::create($discussion_4);
    }
}
