<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    public function index()
    {
        return Inertia::render('Communities/Index', [
            'communities' => Community::paginate(5)->through(fn ($community) => [
                'id' => $community->id,
                'user_id' => $community->user_id,
                'owner' => auth()->id() === $community->user_id ? true : false,
                'name' => $community->name,
                'slug' => $community->slug
            ])
        ]);
    }

    public function create()
    {
        return Inertia::render('Communities/Create');
    }

    public function store(StoreCommunityRequest $request)
    {
        Community::create($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->route('communities.index')->with('message', 'Community created succesfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Community $community)
    {
        return Inertia::render('Communities/Edit', [
            'community' => $community
        ]);
    }

    public function update(UpdateCommunityRequest $request, Community $community)
    {
        // dd($community);
        $community->update($request->validated());

        return redirect()->route('communities.index')->with('message', 'Community updated succesfully!');
    }

    public function destroy(Community $community)
    {
        $community->delete();

        return redirect()->route('communities.index')->with('message', 'Community deleted succesfully!');
    }
}
