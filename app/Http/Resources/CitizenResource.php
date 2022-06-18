<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CompanyResource;

class CitizenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'passport' => $this->passport,
            'birth_date' => $this->birth_date,
            'companies' => CompanyResource::collection($this->citizen_companies),
        ];
    }
}
