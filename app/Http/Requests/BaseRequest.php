<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BaseRequest extends FormRequest{
  /**
   * Show error request
   *
   * @param $listError
   * @return mixed
   */
  public function error($listError)
  {
    $errors = null;
    foreach ($listError as $key => $value) {
        $errors .= is_array($value) ? implode(',', $value) . "<br>": $value ;
    }
    throw new HttpResponseException(response()->json(['error' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
  }

  /**
  * Handle a failed validation attempt.
  *
  * @param Validator $validator
  * @return mixed
  */
  public function failedValidation(Validator $validator)
  {
  return $this->error([$validator->errors()->first()]);
  }
}
?>
