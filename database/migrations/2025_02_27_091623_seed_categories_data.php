<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $categories = [
            [
                'name' => '分享',
                'description' => '分享发现',
            ],
            [
                'name' => '教程',
                'description' => '开发技巧',
            ],
            [
                'name' => '问答',
                'description' => '请保持友善,互帮互助',
            ],
            [
                'name' => '公告',
                'description' => '站点公告',
            ],
        ];

        \Illuminate\Support\Facades\DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::table('categories')->truncate();
    }
};
