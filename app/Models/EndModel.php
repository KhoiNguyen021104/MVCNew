<?php
class EndModel extends Model
{
    public function __construct()
    {
    }

    public function getBookingInfo($id)
    {
        $data = $this->Select(
            "SELECT u.name,u.phone,u.address,u.email,t.ticket_name,
                bd.quantity,t.price,b.total_price,b.date_of_use,b.qrCode,
                b.booking_date
                FROM booking b
                INNER JOIN customers c on c.customer_id = b.customer_id
                INNER JOIN users u on u.user_id = c.user_id
                INNER JOIN booking_detail bd ON bd.booking_id = b.booking_id
                INNER JOIN ticket t on t.ticket_id = bd.ticket_id
                WHERE b.booking_id = $id"
        );
        return $data;
    }
}
