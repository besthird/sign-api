<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class MeetingCreateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'sign_type' => 'in:1,2,3',
            'user_limit' => 'required',
            'status' => 'in:0,1',
            'sign_in_btime' => 'required',
            'sign_in_etime' => 'required',
            'sign_out_btime' => 'required',
            'sign_out_etime' => 'required',
        ];
    }
}
