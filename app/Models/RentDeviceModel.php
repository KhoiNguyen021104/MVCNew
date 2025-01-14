<?php
class RentDeviceModel extends Model
{
    public function __construct()
    {

    }

    public function getAllSlip($condition = '')
    {
        $sql = "SELECT * FROM rental_slip";
        if(!empty($condition)) $sql .= " WHERE $condition";
        $data = $this->Select($sql);
        return $data;
    }

    public function getLastSlipId() {
        $sql = "SELECT rental_slip_id FROM rental_slip ORDER BY rental_slip_id DESC LIMIT 1";
        $data = $this->Select($sql);
        return $data;
    }

    public function getAllSlipDetail($condition) {
        $sql = "SELECT * FROM rental_slip_detail";
        if(!empty($condition)) $sql .= " WHERE $condition";
        $data = $this->Select($sql);
        return $data;
    }
    public function getStatusSlip($id) {
        $sql = "SELECT rent_status FROM rental_slip WHERE rental_slip_id = $id";
        $data = $this->Select($sql)[0]['rent_status'];
        return $data;
    }

    public function getBillRent($id) {
        $sql = "SELECT rs.rental_slip_id,rs.rent_name, rs.rent_phone,rs.rent_id_number,rs.rent_address,d.device_name,rsd.quantity_rent,d.price_rent,rs.time_rent
                FROM rental_slip rs 
                INNER JOIN rental_slip_detail rsd ON rsd.rental_slip_id = rs.rental_slip_id
                INNER JOIN devices d ON d.device_id = rsd.device_id
                WHERE rs.rental_slip_id = $id
                ";
        $data = $this->Select($sql);
        return $data;
    }
    
    public function addRentSlip($data){
        $addStatus = $this->Insert('rental_slip', $data);
        if ($addStatus) return true;
        return false;
    }

    public function addRentSlipDetail($data){
        $addStatus = $this->Insert('rental_slip_detail', $data);
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

    public function updateRentStatus($id) {
        $data = [
            'rent_status' => 1,
        ];
        $condition = " rental_slip_id = $id";
        $updateStatus = $this->Update('rental_slip', $data, $condition);
        if ($updateStatus) return true;
        return false;
    }

    public function updateRentSlip($id,$data) {
        $condition = " rental_slip_id = $id";
        $updateStatus = $this->Update('rental_slip', $data, $condition);
        if ($updateStatus) return true;
        return false;
    }
}
