<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Class Reply
 * @package App\Models
 *
 * @property int id
 * @property string message
 * @property int topic_id
 * @property int user_id
 * @property Topic topic
 * @property User user
 */
class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['topic_id', 'user_id', 'message', 'parent_id'];

    /**
     * A reply belongs to a topic.
     *
     * @return BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
    // 获取子回复
    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id')->orderBy('created_at', 'desc');
    }

    // 获取父回复
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    /**
     * A reply belongs to a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope function to get the recent replies.
     *
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query): mixed
    {
        return $query->orderBy('created_at', 'desc');
    }


}
