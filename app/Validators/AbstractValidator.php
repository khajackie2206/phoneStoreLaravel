<?php


namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class AbstractValidator
{
    protected $_transformMessage = false;

    /**
     * @param array $params
     * @return array
     */
    abstract protected function rules($params = []);

    /**
     * @param array $input
     *
     * @param array $params
     *
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws ValidationException
     */
    public function validate(array $input, $params = [])
    {
        $validator = Validator::make($input, $this->rules($params), $this->transformMessage());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }

    /**
     * @return array
     */
    protected function messages()
    {
        return [];
    }

    private function transformMessage()
    {
        $messages = $this->messages();
        if (empty($messages)) {
            return [];
        }

        if (!$this->_transformMessage) {
            return $messages;
        }

        unset($messages['transform']);
        $result = [];

        foreach ($messages as $field => $rules) {
            foreach ($rules as $rule => $message) {
                $result[$field.'.'.$rule] = $message;
            }
        }

        return $result;
    }

    protected function transformParameters(array $parameters)
    {
        $result = [];
        foreach ($parameters as $parameter) {
            $segments = explode('=', $parameter);
            $key = array_shift($segments);
            $result[$key] = implode('=', $segments);
        }

        return $result;
    }
}