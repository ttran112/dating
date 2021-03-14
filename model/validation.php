<?php
class validation
{
    private $_dataLayer;
    function __construct($dataLayer)
    {
        //$this->_dataLayer = new DataLayer();
        $this->_dataLayer = $dataLayer;
    }

    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);
    }

    function validAge($age)
    {
        return !empty($age) && is_numeric($age);
    }

    function validGenders($gender)
    {
        $validGenders = $this->_dataLayer->getGenders();
        return in_array($gender, $validGenders);


    }

    function validPhone($phone)
    {
        return !empty($phone) && preg_match("/^\d{10}$/", $phone);
    }

    function validEmail($email)
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    function validIndoor($selectedIndoors)
    {
        $validIndoors = $this->_dataLayer->getIndoorInterest();
        foreach ($selectedIndoors as $selected) {
            if (!in_array($selected, $validIndoors)) {
                return false;
            }
        }
        return true;
    }

    function validOutDoor($selectedOutdoors)
    {
        $validOutdoors = $this->_dataLayer->getOutdoorInterest();
        foreach ($selectedOutdoors as $selected) {
            if (!in_array($selected, $validOutdoors)) {
                return false;
            }
        }
        return true;
    }
}



