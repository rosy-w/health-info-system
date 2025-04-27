<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'address'    => $this->address,
            'dob'        => $this->dob ? $this->dob->toDateString() : null,
            // healthprograms
            'programs'   => HealthProgramResource::collection($this->whenLoaded('healthPrograms')),
            //enrollments 
            'enrollments' => EnrollmentResource::collection($this->whenLoaded('enrollments')),
        ];
    }
}
