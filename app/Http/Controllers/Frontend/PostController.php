<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostShowResource;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($community_slug, $slug)
    {
        $community = Community::where('slug', $community_slug)->first();
        $community_post = Post::with(['user', 'comments', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('slug', $slug)->first();

        $post = new PostShowResource($community_post);
        $posts = PostResource::collection($community->posts()->orderBy('votes', 'desc')->take(6)->get());

        $can_update = auth()->user()->can('update', $community_post);
        $can_delete = auth()->user()->can('delete', $community_post);

        return Inertia::render('Frontend/Posts/Show', compact('community', 'post', 'posts', 'can_update', 'can_delete'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
