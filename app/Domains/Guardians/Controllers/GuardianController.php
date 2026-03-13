<?php

namespace App\Domains\Guardians\Controllers;

use App\Domains\Guardians\Models\Guardian;
use App\Domains\Guardians\Requests\StoreGuardianRequest;
use App\Domains\Guardians\Requests\UpdateGuardianRequest;
use App\Domains\Guardians\Resources\GuardianResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GuardianController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $guardians = Guardian::query()
            ->latest()
            ->search($request->input('search'))
            ->paginate(25);

        return GuardianResource::collection($guardians);
    }

    public function show(Guardian $guardian): JsonResponse
    {
        return response()->json([
            'data' => $guardian->load('children', 'address')
        ]);
    }

    public function store(StoreGuardianRequest $request): JsonResponse
    {
        $guardian = Guardian::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'address_id' => $request->address_id ?? null,
        ]);

        return response()->json([
            'data' => $guardian
        ], 201);
    }

    public function update(UpdateGuardianRequest $request, Guardian $guardian): JsonResponse
    {
        $guardian->update($request->validated());

        return response()->json([
            'data' => $guardian
        ]);
    }

    public function destroy(Guardian $guardian): JsonResponse
    {
        $guardian->delete();

        return response()->json([
            'message' => 'Guardian deleted'
        ]);
    }
}
