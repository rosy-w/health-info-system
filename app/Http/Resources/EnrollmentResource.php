<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
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
            'user_id' => auth()->id(),
            'client' => new ClientResource($this->whenLoaded('client')),
            'health_program_id' => new HealthProgramResource($this->whenLoaded('healthProgram')),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,

        ];
    }
}
