<?php

namespace Yeelight\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductModelCreateRequest.
 *
 * @category Yeelight
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ProductModelCreateRequest extends FormRequest
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
            'title'      => 'required',
            'model_name' => 'required|max:150',
            'code'       => 'required|max:50',
        ];
    }
}
