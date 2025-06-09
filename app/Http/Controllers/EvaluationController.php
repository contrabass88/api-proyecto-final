<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        return response()->json(Evaluation::with('enrollment')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'score' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
            'evaluated_at' => 'nullable|date'
        ]);

        $evaluation = Evaluation::create($validated);

        return response()->json([
            'message' => 'Evaluación registrada correctamente.',
            'data' => $evaluation
        ]);
    }

    public function update(Request $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);

        $validated = $request->validate([
            'score' => 'sometimes|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
            'evaluated_at' => 'nullable|date'
        ]);

        $evaluation->update($validated);

        return response()->json([
            'message' => 'Evaluación actualizada correctamente.',
            'data' => $evaluation
        ]);
    }

    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return response()->json(['message' => 'Evaluación eliminada correctamente.']);
    }
}
