<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

return [
    'title' => 'Site',

    // 訪問權限判斷
    'permission' => function () {
        // 只允許站長管理站点配置
        return Auth::user()->hasRolen('Founder');
    },

    // 站点配置的表单
    'edit_fields' => [
        'site_name' => [
            // 表单标题
            'title' => 'Site Name',

            // 表单条目类型
            'type' => 'text',

            // 字数限制
            'limit' => 50,
        ],
        'contact_email' => [
            'title' => '联系人邮箱',
            'type' => 'text',
            'limit' => 50,
        ],
        'seo_description' => [
            'title' => 'SEO - Description',
            'type' => 'textarea',
            'limit' => 250,
        ],
        'seo_keywords' => [
            'title' => 'SEO - Keywords',
            'type' => 'textarea',
            'limit' => 250,
        ],
    ],

    // 表单验证规则
    'rules' => [
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
    ],

    'messages' => [
        'site_name.required' => '请填写站点名称。',
        'contact_email' => '请填写正确的联系人邮箱格式',
    ],

    // 数据即将保存时触发的钩子 可以对用户提交的数据做修改
    'before_save' => function (&$data) {
        // 为网站名称加上后缀 加上判断是为了防止多次添加
        if (strpos($data['site_name'], 'Powered by hana') === false) {
            $data['site_name'] .= ' - Powered by hana';
        }
    },

    // 你可以自定义多个动作 每一个动作为设置页面底部的【其他操作】区块
    'actions' => [

        // 清空缓存
        'clear_cache' => [
            'title' => '更新缓存系统',

            //不同状态时的页面的提醒
            'messages' => [
                'active' => '正在清空缓存...',
                'success' => '缓存已清空！',
                'error' => '清空缓存时出错！',
            ],

            // 动作执行代码， 注意你可以通过修改 $data 参数更改配置信息
            'action' => function (&$data) {
                Artisan::call('cache:clear');
                return true;
            }
        ],
    ],
];
