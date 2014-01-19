<?php namespace GSB\Group;

use \DB;
use \GSB\Groups\GroupsBuddyEntity;
use \GSB\Base\GSBException;

class GroupEloquentRepository implements GroupRepository
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
        try {
            $data = DB::connection('app_r')
                ->table('groups')
                ->leftJoin('profiles AS p1', 'groups.admin_id', '=', 'p1.id')
                ->leftJoin('profiles AS p2', 'groups.co_admin_id', '=', 'p2.id')
                ->where('groups.id', '=', $id)
                ->get(
                    array(
                        'groups.*',
                        'p1.full_name',
                        'p2.full_name AS co_full_name',
                    )
            );
        } catch (\Exception $e) {
            GSBException::database('Database problem');
            return false;
        }

        // TODO: Proper logging of unfound group id
        if (!count($data)) {
            return false;
        }

        return (array)$data[0];
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

    public static function getGroupMeeting($id)
    {
        $data = DB::connection('app_r')
            ->table('groups_meetings')
            ->where('id', '=', $id)
            // TODO: put in proper ordering of meetings
            //->order('day', 'start_time')
            ->get();

        return (array) $data[0];
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
        // Set a local array of the GroupBuddy fields to save in both insert and
        // update.
        $fields = $buddy->fieldsAsArray(
            true,
            false
        );

        // If the $buddy's id is null, it means we're saving a new buddy and need
        // to do an insert.
        if (is_null($buddy->getId())) {
            try {
                $id = DB::connection('app_w')
                    ->table('groups_buddies')
                    ->insertGetId($fields);
                return $id;
            } catch (\Exception $e) {
                GSBException::database('Database problem 1');
                return false;
            }
        }

        // If we made it down here, there is an id in the $buddy and we are editing
        // an existing buddy, so we need to do an update.
        try {
            // We need to unset the Buddy's id field because we're doing an update.
            // The id field is only required for inserting a new record.
            unset($fields[GroupBuddyEntity::FLD_ID]);

            $affected = DB::connection('app_w')
                ->table('groups')
                ->where('id', $buddy->getId())
                ->update($fields);
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem 2');
            return false;
        }
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

    /**
     * Inserting/Updating a group's admin information
     *
     * @param $group - GroupEntity - The group information that needs to be saved
     * @return boolean
     */
    public static function saveGroup(GroupEntity $group)
    {
        // Set a local array of the Group fields to save in both insert and updated.
        // We need to ignore the Buddies and Meetings fields however, they are
        // stored in separate tables.
        $fields = $group->fieldsAsArray(
            true,
            false,
            array(
                GroupEntity::FLD_BUDDIES,
                GroupEntity::FLD_MEETINGS,
            )
        );

        // If the $group's id is null, it means we're saving a new group and need
        // to do an insert.
        if (is_null($group->getId())) {
            try {
                $id = DB::connection('app_w')
                    ->table('groups')
                    ->insertGetId($fields);
                return $id;
            } catch (\Exception $e) {
                GSBException::database('Database problem 1');
                return false;
            }
        }

        // If we made it down here, thre is an id in the $group and we are editing
        // an existing group, so we need to do an update.
        try {
            // We need to unset the Group's id field because we're doing an update.
            // The id field is only required for inserting a new record.
            unset($fields[GroupEntity::FLD_ID]);

            $affected = DB::connection('app_w')
                ->table('groups')
                ->where('id', $group->getId())
                ->update($fields);
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem 2');
            return false;
        }
    }
}
