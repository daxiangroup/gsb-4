<?php namespace GSB\Group;

use \GSB\Groups\ProfileRepository;

use \GSB\Base\Entity;
use \DB;

class GroupBuddyEntity extends Entity
{
    protected $id = null;
    protected $group_id = null;
    protected $profile_id = null;
    protected $status = null;

    private $fields = array();

    const FLD_ID = 'id';
    const FLD_GROUP_ID = 'group_id';
    const FLD_PROFILE_ID = 'profile_id';
    const FLD_STATUS = 'status';

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    public function __construct($id = null, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID,
            self::FLD_GROUP_ID,
            self::FLD_PROFILE_ID,
            self::FLD_STATUS,
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

        $group_buddies = $GroupRepository::getGroupBuddies($this->id);

        $this->setGroupId($group_buddies['group_id']);
        $this->setProfileId($group_buddies['profile_id']);
        $this->setStatus($group_buddies['status']);
        $this->setCreated($group_buddies['created']);
        $this->setUpdated($group_buddies['updated']);
    }

    public function fieldsAsArray($include_id = false, $include_null = false)
    {
        if ($include_id) {
            $output[self::FLD_ID] = $this->getId();
        }

        $output[self::FLD_GROUP_ID] = $this->getGroupId();
        if (!$include_null && is_null($output[self::FLD_GROUP_ID])) {
            unset($output[self::FLD_GROUP_ID]);
        }

        $output[self::FLD_PROFILE_ID] = $this->getProfileId();
        if (!$include_null && is_null($output[self::FLD_PROFILE_ID])) {
            unset($output[self::FLD_PROFILE_ID]);
        }

        $output[self::FLD_STATUS] = $this->getStatus();
        if (!$include_null && is_null($output[self::FLD_STATUS])) {
            unset($output[self::FLD_STATUS]);
        }

        if (is_null($this->getId())) {
            $output[self::FLD_CREATED] = DB::raw('NOW()');
        }

        return $output;
    }

}
