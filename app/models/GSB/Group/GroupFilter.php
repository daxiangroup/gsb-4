<?php namespace GSB\Group;

use GSB\Base\Filter;
use GSB\Base\Exception\GSBException;

class GroupFilter extends Filter
{
    protected $group_filter_id = null;
    protected $group_filter_name = null;
    protected $group_filter_year = null;
    protected $group_filter_size = null;

    protected $fields = array();

    const INPUT_ID = 'group_filter_id';
    const INPUT_NAME = 'group_filter_name';
    const INPUT_GRADUATING_YEAR = 'group_filter_year';
    const INPUT_MAX_SIZE = 'group_filter_size';

    public function __construct($filter = null)
    {
        // Setup
        $this->fields = array(
            self::INPUT_ID,
            self::INPUT_NAME,
            self::INPUT_GRADUATING_YEAR,
            self::INPUT_MAX_SIZE,
        );

        // If we're passed a null $filter, just return it straight away, we're
        // not creating a GroupsFilter.
        if (is_null($filter)) {
            return $filter;
        }

        // If we're passed a $filter and it's not an array, throw an exception
        if (!is_null($filter) && !is_array($filter)) {
            GSBException::invalidArgument('$filter must be an array');
        }

        // Process the $filter to setup this object
        $this->processInput($filter);

        return $this;
    }

    public function getId()
    {
        $field = self::INPUT_ID;
        return $this->$field;
    }

    public function getName()
    {
        $field = self::INPUT_NAME;
        return $this->$field;
    }

    public function getGraduatingYear()
    {
        $field = self::INPUT_GRADUATING_YEAR;
        return $this->$field;
    }

    public function getMaxSize()
    {
        $field = self::INPUT_MAX_SIZE;
        return $this->$field;
    }
}
