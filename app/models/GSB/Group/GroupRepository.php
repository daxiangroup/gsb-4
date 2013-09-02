<?php namespace GSB\Group;

interface GroupRepository
{
    public static function getGroups(GroupFilter $filter = null);

    public static function getGroup($id);

    public static function getMyGroups($profile_id);

    public static function getGroupMeetings($id);

    public static function getGroupMeeting($id);

    public static function getGroupBuddies($id);

    public static function saveBuddy(GroupBuddyEntity $buddy);

    public static function deleteBuddy(GroupBuddyEntity $buddy);

    /**
     * Inserting/Updating a group's admin information
     *
     * @param $group - GroupEntity - The group information that needs to be saved
     * @return boolean
     */
    public static function saveGroup(GroupEntity $group);
}
