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
            <div class="progress-step active" id="step2">
                <a href="#">
                    <div class="step-label active">Chọn vé</div>
                    <i class="fas fa-ticket-alt step-icon active"></i>
                </a>
            </div>
            <div class="progress-step" id="step3">
                <a href="#">
                    <div class="step-label">Thanh toán</div>
                    <i class="fas fa-credit-card step-icon"></i>
                </a>
            </div>
            <div class="progress-step" id="step4">
                <a href="#">
                    <div class="step-label">Kết thúc</div>
                    <i class="fas fa-check step-icon"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- end orientation -->

    <div class="banner_ticket banner" style="background-image: url('<?php echo _HOST_PATH_ ?>/public/assets/clients/images/book_tickets_img/bg-page.png');">
        <div class="top-bar">
            <div class="filter-selection-ticket">
                <div class="filter-btn active">
                    <span>ALL</span>
                </div>
                <div class="filter-btn">
                    <span>VÉ VÀO CỔNG</span>
                </div>
            </div>
            <div class="usage-date">
                <span>Ngày sử dụng:</span>
                <input type="text" id="usage-date" redonly>
                <i class="fa-regular fa-calendar calendar-icon"></i>
            </div>
            <div class="sort-options">
                <span>Sắp xếp</span>
                <select>
                    <option value="type">Kiểu</option>
                    <option value="type">Vé rẻ nhất</option>
                    <option value="type">Vé đắt nhất</option>
                    <!-- Add more sorting options here if needed -->
                </select>
            </div>
        </div>

        <!-- end top-bar -->

        <div class="ticket-selection">
            <?php
            if (!empty($ticketList)) {
                foreach ($ticketList as $key => $value) {
            ?>
                    <div class="ticket">
                        <img src="<?php echo _HOST_PATH_ ?>\public\assets\admin\images\ticket_type_image\<?php echo $value['ticket_icon'] ?>" alt="Ticket <?php echo $value['ticket_id'] ?>">
                        <span id="ticketId" style="display: none;"><?php echo $value['ticket_id'] ?></span>
                        <div class="ticket-details">
                            <div class="content-ticket">
                                <p><i class="fas fa-ticket-alt"></i><?php echo $value['ticket_name'] ?></p>
                            </div>
                            <div class="sub-content-ticket-details">
                                <span class="ticket_detail-active" id-detail="<?php echo $key ?>" onclick="showDetail(this)">Chi tiết <i class="fa-solid fa-angle-right"></i></span>
                            </div>
                            <hr class="hr_ticket_line">
                            <hr class="hr_ticket_line">
                            <div class="ticket-price">
                                <span><?php echo $value['price'] ?> VND</span>
                                <div class="ticket-controls">
                                    <button class="decrease" data-price="320000"><i class="fa-solid fa-minus"></i></button>
                                    <span class="ticket-quantity">0</span>
                                    <button class="increase" data-price="320000"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <!-- <div class="img-ticket">
                    <div class="img-ticket-container">
                        <img src="<?php echo _HOST_PATH_ ?>\public\assets\clients\images\book_tickets_img\ticket_1-3.pngticket_1-3.png" alt="Ticket 1">
                    </div>
                </div> -->
            <!-- <div class="ticket">
                <img src="<?php echo _HOST_PATH_ ?>\public\assets\clients\images\book_tickets_img\ticket_up_13.png" alt="Ticket 2">
                <span id="ticketId" style="display: none;">2</span>
                <div class="ticket-details">
                    <div class="content-ticket">
                        <p><i class="fas fa-ticket-alt"></i>Vé tham quan khách cao trên 1,3m</p>
                    </div>
                    <div class="sub-content-ticket-details">
                        <span>Chi tiết <i class="fa-solid fa-angle-right"></i></span>
                    </div>
                    <hr class="hr_ticket_line">
                    <hr class="hr_ticket_line">
                    <div class="ticket-price">
                        <span>390,000 VND</span>
                        <div class="ticket-controls">
                            <button class="decrease" data-price="390000"><i class="fa-solid fa-minus"></i></button>
                            <span class="ticket-quantity">0</span>
                            <button class="increase" data-price="390000"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- end tiket-selection -->
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

<div class="modal-datepicker">
    <div class="home">
        <div class="home-caledar" style="position: relative;">
            <div class="title">
                <h3>Chọn ngày sử dụng</h3>
            </div>
            <div class="datepicker align" id="datepicker"></div>
            <div class="content">
                <p class="note">* Quý khách chú ý, ngày sử dụng không được thay đổi sau khi đã đặt vé, vé đã bán
                    không hoàn trả lại. Mọi thắc mắc vui lòng liên hệ với chúng tôi theo <b style="color: yellow">hotline 0985 355 861 hoặc 1900 066 808 bấm phím 1</b></p>
            </div>
            <div class="buy-tickets__by-date">
                <button class="btn-buy-tickets_by-date btn-select-date">Chọn ngày</button>
            </div>
            <div class="btn-close-calendar"
                style="
                    background-color: #fff;
                    padding: 4px;
                    height: 24px;
                    width: 24px;
                    position: absolute;
                    top: -55px;
                    right: -20px;
                    border-radius: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                "
            >
                <i style="width: 12px;" class="fa-solid fa-x"></i>
            </div>
        </div>
    </div>
</div>

<!-- end modal -->
<div class="modal-buy-tickets">
    <div class="modal-buy-tickets-container table-container">
        <div class="modal-header">
            <div class="modal-header__right">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>MUA VÉ</p>
            </div>
            <div class="modal-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <div class="list-table-container">
            <div class="title-table">
                <span class="content1">SẢN PHẨM/ DỊCH VỤ</span>
                <span class="content2">NGÀY SỬ DỤNG</span>
                <span class="content3">SỐ LƯỢNG</span>
            </div>
            <div class="line-buy-ticket"></div>

            <div class="list-ticket">
                <div class="line-ticket">
                    <span id="ticketId" style="display: none;"></span>
                    <div class="tickets-info">
                        Vé tham quan khách cao trên 1,3m
                    </div>
                    <!-- Day la noi hien thi time-->
                    <div class="date-tickets">
                        22/11/2024
                    </div>
                    <!-- Day la noi hien thi so luong -->
                    <div class="quantity-tickets">
                        <button class="decrease" data-price="320000"><i class="fa-solid fa-minus"></i>
                        </button>
                        <span class="ticket-quantity">0</span>
                        <button class="increase" data-price="320000"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <!-- Tổng tiền sẽ được hiển thị ở đây -->
                    <div class="total-price">
                        200,000
                    </div>
                    <!-- Xoa se hien thi o day -->
                    <div class="delete-ticket">
                        <i class="fa-solid fa-trash"></i>
                    </div>
                </div>
                <div class="line-list-tickets"></div>
            </div>
            <div class="modal-footer">
                <button class="modal-footer-success" id="confirm-button">
                    XÁC NHẬN
                </button>
            </div>
        </div>

    </div>
</div>

<!--  -->
<style>
    .overlay1 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: none;
    justify-content: center;
    align-items: center;
}
</style>
<div class="overlay1" id="overlay1"></div>
<?php
if (!empty($ticketList)) {
    foreach ($ticketList as $key => $value) {
?>
        <div class="ticket-detail-content" id-detail="<?php echo $key; ?>">
            <div class="detail_header">
                <i class="fas fa-ticket-alt"></i>
                <h3><?php echo $value['ticket_name'] ?></h3>
                <i class="fa-solid fa-xmark" onclick="hideDetail()"></i>
            </div>
            <p>
                Lưu ý: Khi tới Công viên, quý khách hàng sẽ được yêu cầu đo chiều cao tại thước đo Công viên để xác định các dịch vụ có thể sử dụng. <br>
                Trước khi tiến hành mua vé, quý khách vui lòng cập nhật các thông tin quan trọng tại <a href="https://baosonparadise.vn/huong-dan">https://baosonparadise.vn/huong-dan</a>
            </p>
            <p>Các trò chơi và dịch vụ giải trí có thể tham gia:</p>
            <p>
                <?php
                $condition = ' height_limit = 0 or ';
                if (str_contains($value['ticket_name'], '1m')) {
                    $condition .= 'height_limit = 1';
                } else {
                    $condition .= 'height_limit = 1.3';
                }
                $enterServiceModel = $this->model('EnterServicesModel');
                $detailTickets = $enterServiceModel->getAllEnterServicesWithCondition($condition);
                foreach ($detailTickets as $key1 => $value1) {
                    echo '- ' . $value1['enterservice_name'] . '<br>';
                }
                ?>
            </p>
        </div>
<?php
    }
}
?>