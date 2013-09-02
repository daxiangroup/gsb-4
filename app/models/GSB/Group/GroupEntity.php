<?php namespace GSB\Group;

use \GSB\Groups\ProfileRepository;
use \GSB\Base\Entity;
use \App;
use \Lang;

class GroupEntity extends Entity
{
    protected $id = null;
    protected $name = null;
    protected $graduating_year = null;
    protected $admin_id = null;
    protected $admin_name = null;
    protected $co_admin_id = null;
    protected $co_admin_name = null;
    protected $max_size = null;
    protected $headline = null;
    protected $description = null;
    protected $visibility = null;
    protected $buddies_approval = null;
    protected $meetings = null;
    protected $buddies = null;

    const FLD_ID = 'id';
    const FLD_NAME = 'name';
    const FLD_GRADUATING_YEAR = 'graduating_year';
    const FLD_ADMIN_ID = 'admin_id';
    const FLD_ADMIN_NAME = 'admin_name';
    const FLD_CO_ADMIN_ID = 'co_admin_id';
    const FLD_CO_ADMIN_NAME = 'co_admin_name';
    const FLD_MAX_SIZE = 'max_size';
    const FLD_HEADLINE = 'headline';
    const FLD_DESCRIPTION = 'description';
    const FLD_VISIBILITY = 'visibility';
    const FLD_BUDDIES_APPROVAL = 'buddies_approval';
    const FLD_MEETINGS = 'meetings';
    const FLD_BUDDIES = 'buddies';

    const VAL_VISIBILITY_OPEN = 0;
    const VAL_VISIBILITY_CLOSED = 1;
    const VAL_VISIBILITY_PRIVATE = 2;
    const VAL_BUDDIES_APPROVAL_UNAPPROVED = 0;
    const VAL_BUDDIES_APPROVAL_APPROVED = 1;

    public function __construct($id = null, $hydrate = false)
    {
        $this->id = $id;
        $this->fields += array(
            self::FLD_ID               => 'getId',
            self::FLD_NAME             => 'getName',
            self::FLD_GRADUATING_YEAR  => 'getGraduatingYear',
            self::FLD_ADMIN_ID         => 'getAdminId',
            self::FLD_ADMIN_NAME       => 'getAdminName',
            self::FLD_CO_ADMIN_ID      => 'getCoAdminId',
            self::FLD_CO_ADMIN_NAME    => 'getCoAdminName',
            self::FLD_MAX_SIZE         => 'getMaxSize',
            self::FLD_HEADLINE         => 'getHeadline',
            self::FLD_DESCRIPTION      => 'getDescription',
            self::FLD_VISIBILITY       => 'getVisibility',
            self::FLD_BUDDIES_APPROVAL => 'getBuddiesApproval',
            self::FLD_MEETINGS         => 'getMeetings',
            self::FLD_BUDDIES          => 'getBuddies',
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

    public function getName()
    {
        return $this->{self::FLD_NAME};
    }

    public function setName($name)
    {
        $this->{self::FLD_NAME} = $name;
    }

    public function getGraduatingYear()
    {
        return $this->{self::FLD_GRADUATING_YEAR};
    }

    public function setGraduatingYear($year)
    {
        $this->{self::FLD_GRADUATING_YEAR} = $year;
    }

    public function getAdminId()
    {
        return $this->{self::FLD_ADMIN_ID};
    }

    public function setAdminId($admin_id)
    {
        $this->{self::FLD_ADMIN_ID} = $admin_id;
    }

    public function getAdminName()
    {
        return $this->{self::FLD_ADMIN_NAME};
    }

    public function setAdminName($admin_name)
    {
        $this->{self::FLD_ADMIN_NAME} = $admin_name;
    }

    public function getCoAdminId()
    {
        return $this->{self::FLD_CO_ADMIN_ID};
    }

    public function setCoAdminId($co_admin_id)
    {
        $this->{self::FLD_CO_ADMIN_ID} = $co_admin_id;
    }

    public function getCoAdminName()
    {
        return $this->{self::FLD_CO_ADMIN_NAME};
    }

    public function setCoAdminName($co_admin_name)
    {
        $this->{self::FLD_CO_ADMIN_NAME} = $co_admin_name;
    }

    public function getMaxSize()
    {
        return $this->{self::FLD_MAX_SIZE};
    }

    public function setMaxSize($max_size)
    {
        $this->{self::FLD_MAX_SIZE} = $max_size;
    }

    public function getHeadline()
    {
        return $this->{self::FLD_HEADLINE};
    }

    public function setHeadline($headline)
    {
        $this->{self::FLD_HEADLINE} = $headline;
    }

    public function getDescription()
    {
        return $this->{self::FLD_DESCRIPTION};
    }

    public function setDescription($description)
    {
        $this->{self::FLD_DESCRIPTION} = $description;
    }

    public function getVisibility()
    {
        return $this->{self::FLD_VISIBILITY};
    }

    public function setVisibility($visibility)
    {
        $this->{self::FLD_VISIBILITY} = $visibility;
    }

    public function getBuddiesApproval()
    {
        return $this->{self::FLD_BUDDIES_APPROVAL};
    }

    public function setBuddiesApproval($approval)
    {
        $this->{self::FLD_BUDDIES_APPROVAL} = is_null($approval) ? 0 : $approval;
    }

    public function getMeetings()
    {
        return $this->{self::FLD_MEETINGS};
    }

    public function setMeetings($meetings)
    {
        foreach ($meetings as $meeting) {
            $this->{self::FLD_MEETINGS}[] = new GroupMeetingEntity($meeting->id, true);
        }
    }

    public function getBuddies()
    {
        return isset($this->{self::FLD_BUDDIES}) ? $this->{self::FLD_BUDDIES} : array();
    }

    public function setBuddies($buddies)
    {
        foreach ($buddies as $buddy) {
            $this->{self::FLD_BUDDIES}[$buddy->profile_id] = $buddy;
        }
    }

    public function getBuddyCount()
    {
        return count($this->{self::FLD_BUDDIES});
    }

    public function hasSpots()
    {
        return ($this->getMaxSize() - $this->getBuddyCount());
    }

    public function inGroup($profile_id = null)
    {
        if (!count($this->{self::FLD_BUDDIES})) {
            return false;
        }

        if (is_null($profile_id)) {
            return false;
        }

        return in_array((int) $profile_id, array_keys($this->{self::FLD_BUDDIES}));
    }

    public function isAdmin($profile_id = null)
    {
        if (is_null($profile_id)) {
            return false;
        }

        return $profile_id == $this->getAdminId() || $profile_id == $this->getCoAdminId();
    }

    public function visibilityName()
    {
        return Lang::get('Group/strings.labels.visibility-'.$this->getVisibility());
    }

    public function hydrate()
    {
        $GroupRepository = App::make('GroupRepository');

        $group           = $GroupRepository::getGroup($this->id);
        $group_meetings  = $GroupRepository::getGroupMeetings($this->id);
        $group_buddies   = $GroupRepository::getGroupBuddies($this->id);

        $this->setName($group['name'] != '' ? $group['name'] : '');
        $this->setGraduatingYear($group['graduating_year'] != '' ? $group['graduating_year'] : '');
        $this->setAdminId($group['admin_id']);
        $this->setAdminName($group['full_name']);
        $this->setCoAdminId($group['co_admin_id']);
        $this->setCoAdminName($group['co_full_name']);
        $this->setMaxSize($group['max_size']);
        $this->setHeadline($group['headline']);
        $this->setDescription($group['description']);
        $this->setVisibility($group['visibility']);
        $this->setBuddiesApproval($group['buddies_approval']);

        $this->setMeetings($group_meetings);

        $this->setBuddies($group_buddies);
    }
}
