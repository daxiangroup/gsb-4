<?php namespace GSB\Profile;

use \DB;
use \GSB\Base\GSBException;

class ProfileEloquentRepository implements ProfileRepository
{
    public static function save(ProfileEntity $profile)
    {
        // Set a local array of the Profile fields to save in both insert and
        // update.
        $fields = $profile->fieldsAsArray(true, false);

        // If the $profile's id is null, it means we're saving a new profile
        // and need to do an insert.
        if (is_null($profile->getId())) {
            try {
                $id = DB::connection('app_w')
                    ->table('profiles')
                    ->insertGetId($fields);
                return $id;
            } catch (\Exception $e) {
                GSBException::database('Database problem 1');
                return false;
            }
        }

        // If we made it down here, there is an id in the $profile and we are
        // editing an existing profile, so we need to do an update.
        try {
            // We need to unset the Profile's id field because we're doing an
            // update. The id field is only required for inserting a new record.
            unset($fields[ProfileEntity::FLD_ID]);

            $affected = DB::connection('app_w')
                ->table('profiles')
                ->where('id', $profile->getId())
                ->update($fields);
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem 2');
            return false;
        }
    }

    public static function getProfile($id)
    {
        $data = DB::table('profiles')
            ->find($id);

        return (array) $data;
    }


}
