<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'nombre' => $this->nombre,
            'materia' => $this->materia,
            'direccion' => $this->direccion,
            'expandido' => false,
            'archivos' => FileResource::collection($this->files),
            'ruta' => url('/')."/".$this->direccion
        ];
    }
}
