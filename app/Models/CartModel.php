<?php
class CartModel extends Model
{
    public function __construct()
    {
    }

    public function getAllBooking($id) {
        $data = $this->Select(
            "SELECT 
                            b.booking_id,
                            b.booking_date,
                            b.date_of_use,
                            b.total_price,
                            b.payment_status,
                            t.ticket_name,
                            bd.quantity,
                            t.price
                            FROM users u
                            JOIN customers c ON u.user_id = c.user_id
                            JOIN booking b ON c.customer_id = b.customer_id 
                            JOIN booking_detail bd ON bd.booking_id = b.booking_id
                            JOIN ticket t ON t.ticket_id = bd.ticket_id
                            WHERE u.user_id = $id"
        );
        return $data;
    }
}
  