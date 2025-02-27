<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     *  Unnecessary created_at and updated_at fields
     *
     *  在 Laravel 中，Eloquent 模型默认会去更新记录的 created_at 和 updated_at 字段，
     *  如果你不想让 Eloquent 自动管理这两个字段，你可以在模型中设置 $timestamps 属性为 false
     *
     * @var bool
     */
    public $fillable = ['name', 'description'];
}
