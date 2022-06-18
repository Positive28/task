<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'company_name' => $this->company->company_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            // 'citizen_id' => $this->citizen_id,
            // 'company_id' => $this->company_id,
            
        ];
    }
}
