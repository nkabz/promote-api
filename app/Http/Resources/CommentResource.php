<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'login' => $this->user->email,
            'userIsSubscriber' => (Boolean) $this->user->subscriber,
            'isHighlighted' => $this->is_highlighted,
            'createdAt' => $this->created_at,
            'content' => $this->content,
        ];
    }
}
