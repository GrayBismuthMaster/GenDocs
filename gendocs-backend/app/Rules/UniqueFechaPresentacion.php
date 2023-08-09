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
        //GETTING FECHA_PRESENTACION, ADDING DURATION VALUE
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $value);
          $startDateTimeFormatted = $startDateTime->format('Y-m-d H:i:s');
       
          $query = ActaGrado::where('id', '<>', 168)
            ->where(function ($query) use ($startDateTimeFormatted) {
                $query->whereRaw("'$startDateTimeFormatted' BETWEEN fecha_presentacion AND DATE_ADD(fecha_presentacion, INTERVAL duracion MINUTE)");
            });
        
        $result = $query->get();

        $overlappingRecords = $query->get();
        
        //dd($startDateTimeFormatted,  $overlappingRecords, $this->actaGradoId);
            return !$query->exists();
    }

    public function message()
    {
        return 'La fecha y hora de presentación ya está dada para otro alumno.';
    }
}
