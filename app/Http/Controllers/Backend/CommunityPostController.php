<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CommunityPostController extends Controller
{
    public function create(Community $community)
    {
        return Inertia::render('Communities/Posts/Create', [
            'community' => $community
        ]);
    }

    public function store(StorePostRequest $request, Community $community)
    {
        // return $request;
        $community->posts()->create($request->validated() + [
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->title)
        ]);

        return redirect()->route('frontend.communities.show', $community->slug);
    }

    public function edit(Community $community, Post $post)
    {
        return Inertia::render('Communities/Posts/Edit', compact('community', 'post'));
    }

    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('frontend.communities.show', $community->slug);
    }

    public function destroy(Community $community, Post $post)
    {
        $post->delete();

        return redirect()->route('frontend.communities.show', $community->slug);
    }
}
