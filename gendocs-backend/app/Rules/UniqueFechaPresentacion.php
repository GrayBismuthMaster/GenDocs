<?php
namespace App\Rules;

use App\Models\ActaGrado;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class UniqueFechaPresentacion implements Rule
{
    private $actaGradoId;
    private $duracion;
    private $fecha_presentacion;

    public function __construct($actaGradoId, $duracion, $fecha_presentacion)
    {
        $this->actaGradoId = $actaGradoId;
        $this->duracion = $duracion;
        $this->fecha_presentacion = $fecha_presentacion;
    }

    public function passes($attribute, $value)
    {
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $endDateTime = $startDateTime->copy()->addMinutes($this->duracion);

        $startDateTimeFormatted = $startDateTime->format('Y-m-d H:i:s');
        $endDateTimeFormatted = $endDateTime->format('Y-m-d H:i:s');
        
        
      
            $query = ActaGrado::where('id', '<>',$this->actaGradoId)
            ->where(function ($query) use ($startDateTimeFormatted, $endDateTimeFormatted) {
                $query->where('fecha_presentacion', '>=', $startDateTimeFormatted)
                    ->where('fecha_presentacion', '<', $endDateTimeFormatted);
            });

        $overlappingRecords = $query->get();
        
        dd($startDateTimeFormatted, $endDateTimeFormatted, $overlappingRecords, $this->actaGradoId);

    }

    public function message()
    {
        return 'La fecha y hora de presentación ya está dada para otro alumno.';
    }
}
