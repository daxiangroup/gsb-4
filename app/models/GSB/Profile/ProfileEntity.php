<?php namespace GSB\Profile;

// TODO: make sure we use FLD_***** everywhere

use \GSB\Profile\ProfileRepository;
use \GSB\Base\Entity;
use \Hash;

//class ProfileEntity extends Entity
class ProfileEntity extends Entity
{
    protected $id = null;
    protected $username = null;
    protected $email = null;
    protected $password = null;
    protected $full_name = null;
    protected $graduating_year = null;
    protected $bio = null;

    const FLD_ID = 'id';
    const FLD_USERNAME = 'username';
    const FLD_EMAIL = 'email';
    const FLD_PASSWORD = 'password';
    const FLD_FULL_NAME = 'full_name';
    const FLD_GRADUATING_YEAR = 'graduating_year';
    const FLD_BIO = 'bio';
    const FLD_LANGUAGE = 'language';

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
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = Hash::make($password);
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getGraduatingYear()
    {
        return $this->graduating_year;
    }

    public function setGraduatingYear($year)
    {
        $this->graduating_year = $year;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function hydrate()
    {
        $profile = ProfileRepository::getProfile($this->id);

        $this->setUsername($profile['username']);
        $this->setEmail($profile['email']);
        $this->setPassword($profile['password']);
        $this->setFullName($profile['full_name']);
        $this->setGraduatingYear($profile['graduating_year']);
        $this->setBio($profile['bio']);
        $this->setLanguage($profile['language']);
    }
}
