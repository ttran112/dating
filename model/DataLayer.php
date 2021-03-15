<?php
/**
 * Class DataLayer
 */

class DataLayer
{
    private $_dbh;
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }
    function getMembers()
    {
        //Define the query
        $sql = "SELECT * FROM dating";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }

    function insertMember($member)
    {
        //var_dump($member);
        //Define the query
        $sql = "INSERT INTO dating(fname, lname, age, gender, phone, email, state, seeking, bio) 
	            VALUES (:fname, :lname, :age, :gender, :phone, :email, :state , :seeking, :bio)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_INT);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        //$statement->bindParam(':premium', $member->getFood(), PDO::PARAM_BOOL);
        //$statement->bindParam(':interest', $member->getIndoorInterest(), PDO::PARAM_STR);
        //$statement->bindParam(':image', $member->getCondiments(), PDO::PARAM_STR);

        //Execute
        $statement->execute();
        $id = $this->_dbh->lastInsertId();
    }


    function getInterest()
    {
        //Define the query
        $sql = "SELECT * FROM dating";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }
/*
 * CREATE TABLE dating
(
    member_id int(4) not null PRIMARY key AUTO_INCREMENT,
    fname varchar(20) not null,
    lname varchar(20) not null,
    age int(3) not null,
    gender varchar(20),
    phone int(10) not null,
    email varchar(50) not null,
    state varchar(20),
    seeking varchar(20),
    bio varchar(255),
    preminum BIT,
    interest varchar(255),
    image varchar(255)
);
 */
    function getGenders()
    {
        return array('Male', 'Female', "Other");
    }

//array list of states
    function getState()
    {
        return array('Washington', 'California', 'New York');
    }

//array list function of indoor interest
    function getIndoorInterest()
    {
        return array("games", "movies", "comedy", "sci-fi", "streaming", "mma", "xbox", "playstation");
    }

//array list function of indoor outdoor
    function getOutdoorInterest()
    {
        return array("basketball", "soccer", "football", "hiking", "boat");
    }
}