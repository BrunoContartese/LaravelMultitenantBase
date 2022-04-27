<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DefaultQueryParamsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'searchQuery' => 'nullable|string|max:255',
            'paginated' => 'nullable|boolean',
            'perPage' => 'required_with:paginated|integer|min:1|max:100',
            'trashed' => 'nullable|in:*,2',
            'orderBy' => 'nullable|string',
            'orderDirection' => 'required_with:orderBy|in:asc,desc',
            'page' => 'required_with:paginated|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'searchQuery.max' => 'The :attribute may not be greater than :max.',
            'searchQuery.string' => 'The :attribute must be a string.',
            'paginated.boolean' => 'The :attribute must be a boolean.',
            'perPage.min' => 'The :attribute must be at least :min.',
            'perPage.max' => 'The :attribute may not be greater than :max.',
            'perPage.required_with' => 'The :attribute field is required when :other is present.',
            'perPage.integer' => 'The :attribute must be an integer.',
            'trashed.in' => 'The :attribute must be one of the following: :values.',
            'orderBy.string' => 'The :attribute must be a string.',
            'orderDirection.required_with' => 'The :attribute field is required when :other is present.',
            'orderDirection.in' => 'The :attribute must be one of the following: :values.',
            'page.required_with' => 'The :attribute field is required when :other is present.',
            'page.integer' => 'The :attribute must be an integer.',
            'page.min' => 'The :attribute must be at least :min.',
        ];
    }
}
