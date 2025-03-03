<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|min:2',
                    'body' => 'required|min:3',
                    'category_id' => 'required|numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages(): array
    {
        // Custom error messages
        // 这里我们可以自定义验证错误消息, 但是因为我们目前使用的是英文, 所以我们可以使用 Laravel 的默认错误消息
        // 如果你想要自定义错误消息, 可以按照如下格式进行定义, example: 'title.min' => 'タイトルは2文字以上で入力してください'
        return [
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least 2 characters.',
            // 'title.min' => 'タイトルは2文字以上で入力してください'
        ];
    }
}
