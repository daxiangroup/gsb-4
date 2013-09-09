<?php namespace GSB\Group;

use \DB;
use \GSB\Base\Entity;

class GroupBuddyEntity extends Entity
{
    protected $id = null;
    protected $group_id = null;
    protected $profile_id = null;
    protected $status = null;

    const FLD_ID = 'id';
    const FLD_GROUP_ID = 'group_id';
    const FLD_PROFILE_ID = 'profile_id';
    const FLD_STATUS = 'status';

    const VAL_STATUS_PENDING = 0;
    const VAL_STATUS_APPROVED = 1;

    public function __construct($id = null, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID => 'getId',
            self::FLD_GROUP_ID => 'getGroupId',
            self::FLD_PROFILE_ID => 'getProfileId',
            self::FLD_STATUS => 'getStatus',
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

    public function getProfileId()
    {
        return $this->{self::FLD_PROFILE_ID};
    }

    public function setProfileId($profile_id)
    {
        $this->{self::FLD_PROFILE_ID} = $profile_id;
    }

    public function getStatus()
    {
        return $this->{self::FLD_STATUS};
    }

    public function setStatus($status)
    {
        $this->{self::FLD_STATUS} = $status;
    }

    public function hydrate()
    {
        $GroupRepository = App::make('GroupRepository');

        $group_buddies = $GroupRepository::getGroupBuddies($this->{self::FLD_ID});

        $this->setGroupId($group_buddies[self::FLD_GROUP_ID]);
        $this->setProfileId($group_buddies[self::FLD_PROFILE_ID]);
        $this->setStatus($group_buddies[self::FLD_STATUS]);
        $this->setCreated($group_buddies['created']);
        $this->setUpdated($group_buddies['updated']);
    }
}
