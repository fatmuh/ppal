<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'urls'          => [
                'detail_url' => route('user.detail', $this->id),
                'update_url' => route('user.update', $this->id),
                'delete_url' => route('user.delete', $this->id),
            ]
        ];
    }
}
