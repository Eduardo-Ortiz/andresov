<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'extension' => $this->extension,
            'ruta' => $this->ruta,
            'descargas_unicas' => $this->uniqueDownloads(),
            'descargas_totales' => $this->totalDownloads(),
            'fecha' => $this->created_at->format('d/m/Y')
        ];
    }
}
