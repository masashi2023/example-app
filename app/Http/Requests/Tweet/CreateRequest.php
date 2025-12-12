<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'tweet' => 'required|max:140',
            // 配列自体に対してのバリデーション
            'images' => 'array|max:4',
            // 配列の中身に対してのバリデーション
            'images.*' => 'required|image|mimes:png,jpg,gif,jpeg|max:2048'
        ];
    }
    // つぶやきを取得
    public function tweet(): string
    {
        return $this->input('tweet');
    }
    // ログインしているユーザーのIDを取得
    public function userId(): int
    {
        return $this->user()->id;
    }

    // ファイルデータの取得
    public function images(): array
    {
        return $this->file('images',[]);
    }
}
