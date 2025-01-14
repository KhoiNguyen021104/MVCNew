<div class="wrapper">
    <?php $this->render('blocks\clients\headerBooking'); ?>
    <!-- end header  -->

    <div class="orientation">
        <div class="progress-bar">
            <div class="line"></div>
            <div class="line2"></div>
            <div class="progress-step active" id="step1">
                <a href="<?php echo _HOST_PATH_ ?>/clients/BookTickets">
                    <div class="step-label active">Thiên đường bảo sơn</div>
                    <i class="fas fa-map-marker-alt step-icon active"></i>
                </a>
            </div>
            <div class="progress-step" id="step2">
                <a href="#">
                    <div class="step-label">Chọn vé</div>
                    <i class="fas fa-ticket-alt step-icon"></i>
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

    <div class="banner" style="background-image: url('<?php echo _HOST_PATH_ ?>/public/assets/clients/images/book_tickets_img/img_ticket.png');">
        <div class="home">
            <div class="home-caledar">
                <div class="title">
                    <h3>Chọn ngày sử dụng</h3>
                </div>
                <div class="datepicker align" id="datepicker"></div>
                <div class="content">
                    <p class="note">* Quý khách chú ý, ngày sử dụng không được thay đổi sau khi đã đặt vé, vé đã bán
                        không hoàn trả lại. Mọi thắc mắc vui lòng liên hệ với chúng tôi theo <b style="color: yellow">hotline 0985 355 861 hoặc 1900 066 808 bấm phím 1</b></p>
                </div>
                <div class="buy-tickets__by-date">
                    <button id="buy-ticket" class="btn-buy-tickets_by-date">Mua vé</button>
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