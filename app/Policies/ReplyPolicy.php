<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    /**
     * Determine whether the user can delete the reply
     * 我们规定只有话题的作者或者回复的作者才能删除评论
     * 话题的作者是 reply.topic.user_id
     * 回复的作者是 reply.user_id
     *
     * @param User $user
     * @param Reply $reply
     * @return bool
     */
    public function destroy(User $user, Reply $reply): bool
    {
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
