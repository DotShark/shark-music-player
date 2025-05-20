<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrackRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'artist' => ['required', 'string', 'max:255'],
            'displayed' => ['required', 'boolean'],
            'file' => ['file', 'mimes:mp3,wav,ogg', 'max:20480'], // 20MB max
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // 2MB max
        ];
    }
}
