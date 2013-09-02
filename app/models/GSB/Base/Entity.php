<?php namespace GSB\Base;

/**
 * Base Entity for all other system entities
 *
 * @author Tyler Schwartz <ts@daxiangroup.com>
 */
class Entity
{
    protected $created;
    protected $updated;

    protected $fields = array(
        parent::FLD_CREATED => 'getCreated',
        parent::FLD_UPDATED => 'getUpdated',
    );

    const FLD_CREATED = 'created';
    const FLD_UPDATED = 'updated';

    /**
     * Get the created datetime.
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->{self::FLD_CREATED};
    }

    /**
     * Set the created datetime. If the passed in value happens to be null, set
     * the datetime to now.
     *
     * @param $created - string - Dateime of the creation.
     * @return void
     */
    public function setCreated($created = null)
    {
        $this->{self::FLD_CREATED} = is_null($created) ? date('Y-m-d H:i:s') : $created;
    }

    /**
     * Get the updated datetime.
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->{self::FLD_UPDATED};
    }

    /**
     * Set the updated datetime.
     *
     * @param $updated - string - Datetime of the update.
     * @return void
     */
    public function setUpdated($updated)
    {
        $this->{self::FLD_UPDATED} = $updated;
    }

    /**
     * fieldsAsArray()
     * Loops through the identified fields of the class who has extended this
     * Entity. The point of this is to build an array which the DB interface can
     * use to do manipulate the data layer.
     *
     * @param $includeId - boolean - Decides if the Entities id field should be
     *      included in the returned array.
     * @param $includeNull - boolean - Decides if Entity fields which have a null
     *      value should be included in the returned array.
     * @return array
     */
    public function fieldsAsArray($includeId = false, $includeNull = false, $ignoreFields = array())
    {
        if ($includeId) {
            $output[static::FLD_ID] = $this->{$this->fields[static::FLD_ID]}();
        }

        $ignoreFields = array_merge(array(static::FLD_ID), $ignoreFields);

        // Looping through the field identified in the current Entity object.
        foreach ($this->fields as $field => $accessor) {
            // Ignore the FLD_ID field of the Entity, we've already processed it
            // at the top of the method.
            if (in_array($field, $ignoreFields)) {
                continue;
            }

            // 1. Assigne the value to the $output array
            // 2. If we're not including null values and the value of this field
            //    is null, unset it.
            $output[$field] = $this->{$accessor}();
            if (!$includeNull && is_null($output[$field])) {
                unset($output[$field]);
            }

        }

        return $output;
    }
}
