<?php


class Member
{
    //fields
    private  $_fname;
    private  $_lname;
    private  $_age;
    private  $_gender;
    private  $_phone; // Should change to  later
    private  $_email;
    private  $_state;
    private  $_seeking;
    private  $_bio;

    /**
     * @return mixed string name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param  $fname
     * set string name
     */
    public function setFname( $fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed string name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param  $lname
     * set name
     */
    public function setLname( $lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed int age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param  $age
     * set age
     */
    public function setAge( $age): void
    {
        $this->_age = $age;
    }

    /**
     * @return mixed string gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param  $gender
     * set gender
     */
    public function setGender( $gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return mixed phone
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param  $phone
     * set phone
     */
    public function setPhone( $phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed string email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param  $email
     * set email
     */
    public function setEmail( $email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed string state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param  $state
     * set state
     */
    public function setState( $state): void
    {
        $this->_state = $state;
    }

    /**
     * @return mixed string seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param  $seeking
     * set seeking
     */
    public function setSeeking( $seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed string bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param  $bio
     * set bio
     */
    public function setBio( $bio): void
    {
        $this->_bio = $bio;
    }


    public function __construct ($fname, $lname, $age, $gender, $phone,$email,$state,$seeking,$bio)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_state = $state;
        $this->_seeking = $seeking;
        $this->_bio = $bio;

    }




}