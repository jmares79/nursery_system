<?php

namespace App\Domains\Guardians\Controllers;

use App\Domains\Children\Models\Child;
use App\Domains\Guardians\Models\Guardian;
use App\Domains\Guardians\Requests\ChildGuardianStoreRequest;
use App\Domains\Guardians\Resources\GuardianResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ChildGuardianController extends Controller
{
    public function index(Child $child): JsonResponse
    {
        return response()->json([
            'data' => GuardianResource::collection($child->guardians()->with('address')->get())
        ]);
    }

    public function store(ChildGuardianStoreRequest $request, Child $child): JsonResponse
    {
        $child->guardians()->syncWithoutDetaching([
            $request->input('guardian_id') => [
                'relationship' => $request->input('relationship'),
                'is_authorised_pickup' => $request->input('is_authorised_pickup') ?? true
            ]
        ]);

        return response()->json([
            'message' => 'Guardian linked successfully'
        ]);
    }

    public function destroy(Child $child, Guardian $guardian): JsonResponse
    {
        $child->guardians()->detach($guardian->id);

        return response()->json([
            'message' => 'Guardian removed'
        ]);
    }
}
