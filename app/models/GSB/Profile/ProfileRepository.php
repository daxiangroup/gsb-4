<?php namespace GSB\Profile;

interface ProfileRepository
{
    public static function save(ProfileEntity $profile);

    public static function getProfile($id);
}
