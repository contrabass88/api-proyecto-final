<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'enrolled_at' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Debes indicar el usuario que se inscribe.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'course_id.required' => 'Debes indicar el curso al que se inscribe.',
            'course_id.exists' => 'El curso seleccionado no existe.',
            'enrolled_at.date' => 'La fecha de inscripción no es válida.',
        ];
    }
}
