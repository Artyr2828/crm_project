<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
          'name'    => ['required', 'string', 'max:255', 'min:3'],
          'email'   => ['required', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
          'phone'   => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
          'subject' => ['required', 'string', 'max:255'],
          'message' => ['required', 'string'],
          'file'    => ['nullable', 'file', 'max:10240'],
        ];
    }
}
