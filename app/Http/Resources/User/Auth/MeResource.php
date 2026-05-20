<?php

namespace App\Http\Resources\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $data = $this->resource;

        return [
            'name' => $data->name,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'age' => $data->age,
            'gender' => $data->gender?->value,
            'birth_date' => $data->birth_date?->toDateString(),
            'email' => $data->email,
            'avatar' => $data->avatarImage ? [
                'url' => $data->avatarImage->url,
                'thumb' => $data->avatarImage->thumb,
            ] : null,
        ];
    }
}
