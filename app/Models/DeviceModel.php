<?php
class DeviceModel extends Model
{
    public function __construct()
    {
    }

    public function getAllDevices($condition = '')
    {
        $sql = "SELECT * FROM devices";
        if(!empty($condition)) $sql .= " WHERE $condition";
        $data = $this->Select($sql);
        return $data;
    }

    public function addDevice($data){
        $addStatus = $this->Insert('devices', $data);
        if ($addStatus) return true;
        return false;
    }

    public function updateDevice($data, $condition){
        $updateStatus = $this->Update('devices', $data, $condition);
        if ($updateStatus) return true;
        return false;
    }

    public function deleteDevice($id) {
        $deleteStatus = $this->Delete('devices'," device_id = $id");
        if($deleteStatus) return true;
        return false;
    }

    public function updateQuantityRented($id,$quantity,$status = 0) {
        $sql = "UPDATE devices SET quantity_rented = quantity_rented + $quantity WHERE device_id = $id";
        if($status == 1) $sql = "UPDATE devices SET quantity_rented = quantity_rented - $quantity WHERE device_id = $id";
        return $this->ExecuteSql($sql);
    }
}
