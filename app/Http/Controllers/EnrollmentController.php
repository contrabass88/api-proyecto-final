<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // GET /api/enrollments
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->get();

        return response()->json($enrollments);
    }

    // POST /api/enrollments
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'enrolled_at' => 'nullable|date',
        ]);

        $enrollment = Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'enrolled_at' => $request->enrolled_at ?? now(),
        ]);

        return response()->json([
            'message' => 'Matrícula registrada correctamente.',
            'data' => $enrollment
        ]);
    }

    // PUT /api/enrollments/{id}
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $enrollment->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'enrolled_at' => $request->enrolled_at,
        ]);

        return response()->json([
            'message' => 'Matrícula actualizada correctamente.',
            'data' => $enrollment
        ]);
    }

    // DELETE /api/enrollments/{id}
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return response()->json([
            'message' => 'Matrícula eliminada correctamente.'
        ]);
    }
}
