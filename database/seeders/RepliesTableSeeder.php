<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reply;

class RepliesTableSeeder extends Seeder
{

    // 跳过模型事件, 避免填充数据时触发事件执行时间太久
    // 我们在 ReplyObserver 中监听了 created 事件, 用来更新话题回复数和通知话题作者, 我们在填充数据时不需要这个事件
    // 我们还在 ReplyObserver 中监听了 creating 事件, 用来过滤用户输入的内容, 我们在填充数据时也不需要这个事件
    use WithoutModelEvents;

    public function run(): void
    {
        Reply::factory()->count(1000)->create();
    }
}
