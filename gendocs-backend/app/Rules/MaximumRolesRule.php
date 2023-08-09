<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\MiembrosActaGrado;

class MaximumRolesRule implements Rule
{
    protected $actaGradoId;
    protected $maxCounts;

    public function __construct($actaGradoId, $maxCounts)
    {
        $this->actaGradoId = $actaGradoId;
        $this->maxCounts = $maxCounts;
    }

    public function passes($attribute, $value)
    {
        $existingRoles = MiembrosActaGrado::where('acta_grado_id', $this->actaGradoId)
            ->where('tipo', $value)
            ->count();

        return $existingRoles < $this->maxCounts[$value];
    }

    public function message()
    {
        return 'Número de roles inválido';
    }
}
