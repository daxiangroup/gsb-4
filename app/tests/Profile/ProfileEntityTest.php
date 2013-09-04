<?php

use \GSB\Profile\ProfileEntity;

class ProfileEntityTest extends TestCase {
    public function testEntityHasCorrectFields()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertArrayHasKey('id', $ProfileEntity->getFields());
        $this->assertArrayHasKey('username', $ProfileEntity->getFields());
        $this->assertArrayHasKey('email', $ProfileEntity->getFields());
        $this->assertArrayHasKey('password', $ProfileEntity->getFields());
        $this->assertArrayHasKey('full_name', $ProfileEntity->getFields());
        $this->assertArrayHasKey('graduating_year', $ProfileEntity->getFields());
        $this->assertArrayHasKey('bio', $ProfileEntity->getFields());
        $this->assertArrayHasKey('language', $ProfileEntity->getFields());
    }

    // *****[ Id Tests ]********************************************************
    public function testIdIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getId());
    }

    public function testIdIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setId(2);

        $this->assertNotNull($ProfileEntity->getId());
    }

    public function testIdIsNotNullUsingConstructor()
    {
        $ProfileEntity = new ProfileEntity(2);

        $this->assertEquals(2, $ProfileEntity->getId());
    }

    public function testIdIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setId(2);

        $this->assertEquals(2, $ProfileEntity->getId());
    }

    public function testIdIsNotString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setId('2');
    }

    public function testIdIsNotStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Id must be an integer');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setId('2');
    }

    // *****[ Username Tests ]**************************************************
    public function testUsernameIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getUsername());
    }

    public function testUsernameIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setUsername('Jimmy');

        $this->assertNotNull($ProfileEntity->getUsername());
    }

    public function testUsernameIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setUsername('Jimmy');

        $this->assertEquals('Jimmy', $ProfileEntity->getUsername());
    }

    public function testUsernameIsAString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setUsername(438);
    }

    public function testUsernameIsAStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Username must be a string');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setUsername(438);
    }

    public function testUsernameIsNotNumeric()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setUsername('438');
    }

    public function testUsernameIsNotNumericMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Username cannot be numeric');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setUsername('438');
    }

    // *****[ Email Tests ]*****************************************************
    public function testEmailIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getEmail());
    }

    public function testEmailIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setEmail('jimmy@james.com');

        $this->assertNotNull($ProfileEntity->getEmail());
    }

    public function testEmailIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setEmail('jimmy@james.com');

        $this->assertEquals('jimmy@james.com', $ProfileEntity->getEmail());
    }

    public function testEmailIsAString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setEmail(438);
    }

    public function testEmailIsAStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Email must be a string');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setEmail(438);
    }

    public function testEmailIsInvalid()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setEmail('jimmy-at-james-dot-com');
    }

    public function testEmailIsInvalidMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Email must be valid');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setEmail('jimmy-at-james-dot-com');
    }

    // *****[ Password Tests ]**************************************************
    public function testPasswordIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getPassword());
    }

    public function testPasswordIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setPassword('password');

        $this->assertNotNull($ProfileEntity->getPassword());
    }

    public function testPasswordIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setPassword('password');

        $this->assertEquals('password', $ProfileEntity->getPassword());
    }

    public function testPasswordIsAString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setPassword(438);
    }

    public function testPasswordIsAStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Password must be a string');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setPassword(438);
    }

    // *****[ Full Name Tests ]*************************************************
    public function testFullNameIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getFullName());
    }

    public function testFullNameIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setFullName('Jimmy James');

        $this->assertNotNull($ProfileEntity->getFullName());
    }

    public function testFullNameIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setFullName('Jimmy James');

        $this->assertEquals('Jimmy James', $ProfileEntity->getFullName());
    }

    public function testFullNameIsAString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setFullName(438);
    }

    public function testFullNameIsAStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Full Name must be a string');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setFullName(438);
    }

    public function testFullNameIsNotNumeric()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setFullName('438');
    }

    public function testFullNameIsNotNumericMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Full Name cannot be numeric');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setFullName('438');
    }

    // *****[ Graduating Year Tests ]*******************************************
    public function testGraduatingYearIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getGraduatingYear());
    }

    public function testGraduatingYearIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setGraduatingYear(2017);

        $this->assertNotNull($ProfileEntity->getGraduatingYear());
    }

    public function testGraduatingYearIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setGraduatingYear(2017);

        $this->assertEquals(2017, $ProfileEntity->getGraduatingYear());
    }

    public function testGraduatingYearIsNumeric()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setGraduatingYear('jimmy');
    }

    public function testGraduatingYearIsNumericMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Graduating Year must be numeric');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setGraduatingYear('jimmy');
    }

    // *****[ Bio Tests ]*******************************************************
    public function testBioIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getBio());
    }

    public function testBioIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setBio('lorem ipsum');

        $this->assertNotNull($ProfileEntity->getBio());
    }

    public function testBioIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setBio('lorem ipsum');

        $this->assertEquals('lorem ipsum', $ProfileEntity->getBio());
    }

    public function testBioIsAString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setBio(438);
    }

    public function testBioIsAStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Bio must be a string');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setBio(438);
    }

    // *****[ Language Tests ]*******************************************************
    public function testLanguageIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getLanguage());
    }

    public function testLanguageIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage('en');

        $this->assertNotNull($ProfileEntity->getLanguage());
    }

    public function testLanguageIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage('en');

        $this->assertEquals('en', $ProfileEntity->getLanguage());
    }

    public function testLanguageIsAString()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage(438);
    }

    public function testLanguageIsAStringMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Language must be a string');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage(438);
    }

    public function testLanguageIsNotNumeric()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage('438');
    }

    public function testLanguageIsNotNumericMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Language cannot be numeric');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage('438');
    }

    public function testLanguageIsTwoCharacters()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage('english');
    }

    public function testLanguageIsTwoCharactersMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Language must be two characters');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setLanguage('english');
    }

    // *****[ Minimum Completre Tests ]*****************************************
    public function testMinimumCompleteIsNull()
    {
        $ProfileEntity = new ProfileEntity();

        $this->assertNull($ProfileEntity->getMinimumComplete());
    }

    public function testMinimumCompleteIsNotNull()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setMinimumComplete(true);

        $this->assertNotNull($ProfileEntity->getMinimumComplete());
    }

    public function testMinimumCompleteIsEqualToSet()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setMinimumComplete(true);

        $this->assertEquals(true, $ProfileEntity->getMinimumComplete());
    }

    public function testMinimumCompleteIsBoolean()
    {
        $this->setExpectedException('InvalidArgumentException');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setMinimumComplete('Jimmy');
    }

    public function testMinimumCompleteIsBooleanMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'Minimum Complete must be a boolean');

        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setMinimumComplete('Jimmy');
    }

    // TODO: properly mock out profile repository for hydrate tests

    public function testHashPasswordAltersPassword()
    {
        $ProfileEntity = new ProfileEntity();
        $ProfileEntity->setPassword('password');
        $ProfileEntity->hashPassword();

        $this->assertNotEquals('password', $ProfileEntity->getPassword());
    }
}