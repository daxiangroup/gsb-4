<?php namespace GSB\Profile;

// TODO: Convert exceptions to GSBException's

use \App;
use \GSB\Base\Entity;
use \GSB\Profile\ProfileRepository;
use \Hash;
use \InvalidArgumentException;

class ProfileEntity extends Entity
{
    protected $id               = null;
    protected $username         = null;
    protected $email            = null;
    protected $password         = null;
    protected $full_name        = null;
    protected $graduating_year  = null;
    protected $bio              = null;
    protected $language         = null;
    protected $minimum_complete = null;

    const FLD_ID                = 'id';
    const FLD_USERNAME          = 'username';
    const FLD_EMAIL             = 'email';
    const FLD_PASSWORD          = 'password';
    const FLD_FULL_NAME         = 'full_name';
    const FLD_GRADUATING_YEAR   = 'graduating_year';
    const FLD_BIO               = 'bio';
    const FLD_LANGUAGE          = 'language';
    const FLD_MINIMUM_COMPLETE  = 'minimum_complete';

    public function __construct($id = null, $hydrate = false)
    {
        if (!is_null($id) && !is_int($id)) {
            throw new InvalidArgumentException('Id must be an integer');
        }

        $this->id     = $id;
        $this->fields = array(
            self::FLD_ID               => 'getId',
            self::FLD_USERNAME         => 'getUsername',
            self::FLD_EMAIL            => 'getEmail',
            self::FLD_PASSWORD         => 'getPassword',
            self::FLD_FULL_NAME        => 'getFullName',
            self::FLD_GRADUATING_YEAR  => 'getGraduatingYear',
            self::FLD_BIO              => 'getBio',
            self::FLD_LANGUAGE         => 'getLanguage',
            self::FLD_MINIMUM_COMPLETE => 'getMinimumComplete',
        );

        if (is_null($id)) {
            $hydrate = false;
        }

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
        if (!is_int($id)) {
            throw new InvalidArgumentException('Id must be an integer');
        }

        $this->{self::FLD_ID} = $id;
    }

    public function getUsername()
    {
        return $this->{self::FLD_USERNAME};
    }

    public function setUsername($username)
    {
        if (!is_string($username)) {
            throw new InvalidArgumentException('Username must be a string');
        }

        if (is_numeric($username)) {
            throw new InvalidArgumentException('Username cannot be numeric');
        }

        $this->{self::FLD_USERNAME} = $username;
    }

    public function getEmail()
    {
        return $this->{self::FLD_EMAIL};
    }

    public function setEmail($email)
    {
        if (!is_string($email)) {
            throw new InvalidArgumentException('Email must be a string');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email must be valid');
        }

        $this->{self::FLD_EMAIL} = $email;
    }

    public function getPassword()
    {
        return $this->{self::FLD_PASSWORD};
    }

    public function setPassword($password)
    {
        if (!is_string($password)) {
            throw new InvalidArgumentException('Password must be a string');
        }

        $this->{self::FLD_PASSWORD} = $password;
    }

    public function getFullName()
    {
        return $this->{self::FLD_FULL_NAME};
    }

    public function setFullName($full_name)
    {
        if (!is_string($full_name)) {
            throw new InvalidArgumentException('Full Name must be a string');
        }

        if (is_numeric($full_name)) {
            throw new InvalidArgumentException('Full Name cannot be numeric');
        }

        $this->{self::FLD_FULL_NAME} = $full_name;
    }

    public function getGraduatingYear()
    {
        return $this->{self::FLD_GRADUATING_YEAR};
    }

    public function setGraduatingYear($year)
    {
        if (!is_numeric($year)) {
            throw new InvalidArgumentException('Graduating Year must be numeric');
        }

        $this->{self::FLD_GRADUATING_YEAR} = $year;
    }

    public function getBio()
    {
        return $this->{self::FLD_BIO};
    }

    public function setBio($bio)
    {
        if (!is_string($bio)) {
            throw new InvalidArgumentException('Bio must be a string');
        }

        $this->{self::FLD_BIO} = $bio;
    }

    public function getLanguage()
    {
        return $this->{self::FLD_LANGUAGE};
    }

    public function setLanguage($language)
    {
        if (!is_string($language)) {
            throw new InvalidArgumentException('Language must be a string');
        }

        if (is_numeric($language)) {
            throw new InvalidArgumentException('Language cannot be numeric');
        }

        if (strlen($language) != 2) {
            throw new InvalidArgumentException('Language must be two characters');
        }

        $this->{self::FLD_LANGUAGE} = $language;
    }

    public function getMinimumComplete()
    {
        return $this->{self::FLD_MINIMUM_COMPLETE} === 1 ? true : false;
    }

    public function setMinimumComplete($complete)
    {
        if (!is_bool($complete)) {
            throw new InvalidArgumentException('Minimum Complete must be a boolean');
        }

        $this->{self::FLD_MINIMUM_COMPLETE} = $complete == true ? 1 : 0;
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
