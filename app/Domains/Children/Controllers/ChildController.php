<?php

namespace App\Domains\Children\Controllers;

use App\Domains\Children\Models\Child;
use App\Domains\Children\Requests\StoreChildRequest;
use App\Domains\Children\Requests\UpdateChildRequest;
use App\Domains\Children\Resources\ChildResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ChildController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $children = Child::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('first_name', 'like', "%{$request->search}%")
                    ->orWhere('last_name', 'like', "%{$request->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return ChildResource::collection($children);
    }

    public function store(StoreChildRequest $request): ChildResource
    {
        $child = Child::create($request->validated());

        return new ChildResource($child);
    }

    public function show(Child $child): ChildResource
    {
        return new ChildResource($child);
    }

    public function update(UpdateChildRequest $request, Child $child): ChildResource
    {
        $child->update($request->all());
        return new ChildResource($child);
    }

    public function destroy(Child $child): Response
    {
        $child->delete();
        return response()->noContent();
    }
}
