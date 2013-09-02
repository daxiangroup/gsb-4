<?php namespace GSB\Base;

/**
 * Base Filter for all other system filters
 *
 * @author Tyler Schwartz <ts@daxiangroup.com>
 */

class Filter
{

    protected function processInput($filter)
    {
        foreach ($this->fields as $field) {
            if (false === isset($filter[$field])) {
                continue;
            }

            if ('' !== $filter[$field]) {
                $this->$field = $filter[$field];
            }
        }
    }
}
