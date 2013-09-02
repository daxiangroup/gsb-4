<?php namespace GSB\Signup;

use \Auth;
use \GSB\Profile\ProfileEntity;
use \Validator;

class SignupService
{
    /**
     * Validates the signup that is being processed. This is an accessor function
     * that takes an $input and builds the rules. $input is a required and,
     * generally speaking, $input will usually be Input::all(), but not necessarily.
     *
     * @param  string   $input
     * @return object (\Validator)
     */
    public static function validate($input = null)
    {
        if (is_null($input)) {
            GSBException::invalidArgument('$input cannot be a null value');
        }

        if (!is_array($input)) {
            GSBException::invalidArgument('$input is expected to be an array, '.gettype($input).' supplied');
        }

        $rules = self::getRules();

        if (!is_array($rules)) {
            GSBException::invalidArgument('$rules is expected to be an array, '.gettype($input).' supplied');
        }

        $messages = self::getMessages();

        if (!is_array($messages)) {
            GSBException::invalidArgument('$messages is expected to be an array, '.gettype($messages).' supplied');
        }

        $validation = Validator::make($input, $rules, $messages);

        return $validation;
    }

    /**
     * Gets validation rules.
     *
     * @return  array
     */
    public static function getRules()
    {
        $rules = array(
            'signup.full_name' => 'required',
            'signup.email'     => 'required',
            'signup.password'  => 'required|min:8',
        );

        return $rules;
    }

    /**
     * Gets validation messages.
     *
     * @return  array
     */
    public static function getMessages()
    {
        // TODO: Create validation messages for Signup
        $messages = array();

        return $messages;
    }
}
