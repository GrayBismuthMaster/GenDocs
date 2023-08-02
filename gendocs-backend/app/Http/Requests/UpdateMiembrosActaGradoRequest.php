<?php

namespace App\Http\Requests;

use App\Constants\TipoAsistenteActaGrado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\DisponibilidadAula;
use Carbon\Carbon;

class UpdateMiembrosActaGradoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "asistio" => ["boolean", "sometimes"],
            "tipo" => ["required", Rule::in([
                TipoAsistenteActaGrado::TUTOR,
                TipoAsistenteActaGrado::M_PRINCIPAL,
                TipoAsistenteActaGrado::M_SUPLENTE,
                TipoAsistenteActaGrado::PRESIDENTE,
            ]), "sometimes"],
            "informacion_adicional" => ["string", "sometimes", "nullable"],
            "fecha_asignacion" => ["date", "sometimes", "nullable"],         
            //DisponibilidadAula::onCreate($this->fecha_asignacion),
       
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            "fecha_asignacion" => $this->fecha_asignacion ? Carbon::parse($this->fecha_presentacion)->setSecond(0)->setMilli(0) : null,
        ]);
    }
}
