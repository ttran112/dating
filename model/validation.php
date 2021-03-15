<?php
class validation
{
    //field
    private $_dataLayer;

    /**
     * validation constructor.
     * @param $dataLayer
     */
    function __construct($dataLayer)
    {
        //$this->_dataLayer = new DataLayer();
        $this->_dataLayer = $dataLayer;
    }

    /**
     * @param $name
     * @return bool name
     */
    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);
    }

    /**
     * @param $age
     * @return bool
     */
    function validAge($age)
    {
        return !empty($age) && is_numeric($age);
    }

    /**
     * @param $gender
     * @return bool gender
     */
    function validGenders($gender)
    {
        $validGenders = $this->_dataLayer->getGenders();
        return in_array($gender, $validGenders);

    }

    /**
     * @param $phone
     * @return bool phone
     */
    function validPhone($phone)
    {
        return !empty($phone) && preg_match("/^\d{10}$/", $phone);
    }

    /**
     * @param $email
     * @return bool email
     */
    function validEmail($email)
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $selectedIndoors
     * @return bool indoor interest
     */
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

    /**
     * @param $selectedOutdoors
     * @return bool outdiir interest
     */
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



