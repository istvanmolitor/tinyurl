<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTinyurlRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('tinyurl')?->id;

        return [
            'url'      => 'required|string|url|max:2048',
            'slug'     => "required|string|max:255|unique:tinyurls,slug,{$id}|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'redirect' => 'nullable|string|url|max:2048',
        ];
    }
}
