<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // 生成10个用户
        User::factory()->count(10)->create();

        // 单独处理第一个用户数据，以供测试
        $user = User::find(1);
        $user->name = 'hana';
        $user->email = 'na3540563@gmail.com';
        $user->password = bcrypt('12345678');
        $user->avatar =config('app.url') . '/uploads/images/avatars/202502/26/1.jpg';
        $user->save();
    }
}
