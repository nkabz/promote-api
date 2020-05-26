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
            'userId' => $this->user->id,
            'login' => $this->user->email,
            'userIsSubscriber' => (bool) $this->user->subscriber,
            'isHighlighted' => $this->is_highlighted,
            'createdAt' => $this->created_at,
            'content' => $this->content,
        ];
    }
}
