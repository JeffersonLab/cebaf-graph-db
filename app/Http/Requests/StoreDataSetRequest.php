<?php

namespace App\Http\Requests;

use App\Models\DataSet;
use Illuminate\Foundation\Http\FormRequest;

class StoreDataSetRequest extends FormRequest
{
    /**
     * The route that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'data-sets.create';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {

        return DataSet::$rules;
    }
}
