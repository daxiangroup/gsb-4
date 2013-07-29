<?php namespace GSB\Group;

use \DB;
use \Base\Exception\RTException;
use GSB\Groups\GroupsBuddyEntity;

class GroupRepository
{
    public static function getGroups(GroupFilter $filter = null)
    {
        $query = DB::table('groups');

        if (!is_null($filter->getId())) {
            $data = $query->find($filter->get_id());

            return (count($data) ? array((object) $data) : false);
        }

        if (!is_null($filter->getName())) {
            $query->where('name', 'LIKE', '%'.$filter->getName().'%');
        }

        if (!is_null($filter->getGraduatingYear())) {
            $query->where('graduating_year', '=', $filter->getGraduatingYear());
        }

        if (!is_null($filter->getMaxSize())) {
            $query->where('max_size', '=', $filter->getMaxSize());
        }

        $data = $query->get();

        if (count($data)) {
            return (array) $data;
        }

        return false;
    }

    public static function getGroup($id)
    {
        $data = DB::connection('app_r')
            ->table('groups')
            ->leftJoin('profiles AS p1', 'groups.admin_id', '=', 'p1.id')
            ->leftJoin('profiles AS p2', 'groups.co_admin_id', '=', 'p2.id')
            ->where('groups.id', '=', $id)
            ->get(array(
                'groups.*',
                'p1.full_name',
                'p2.full_name AS co_full_name',
            ));

        return (array) $data[0];
    }

    public static function getMyGroups($profile_id)
    {
        $data = DB::connection('app_r')
            ->table('groups')
            ->join('groups_buddies', 'groups.id', '=', 'groups_buddies.group_id')
            ->where('groups_buddies.profile_id', '=', $profile_id)
            ->get(array('groups.*'));

        return (array) $data;
    }

    public static function getGroupMeetings($id)
    {
        $data = DB::connection('app_r')
            ->table('groups_meetings')
            ->where('group_id', '=', $id)
            ->get();

        return (array) $data;
    }

    public static function getGroupBuddies($id)
    {
        $data = DB::connection('app_r')
            ->table('groups_buddies')
            ->where('group_id', '=', $id)
            ->get();

        return (array) $data;
    }

    public static function saveBuddy(GroupBuddyEntity $buddy)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('groups_buddies')
                ->insert($buddy->fieldsAsArray());
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem');
        }

        return false;
    }

    public static function deleteBuddy(GroupBuddyEntity $buddy)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('groups_buddies')
                ->where('group_id', '=', $buddy->getGroupId())
                ->where('profile_id', '=', $buddy->getProfileId())
                ->delete();
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem');
        }

        return false;
    }

    public static function saveGroup(GroupEntity $group)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('groups')
                ->insert($group->fieldsAsArray(true));
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem');
        }
    }

    /*
    public static function save(ProfileEntity $profile)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('profiles')
                ->where('id', '=', $profile->getId())
                ->update($profile->fields_as_array());
            return true;
        } catch (\Exception $e) {
            RTException::database('Database problem');
        }

        return false;
    }

    */
}
