<div class="wrapper">
    <?php $this->render('blocks\clients\headerBooking'); ?>
    <!-- end header -->

    <div class="orientation">
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

    <div class="banner_complete">
        <div class="top-bar_complete">
            <p>GIAO DỊCH THÀNH CÔNG</p>
            <div>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</div>
        </div>

        <div class="container_complete">
            <div class="form-container_complete">
                <div class="customer-info_complete">
                    <div class="text-date-complete">
                        <h1>Ngày sử dụng: <span id="ticket-date_complete"><?php echo $bookingInfo[0]['date_of_use'] ?></span></h1>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SẢN PHẨM/ DỊCH VỤ</th>
                                <th>SỐ LƯỢNG</th>
                                <th>ĐƠN GIÁ (VNĐ)</th>
                                <th>THÀNH TIỀN (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($bookingInfo)) {
                                foreach ($bookingInfo as $key => $value) {
                            ?>
                                    <tr>
                                        <td><?php echo $value['ticket_name'] ?></td>
                                        <td><?php echo $value['quantity'] ?></td>
                                        <td><?php
                                            $price = str_replace('.', '', $value['price']);
                                            echo number_format($price, 0, ',', '.');
                                            ?></td>
                                        <td><?php echo number_format($price * $value['quantity'], 0, ',', '.') ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="3" class="discount">GIẢM GIÁ</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="total">TỔNG TIỀN (VNĐ)</td>
                                <td><?php echo number_format($bookingInfo[0]['total_price'], 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-footer-complete">
                        <div>Ngày thanh toán: <span class="payment-date"><?php echo $bookingInfo[0]['booking_date'] ?></span></div>
                        <div class="contact-info-complete">Họ tên: <span id="customer-fullname"><?php echo $bookingInfo[0]['name'] ?></span>
                        </div>
                        <div class="contact-info-complete">Số điện thoại: <span id="customer-phone"><?php echo $bookingInfo[0]['phone'] ?></span>
                        </div>
                        <div class="contact-info-complete">Địa chỉ: <span id="customer-address"><?php echo $bookingInfo[0]['address'] ?></span></div>
                        <div class="contact-info-complete">Mọi thông tin về vé chúng tôi sẽ gửi về hòm thư:
                            <span id="customer-email"><?php echo $bookingInfo[0]['email'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="qrCode">
            <div class="top-bar_complete">
                <p>MÃ QR SOÁT VÉ VÀO CỔNG</p>
                <div>Vui lòng sử dụng mã qr để soát vé vào khu vui chơi!</div>
            </div>
            <img src="<?php echo _HOST_PATH_ ?>/public/assets/admin/images/qrcodeTicket/<?php echo $bookingInfo[0]['qrCode']  ?>" alt="">
        </div>
    </div>

    <div class="footer">
        <div class="content-footer">
            <p>Copyright © 2023 baosonparadise.vn - Bản quyền website thuộc về CÔNG TY TNHH MỘT THÀNH VIÊN DU LỊCH
                GIẢI TRÍ THIÊN ĐƯỜNG BẢO SƠN</p>
        </div>
    </div>
</div>