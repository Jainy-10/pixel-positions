<?php

namespace App\Http\Requests;

use App\Rules\ValidJobTitle;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create-job');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', new ValidJobTitle()],
            'salary' => ['required', 'min:3'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'description' => ['required'],
            'responsibilities' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'tags' => ['nullable']
        ];
    }

    public function  messages()
    {
        return [
            'title.required' => 'Please enter a Job Title',
            'title.min' => 'Job Title must me of at least 3 characters'
        ];
    }
}
