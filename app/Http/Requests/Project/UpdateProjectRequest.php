<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        
            'name' => 'required|max:50',
            'framework' => 'max:50',
            'start_date' => 'required|date_format:Y-m-d',
            'description' => 'required|max:10000',
            'type_id'=> 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'image' => 'nullable|image'
        ];
    }
    public function messages() {

        return [
            'name.required' => "Nome progetto necessario",
            'name.max' => "Il nome deve avere al massimo di 50 caratteri",
            'framework.max' => "Il nome del framework deve avere al massimo di 50 caratteri",
            'start_date.required' => "La data è necessaria",
            'start_date.date_format' => "La data deve avere questo formato: Y-m-d",
            'description.max' => "La descrizione deve essere lunga al massimo 65535 caratteri",
            'description.required' => "La descrizione del progetto è necessario"
        ];
    }
}
