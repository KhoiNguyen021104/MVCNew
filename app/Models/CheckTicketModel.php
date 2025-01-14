<?php
class CheckTicketModel extends Model
{
    public function __construct()
    {
    }

    public function checkExistQr($qrCode) {
        $sql = "SELECT count(*) FROM booking WHERE qrCode = '$qrCode'   ";
        return $this->countLine($sql);
    }

    public function getUseStatus($id)
    {
        $data = $this->Select("SELECT use_status FROM booking WHERE booking_id = $id");
        return $data;
    }

    public function updateUseStatus($id)
    {
        $data = [
            'use_status' => 1,
        ];
        $condition = " booking_id = $id ";
        $updateStatus = $this->Update('booking', $data, $condition);
        if($updateStatus) return true;
        return false;
    }
}
