<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureEmailsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request):(Response|RedirectResponse) $next
     * @param RedirectResponse|Response|mixed|never
     */
    public function handle(Request $request, Closure $next): mixed
    {
        //三个判断，来限制用户必须去验证邮箱
        //1 如果用户已经登录
        //2 并且还未认证 Email
        //3 并且访问的不是 Email 验证相关 URL 或退出的 URl
        if ($request->user() && !$request->user()->hasVerifiedEmail() && !$request->is('email/*', 'logout')) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : redirect()->route('verification.notice');
        }
        return $next($request);
    }
}

