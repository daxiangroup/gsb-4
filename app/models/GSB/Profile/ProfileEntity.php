<?php namespace GSB\Profile;

use \App;
use \GSB\Profile\ProfileRepository;
use \GSB\Base\Entity;
use \Hash;

class ProfileEntity extends Entity
{
    protected $id              = null;
    protected $username        = null;
    protected $email           = null;
    protected $password        = null;
    protected $full_name       = null;
    protected $graduating_year = null;
    protected $bio             = null;

    const FLD_ID              = 'id';
    const FLD_USERNAME        = 'username';
    const FLD_EMAIL           = 'email';
    const FLD_PASSWORD        = 'password';
    const FLD_FULL_NAME       = 'full_name';
    const FLD_GRADUATING_YEAR = 'graduating_year';
    const FLD_BIO             = 'bio';
    const FLD_LANGUAGE        = 'language';

    public function __construct($id = null, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID              => 'getId',
            self::FLD_USERNAME        => 'getUsername',
            self::FLD_EMAIL           => 'getEmail',
            self::FLD_PASSWORD        => 'getPassword',
            self::FLD_FULL_NAME       => 'getFullName',
            self::FLD_GRADUATING_YEAR => 'getGraduatingYear',
            self::FLD_BIO             => 'getBio',
            self::FLD_LANGUAGE        => 'getLanguage',
        );

        if (is_null($id)) {
            $hydrate = false;
        }

        if ($hydrate === true) {
            $this->hydrate();
        }
    }

    public function getId()
    {
        return $this->{self::FLD_ID};
    }

    public function setId($id)
    {
        $this->{self::FLD_ID} = $id;
    }

    public function getUsername()
    {
        return $this->{self::FLD_USERNAME};
    }

    public function setUsername($username)
    {
        $this->{self::FLD_USERNAME} = $username;
    }

    public function getEmail()
    {
        return $this->{self::FLD_EMAIL};
    }

    public function setEmail($email)
    {
        $this->{self::FLD_EMAIL} = $email;
    }

    public function getPassword()
    {
        return $this->{self::FLD_PASSWORD};
    }

    public function setPassword($password)
    {
        $this->{self::FLD_PASSWORD} = $password;
    }

    public function getFullName()
    {
        return $this->{self::FLD_FULL_NAME};
    }

    public function setFullName($full_name)
    {
        $this->{self::FLD_FULL_NAME} = $full_name;
    }

    public function getGraduatingYear()
    {
        return $this->{self::FLD_GRADUATING_YEAR};
    }

    public function setGraduatingYear($year)
    {
        $this->{self::FLD_GRADUATING_YEAR} = $year;
    }

    public function getBio()
    {
        return $this->{self::FLD_BIO};
    }

    public function setBio($bio)
    {
        $this->{self::FLD_BIO} = $bio;
    }

    public function getLanguage()
    {
        return $this->{self::FLD_LANGUAGE};
    }

    public function setLanguage($language)
    {
        $this->{self::FLD_LANGUAGE} = $language;
    }

    public function hydrate()
    {
        $ProfileRepository = App::make('ProfileRepository');
        $profile           = $ProfileRepository::getProfile($this->{self::FLD_ID});

        $this->setUsername($profile[self::FLD_USERNAME]);
        $this->setEmail($profile[self::FLD_EMAIL]);
        $this->setPassword($profile[self::FLD_PASSWORD]);
        $this->setFullName($profile[self::FLD_FULL_NAME]);
        $this->setGraduatingYear($profile[self::FLD_GRADUATING_YEAR]);
        $this->setBio($profile[self::FLD_BIO]);
        $this->setLanguage($profile[self::FLD_LANGUAGE]);
    }

    public function hashPassword()
    {
        $this->{self::FLD_PASSWORD} = Hash::make($this->{self::FLD_PASSWORD});
    }
}
