<?php

class SendMailBookingModel extends Model
{
    public function __construct()
    {
    }

    public function getBookingId($email)
    {
        $sql = "SELECT b.booking_id,b.qrCode
                FROM booking b
                INNER JOIN customers c on c.customer_id = b.customer_id
                INNER JOIN users u on u.user_id = c.user_id
                WHERE u.email = '$email'
                ORDER BY b.booking_id DESC
                LIMIT 1";
        $data = $this->Select($sql);
        return $data;
    }
}
