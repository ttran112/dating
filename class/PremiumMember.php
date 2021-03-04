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
     * @return
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param  $indoorInterests
     */
    public function setIndoorInterests( $indoorInterests): void
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * @return
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param  $outdoorInterests
     */
    public function setOutdoorInterests( $outdoorInterests): void
    {
        $this->_outdoorInterests = $outdoorInterests;
    }



}