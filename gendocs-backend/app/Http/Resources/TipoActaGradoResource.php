<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TipoActaGradoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $include = $request->get('include');

        return array_merge(
            parent::toArray($request),
            array(
                'drive' => $this->archivo->google_drive_id,
                "estados" => $this->when(Str::contains($include, 'estados'), TipoEstadoActaGradoResource::collection($this->estados)),
                "carreras" => $this->when(Str::contains($include, 'carreras'), CarreraResource::collection($this->carreras)),
                'celdasNotas' => $this->when(Str::contains($include, 'celda-notas'), CeldasNotasTipoActaGradoResource::collection($this->celdasNotas)), 
            ),
        );
    }
}
