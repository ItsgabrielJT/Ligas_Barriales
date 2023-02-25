<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Estadistica_EquiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'total_disparos'=>'required',
            'asisitencias'=>'required',
            'faltas'=>'required',
            'tiros_esquina'=>'required',
            'pases'=>'required',
            'tiros_fallidos'=>'required',
            'torneo_id'=>'required'

        ];
    }
}
