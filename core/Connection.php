<?php
try {
    if (class_exists('PDO')) {
        $option = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $dsn = 'mysql:dbname=' . _DB . ';host=' . _HOST;
        $conn = new PDO(
            $dsn,
            _USER,
            _PASS,
            $option
        );
    }
} catch (Exception $e) {
    echo $e->getMessage() . '<br>';
    die();
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (
    isset($data['user']) &&
    !empty($data['user']['address']) &&
    !empty($data['user']['country']) &&
    !empty($data['user']['email']) &&
    !empty($data['user']['full_name']) &&
    !empty($data['user']['id_Number']) &&
    !empty($data['user']['phone_number']) &&
    isset($data['booking']) &&
    isset($data['booking_date']) &&
    isset($data['date_of_use'])
) {
    try {
        $user = $data['user'];
        $booking = $data['booking'];
        $booking_date = $data['booking_date'];
        $bookingDateTime = DateTime::createFromFormat('d/m/Y', $booking_date);
        $formattedBookingDate = $bookingDateTime->format('Y-m-d');

        $date_of_use = $data['date_of_use'];
        $dateOfUseDateTime = DateTime::createFromFormat('d/m/Y', $date_of_use);
        $formattedDateOfUseDate = $dateOfUseDateTime->format('Y-m-d');

        $conn->beginTransaction();

        $sql = "INSERT INTO users(name, email, phone, country, address, id_Number,created_at) 
          VALUES(:name, :email, :phone, :country, :address, :id_Number,:created_at)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $user['full_name'],
            ':email' => $user['email'],
            ':phone' => $user['phone_number'],
            ':country' => $user['country'],
            ':address' => $user['address'],
            ':id_Number' => $user['id_Number'],
            ':created_at' => date('Y-m-d H:i:s')
        ]);
        $userId = $conn->lastInsertId();


        $sql = "INSERT INTO customers(user_id) VALUES(:user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId
        ]);

        $customerId = $conn->lastInsertId();

        $sql = "INSERT INTO booking(customer_id, booking_date, date_of_use, total_price, payment_status) 
         VALUES(:customer_id, :booking_date, :date_of_use, :total_price,:payment_status)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':customer_id' => $customerId,
            ':booking_date' => $formattedBookingDate,
            ':date_of_use' => $formattedDateOfUseDate,
            ':total_price' => $booking['totalPrice'],
            ':payment_status' => 1
        ]);

        $bookingId = $conn->lastInsertId();

        $qrId = 'MHDTDBS-' . $bookingId;
        $qrCode = createQrCode($qrId);
        $sql = "UPDATE booking SET qrCode = :qrCode WHERE booking_id = $bookingId";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':qrCode' => $qrCode,
        ]);

        if (isset($booking['tickets']) && is_array($booking['tickets'])) {
            foreach ($booking['tickets'] as $ticket) {
                if (!isset($ticket['title']) || !isset($ticket['quantity']) || !isset($ticket['price'])) {
                    throw new Exception('Dữ liệu vé không hợp lệ: ' . json_encode($ticket));
                }

                $sql = "SELECT ticket_id FROM ticket WHERE ticket_name = :ticket_name";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':ticket_name' => $ticket['title']]);
                $ticket_id = $stmt->fetchColumn();

                if ($ticket_id === false) {
                    throw new Exception('ticket_name không tồn tại trong bảng ticket: ' . $ticket['title']);
                }

                $sql = "INSERT INTO booking_detail(booking_id, ticket_id, quantity, price) 
                VALUES(:booking_id, :ticket_id, :quantity, :price)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':booking_id' => $bookingId,
                    ':ticket_id' => $ticket_id,
                    ':quantity' => $ticket['quantity'],
                    ':price' => $ticket['price'],
                ]);
            }
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo 'Lỗi: ' . $e->getMessage();
    }
}

?>

<?php
// try {
//     if (class_exists('PDO')) {
//         $option = [
//             PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ];
//         $dsn = 'mysql:dbname=' . _DB . ';host=' . _HOST;
//         $conn = new PDO(
//             $dsn,
//             _USER,
//             _PASS,
//             $option
//         );
//     }
// } catch (Exception $e) {
//     echo $e->getMessage() . '<br>';
//     die();
// }



// $input = file_get_contents('php://input');
// $data = json_decode($input, true);

// if (
//     isset($data['user']) &&
//     !empty($data['user']['address']) &&
//     !empty($data['user']['country']) &&
//     !empty($data['user']['email']) &&
//     !empty($data['user']['full_name']) &&
//     !empty($data['user']['id_Number']) &&
//     !empty($data['user']['phone_number']) &&
//     isset($data['booking']) &&
//     isset($data['booking_date']) &&
//     isset($data['date_of_use'])
// ) {
//     try {
//         $user = $data['user'];
//         $booking = $data['booking'];
//         $booking_date = $data['booking_date'];
//         $bookingDateTime = DateTime::createFromFormat('d/m/Y', $booking_date);
//         $formattedBookingDate = $bookingDateTime->format('Y-m-d');

//         $date_of_use = $data['date_of_use'];
//         $dateOfUseDateTime = DateTime::createFromFormat('d/m/Y', $date_of_use);
//         $formattedDateOfUseDate = $dateOfUseDateTime->format('Y-m-d');

//         $conn->beginTransaction();

//         $userId = getFlashData('userIdLogin');
//         setFlashData('userIdLogin',$userId);
        
//         $sql = "SELECT customer_id FROM customers WHERE user_id = :user_id";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([
//             ':user_id' => $userId,
//         ]);
//         $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         $customerId = $res[0]['customer_id'];

//         $sql = "INSERT INTO booking(customer_id, booking_date, date_of_use, total_price, payment_status) 
//          VALUES(:customer_id, :booking_date, :date_of_use, :total_price,:payment_status)";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([
//             ':customer_id' => $customerId,
//             ':booking_date' => $formattedBookingDate,
//             ':date_of_use' => $formattedDateOfUseDate,
//             ':total_price' => $booking['totalPrice'],
//             ':payment_status' => 1
//         ]);

//         $bookingId = $conn->lastInsertId();

//         $qrId = 'MHDTDBS-' . $bookingId;
//         $qrCode = createQrCode($qrId);
//         $sql = "UPDATE booking SET qrCode = :qrCode WHERE booking_id = $bookingId";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([
//             ':qrCode' => $qrCode,
//         ]);

//         if (isset($booking['tickets']) && is_array($booking['tickets'])) {
//             foreach ($booking['tickets'] as $ticket) {
//                 if (!isset($ticket['title']) || !isset($ticket['quantity']) || !isset($ticket['price'])) {
//                     throw new Exception('Dữ liệu vé không hợp lệ: ' . json_encode($ticket));
//                 }

//                 $sql = "SELECT ticket_id FROM ticket WHERE ticket_name = :ticket_name";
//                 $stmt = $conn->prepare($sql);
//                 $stmt->execute([':ticket_name' => $ticket['title']]);
//                 $ticket_id = $stmt->fetchColumn();

//                 if ($ticket_id === false) {
//                     throw new Exception('ticket_name không tồn tại trong bảng ticket: ' . $ticket['title']);
//                 }

//                 $sql = "INSERT INTO booking_detail(booking_id, ticket_id, quantity, price) 
//                 VALUES(:booking_id, :ticket_id, :quantity, :price)";
//                 $stmt = $conn->prepare($sql);
//                 $stmt->execute([
//                     ':booking_id' => $bookingId,
//                     ':ticket_id' => $ticket_id,
//                     ':quantity' => $ticket['quantity'],
//                     ':price' => $ticket['price'],
//                 ]);
//             }
//         }

//         $conn->commit();
//     } catch (Exception $e) {
//         $conn->rollBack();
//         echo 'Lỗi: ' . $e->getMessage();
//     }
// }
