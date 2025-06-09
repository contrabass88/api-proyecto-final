<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'enrollment_id' => ['required', 'exists:enrollments,id'],
            'score' => ['required', 'numeric', 'between:0,100'],
            'feedback' => ['nullable', 'string'],
            'evaluated_at' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'enrollment_id.required' => 'Debes indicar la inscripción a evaluar.',
            'enrollment_id.exists' => 'La inscripción indicada no existe.',
            'score.required' => 'La nota es obligatoria.',
            'score.numeric' => 'La nota debe ser un número.',
            'score.between' => 'La nota debe estar entre 0 y 100.',
            'feedback.string' => 'El feedback debe ser un texto válido.',
            'evaluated_at.date' => 'La fecha de evaluación debe ser una fecha válida.',
        ];
    }
}
