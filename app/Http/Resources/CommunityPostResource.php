<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommunityPostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'username' => $this->user->username,
            'slug' => $this->slug,
            'votes' => $this->votes,
            'postVotes' => $this->whenLoaded('postVotes'),
            'comments_count' => $this->comments_count,
            'community_slug' => $this->community->slug
        ];
    }
}
