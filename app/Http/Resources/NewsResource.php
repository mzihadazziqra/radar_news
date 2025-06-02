<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->whenLoaded('content', function() {
                return $this->content;
            }),
            'image_url' => $this->image_path ? asset('storage/' .  $this->image_path) : null,
            'category' => $this->whenLoaded('category', function() {
                return $this->category->name ?? null;
            }),
            'author' => $this->whenLoaded('user', function() {
                return $this->user->name ?? null;
            }),
            'published_at' => $this->published_at ? $this->published_at->toIso8601String() : null,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
