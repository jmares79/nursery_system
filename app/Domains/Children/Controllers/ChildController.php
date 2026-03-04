<?php

namespace App\Domains\Children\Controllers;

use App\Domains\Children\Models\Child;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        return Child::latest()->get();
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $child = Child::create($validated);

        return response()->json($child, 201);
    }

    public function show(Child $child)
    {
        return $child;
    }

    public function update(Request $request, Child $child)
    {
        $child->update($request->all());
        return $child;
    }

    public function destroy(Child $child): \Illuminate\Http\Response
    {
        $child->delete();
        return response()->noContent();
    }
}
