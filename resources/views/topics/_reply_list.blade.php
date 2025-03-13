<ul class="list-unstyled">
    @foreach ($replies as $index => $reply)
        <li class="d-flex" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="media-left">
                <a href="{{ route('users.show', [$reply->user_id]) }}">
                    <img class="media-object img-thumbnail mr-3" alt="{{ $reply->user->name }}"
                         src="{{ $reply->user->avatar }}" style="width:48px;height:48px;"/>
                </a>
            </div>

            <div class="flex-grow-1 ms-2">
                <div class="media-heading mt-0 mb-1 text-secondary">
                    <a class="text-decoration-none" href="{{ route('users.show', [$reply->user_id]) }}"
                       title="{{ $reply->user->name }}">
                        {{ $reply->user->name }}
                    </a>
                    <span class="text-secondary"> • </span>
                    <span class="meta text-secondary"
                          title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

                    {{-- 回复按钮 --}}
                    <button class="btn btn-sm btn-link text-secondary" data-bs-toggle="collapse"
                            data-bs-target="#replyForm{{ $reply->id }}">
                        <i class="fa-regular fa-comment"></i> Reply
                    </button>

                    {{-- 显示子评论数量，点击展开 --}}
                    <span class="meta float-end">
                        <button class="btn btn-sm text-secondary" data-bs-toggle="collapse"
                                data-bs-target="#nestedReplies{{ $reply->id }}">
                            <i class="fa-solid fa-comments"></i> 3 replies
                        </button>
                    </span>

                    {{-- 删除按钮 --}}
                    @can('destroy', $reply)
                        <span class="meta float-end">
                            <form action="{{ route('replies.destroy', $reply->id) }}" method="post"
                                  onsubmit="return confirm('Are you sure you want to delete this reply?')">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default btn-xs pull-left text-secondary">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </span>
                    @endcan
                </div>

                {{-- 显示回复内容 --}}
                <div class="reply-content text-secondary">
                    {!! $reply->message !!}
                    @if($reply->children->count() > 0)
                    @php
                        $firstChild = $reply->children->first();
                    @endphp
                    <div class="mt-2 border-start ps-3 text-muted">
                        <p><strong>{{ $firstChild->user->name }}</strong> - {{ $firstChild->created_at->diffForHumans() }}</p>
                        <p>{!! $firstChild->message !!}</p>
                    </div>
                    @endif
                </div>


                {{-- 回复输入框，默认折叠 --}}
                <div class="collapse mt-2" id="replyForm{{ $reply->id }}">
                    <form action="{{ route('replies.storeReply', $reply->id) }}" method="POST">
                        @csrf
                        <textarea class="form-control" name="message" rows="2" placeholder="Reply to this comment..."></textarea>
                        <button type="submit" class="btn btn-sm btn-secondary mt-2">Submit</button>
                    </form>
                </div>

                {{-- 子评论 Mock 数据展示 --}}
                <div class="collapse mt-3 ms-4 border-start ps-3" id="nestedReplies{{ $reply->id }}">
                    @if ($reply->children->count() > 0)
                        @foreach ($reply->children as $childReply)
                            <div class="mb-2">
                                <p><strong>{{ $childReply->user->name }}</strong> - {{ $childReply->created_at->diffForHumans() }}</p>
                                <p>{!! $childReply->message !!}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No replies yet.</p>
                    @endif
{{--                    <div class="mb-2">--}}
{{--                        <p><strong>MockUser2</strong> - 10 minutes ago</p>--}}
{{--                        <p>Another mock reply to demonstrate nesting.</p>--}}
{{--                    </div>--}}
{{--                    <div class="mb-2">--}}
{{--                        <p><strong>MockUser2</strong> - 10 minutes ago</p>--}}
{{--                        <p>Another mock reply to demonstrate nesting.</p>--}}
{{--                    </div>--}}
{{--                    <div class="mb-2">--}}
{{--                        <p><strong>MockUser3</strong> - 15 minutes ago</p>--}}
{{--                        <p>Yet another mock reply.</p>--}}
{{--                    </div>--}}

                    {{-- “加载更多” 功能，后续替换为后端 AJAX 加载 --}}
                    <button class="btn btn-sm btn-outline-secondary" onclick="showMoreReplies({{ $reply->id }})">
                        Load more
                    </button>
                </div>
            </div>
        </li>

        @if (!$loop->last)
            <hr>
        @endif
    @endforeach
</ul>

<script>
    function showMoreReplies(replyId) {
        // TODO: 替换成后端 AJAX 加载更多子评论的逻辑
        alert('Showing more replies for reply ID: ' + replyId);
    }
</script>
