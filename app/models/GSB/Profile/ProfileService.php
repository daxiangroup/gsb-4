<?php namespace GSB\Profile;

/*
use \App;
use \Auth;
use \GSB\Base\GSBException;
use \GSB\Group\GroupEntity;
use \GSB\Group\GroupFilter;
*/
use \Validator;

class ProfileService
{
    /**
     * Validates the form that is being processed. This is an accessor function
     * that takes a $form and an $input and builds the rules based on the $form
     * string that is passed in. Both $form and $input are required and, generally
     * speaking, $input will usually be Input::all(), but not necessarily.
     *
     * @param  string   $form
     * @param  string   $input
     * @return object (\Validator)
     */
    public static function validate($form = null, $input = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        if (is_null($input)) {
            GSBException::invalidArgument('$input cannot be a null value');
        }

        if (!is_array($input)) {
            GSBException::invalidArgument('$input is expected to be an array, '.gettype($input).' supplied');
        }

        $rules = self::getRules($form);

        if (!is_array($rules)) {
            GSBException::invalidArgument('$rules is expected to be an array, '.gettype($input).' supplied');
        }

        $messages = self::getMessages($form);

        if (!is_array($messages)) {
            GSBException::invalidArgument('$messages is expected to be an array, '.gettype($messages).' supplied');
        }

        $validation = Validator::make($input, $rules, $messages);

        return $validation;
    }

    /**
     * Gets validation rules based on the form being validated.
     *
     * @param   string    $form
     * @return  array
     */
    public static function getRules($form = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        $rules = array(
            'profile' => array(
                'profile.username' => 'required',
                'profile.email'    => 'required',
            ),
            'profile.password' => array(
                'password.current' => 'required',
                'password.new'     => 'required',
                //'password.verify'  => 'required|same:password[new]',
                'password.verify'  => 'required',
            ),
        );

        return $rules[$form];
    }

    /**
     * Gets validation messages based on the form being validated.
     *
     * @param   string    $form
     * @return  array
     */
    public static function getMessages($form = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        $messages = array(
            'profile' => array(
                '',
            ),
            'profile.password' => array(
            ),
        );

        return $messages[$form];
    }

    /*
    public static function formValues($form = null, $data = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        $values = array(
            'group-create' => array(
                'group_name' => $data['group']['name'],
                'group_graduating_year' => $data['group']['graduating_year'],
                /*
                'group_admin' => (is_null($data['group']->getId()) ? Auth::user()->full_name : $data['group']->getAdminName()),
                'group_admin_id' => (is_null($data['group']->getId()) ? Auth::user()->id : $data['group']->getAdminId()),
                'group_co_admin' => (is_null($data['group']->getId()) ? '' : $data['group']->getCoAdminName()),
                'group_co_admin_id' => (is_null($data['group']->getId()) ? '' : $data['group']->getCoAdminId()),
                */
        /*
                'group_admin' => $data['group']['admin_name'],
                'group_admin_id' => $data['group']['admin_id'],
                'group_co_admin' => $data['group']['co_admin_name'],
                'group_co_admin_id' => $data['group']['co_admin_id'],

                'group_max_size' => $data['group']['max_size'],
                'group_description' => $data['group']['description'],
                'group_headline' => $data['group']['headline'],
                'group_visibility' => array(
                    'open' => array(
                        'value' => GroupEntity::VAL_VISIBILITY_OPEN,
                        'checked' => ($data['group']['id'] == '' || $data['group']['visibility'] == GroupEntity::VAL_VISIBILITY_OPEN ? true : false),
                    ),
                    'closed' => array(
                        'value' => GroupEntity::VAL_VISIBILITY_CLOSED,
                        'checked' => ($data['group']['visibility'] == GroupEntity::VAL_VISIBILITY_CLOSED ? true : false),
                    ),
                    'private' => array(
                        'value' => GroupEntity::VAL_VISIBILITY_PRIVATE,
                        'checked' => ($data['group']['visibility'] == GroupEntity::VAL_VISIBILITY_PRIVATE ? true : false),
                    ),
                ),
                'group_buddies_approval' => array(
                    'value' => 1,
                    'checked' => ($data['group']['buddies_approval'] == GroupEntity::VAL_BUDDIES_APPROVAL_APPROVED ? true : false),
                ),
                'group_meetings' => $data['group']['meetings'],
            ),
        );

        return $values[$form];
    }
    */
}
