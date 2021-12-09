<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WolfResource extends JsonResource
{
    public static function collection($resource)
    {
        return parent::collection($resource);
    }
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
            'name' => $this->name,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'pack_id' => $this->pack_id,
            'pack' => PackResource::make($this->whenLoaded('pack'))
        ];
    }
}
