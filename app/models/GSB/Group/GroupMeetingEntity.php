<?php namespace GSB\Group;

use \App;
use \DB;
use \GSB\Base\Entity;

class GroupMeetingEntity extends Entity
{
    protected $id = null;
    protected $group_id = null;
    protected $day = null;
    protected $time_start = null;
    protected $time_end = null;

    protected $fields = array();

    const FLD_ID = 'id';
    const FLD_GROUP_ID = 'group_id';
    const FLD_DAY = 'day';
    const FLD_TIME_START = 'time_start';
    const FLD_TIME_END = 'time_end';
    const FLD_NOTES = 'notes';

    public function __construct($id = null, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID => 'getId',
            self::FLD_GROUP_ID => 'getGroupId',
            self::FLD_DAY => 'getDay',
            self::FLD_TIME_START => 'getTimeStart',
            self::FLD_TIME_END => 'getTimeEnd',
            self::FLD_NOTES => 'getNotes',
        );

        if ($hydrate === true) {
            $this->hydrate();
        }

        return $this;
    }

    public function getId()
    {
        return $this->{self::FLD_ID};
    }

    public function setId($id)
    {
        $this->{self::FLD_ID} = $id;
    }

    public function getGroupId()
    {
        return $this->{self::FLD_GROUP_ID};
    }

    public function setGroupId($group_id)
    {
        $this->{self::FLD_GROUP_ID} = $group_id;
    }

    public function getDay()
    {
        return $this->{self::FLD_DAY};
    }

    public function setDay($day)
    {
        $this->{self::FLD_DAY} = $day;
    }

    public function getTimeStart()
    {
        return $this->{self::FLD_TIME_START};
    }

    public function setTimeStart($time)
    {
        $this->{self::FLD_TIME_START} = $time;
    }

    public function getTimeEnd()
    {
        return $this->{self::FLD_TIME_END};
    }

    public function setTimeEnd($time)
    {
        $this->{self::FLD_TIME_END} = $time;
    }

    public function getNotes()
    {
        return $this->{self::FLD_NOTES};
    }

    public function setNotes($notes)
    {
        $this->{self::FLD_NOTES} = $notes;
    }

    public function hydrate()
    {
        $GroupRepository = App::make('GroupRepository');

        $meeting = $GroupRepository::getGroupMeeting($this->id);

        $this->setGroupId($meeting['group_id']);
        $this->setDay($meeting['day']);
        $this->setTimeStart($meeting['time_start']);
        $this->setTimeEnd($meeting['time_end']);
        $this->setNotes($meeting['notes']);
    }
}
