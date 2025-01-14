<div class="wrapper">
    <?php $this->render('blocks\clients\headerBooking'); ?>
    <!-- end header  -->

    <div class="orientation" style="display: none;">
        <div class="progress-bar">
            <div class="line"></div>
            <div class="line2"></div>
            <div class="progress-step" id="step1">
                <a href="<?php echo _HOST_PATH_ ?>/clients/BookTickets">
                    <div class="step-label">Thiên đường bảo sơn</div>
                    <i class="fas fa-map-marker-alt step-icon"></i>
                </a>
            </div>
            <div class="progress-step" id="step2">
                <a href="<?php echo _HOST_PATH_ ?>/clients/Tickets">
                    <div class="step-label">Chọn vé</div>
                    <i class="fas fa-ticket-alt step-icon"></i>
                </a>
            </div>
            <div class="progress-step " id="step3">
                <a href="<?php echo _HOST_PATH_ ?>/clients/Checkout">
                    <div class="step-label active">Thanh toán</div>
                    <i class="fas fa-credit-card step-icon active"></i>
                </a>
            </div>
            <div class="progress-step active" id="step4">
                <a href="#">
                    <div class="step-label active">Kết thúc</div>
                    <i class="fas fa-check step-icon "></i>
                </a>
            </div>
        </div>
    </div>

    <div class="banner_complete" style="margin-top: 100px;">
        <div class="top-bar_complete">
            <p>DANH SÁCH VÉ ĐÃ MUA</p>
        </div>
        <div class="container_complete" style="width: 100%; max-width: 100%;">
            <div class="form-container_complete">
                <div class="customer-info_complete" <?php
                                                    if (empty($bookingData)) {
                                                        echo 'style="box-shadow: none !important;"';
                                                    }
                                                    ?>>
                    <?php
                    if (!empty($bookingData)) {
                    ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SẢN PHẨM/ DỊCH VỤ</th>
                                    <th>NGÀY SỬ DỤNG</th>
                                    <th>NGÀY THANH TOÁN</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>ĐƠN GIÁ (VNĐ)</th>
                                    <th>THÀNH TIỀN (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($bookingData as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value['ticket_name'] ?></td>
                                        <td><?php echo $value['date_of_use'] ?></td>
                                        <td><?php echo $value['booking_date'] ?></td>
                                        <td><?php echo $value['quantity'] ?></td>
                                        <td><?php
                                            $price = str_replace('.', '', $value['price']);
                                            echo number_format($price, 0, ',', '.');
                                            ?></td>
                                        <td><?php echo number_format($price * $value['quantity'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="5" class="discount">GIẢM GIÁ</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="total">TỔNG TIỀN (VNĐ)</td>
                                    <td><?php echo number_format($bookingData[0]['total_price'], 0, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <img style="
                            transform: rotate(-45deg);
                        " src="<?php echo _HOST_PATH_ ?>\public\assets\clients\images\book_tickets_img\cartEmpty.png" alt="">
                        <p style="font-size: 20px; font-weight: bold; color: red;">Chưa có vé nào được đặt. Chọn đặt ít nhất 1 vé để tiếp tục</p>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- end banner -->

    <div class="footer">
        <div class="content-footer">
            <p>Copyright © 2023 baosonparadise.vn - Bản quyền website thuộc về CÔNG TY TNHH MỘT THÀNH VIÊN DU LỊCH
                GIẢI TRÍ THIÊN ĐƯỜNG BẢO SƠN</p>
        </div>
    </div>
    <!-- end footer -->
</div>

<?php
// $cid =  getFlashData('iddd');
// setFlashData('iddd',$cid);
// echo $cid;
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
$userId = getFlashData('userIdLogin');
setFlashData('userIdLogin', $userId);
$model = new Model();
// $model->Select()
// $customerId = $model->Select("SELECT customer_id FROM customers WHERE user_id = $userId")[0]['customer_id'];
$sql = "SELECT customer_id FROM customers WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':user_id' => $userId,
]);
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo $res[0]['customer_id'];
$customerId = $res[0]['customer_id'];
$sql = "INSERT INTO booking(customer_id, booking_date, date_of_use, total_price, payment_status) 
         VALUES(:customer_id, :booking_date, :date_of_use, :total_price,:payment_status)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':customer_id' => $customerId,
    ':booking_date' => '2024-02-01',
    ':date_of_use' => '2024-02-01',
    ':total_price' => 100,
    ':payment_status' => 1
]);
?>