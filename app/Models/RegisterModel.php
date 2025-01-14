<?php
class RegisterModel extends Model
{
    public function __construct()
    {
    }

    public function addAccount($data) {
        $addStatus = $this->Insert('account', $data);
        if ($addStatus) return true;
        return false;
    }
}
  