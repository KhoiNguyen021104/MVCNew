<?php
class CountryModel extends Model
{
    public function __construct()
    {
    }
    public function getAllCountry()
    {
        $sql = "SELECT * FROM countries";
        return $this->Select($sql);
    }
}


  