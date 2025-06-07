<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // GET /api/get-courses
    public function index()
    {
        $courses = Course::with(['category', 'creator'])->get();

        $formatted = $courses->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'category' => $course->category->name ?? null,
                'created_by' => $course->creator->name ?? null,
                'created_at' => $course->created_at->format('d-m-Y H:i:s'),
            ];
        });

        return response()->json($formatted);
    }

    // POST /api/create-course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'created_by' => 'required|exists:users,id',
        ]);

        $course = Course::create($request->all());

        return response()->json([
            'message' => 'Curso creado correctamente.',
            'data' => $course
        ]);
    }

    // PUT /api/update-course/{id}
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'created_by' => 'sometimes|required|exists:users,id',
        ]);

        $course->update($request->all());

        return response()->json([
            'message' => 'Curso actualizado correctamente.',
            'data' => $course
        ]);
    }

    // DELETE /api/delete-course/{id}
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json([
            'message' => 'Curso eliminado correctamente.'
        ]);
    }
}
