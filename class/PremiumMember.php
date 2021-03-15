<?php


class PremiumMember extends Member
{
    private  $_indoorInterests;
    private  $_outdoorInterests;

    public function __construct()
    {
        parent::__construct('','',0,'','',"","","","");
    }

    /**
     * @return mixed indoor interest
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param  $indoorInterests
     * set indoor interest
     */
    public function setIndoorInterests( $indoorInterests): void
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * @return mixed string outdoor interest
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param  $outdoorInterests
     * set outdoor interest
     */
    public function setOutdoorInterests( $outdoorInterests): void
    {
        $this->_outdoorInterests = $outdoorInterests;
    }



}