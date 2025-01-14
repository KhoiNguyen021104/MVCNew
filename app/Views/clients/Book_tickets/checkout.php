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
            <div class="progress-step active" id="step3">
                <a href="#">
                    <div class="step-label active">Thanh toán</div>
                    <i class="fas fa-credit-card step-icon active"></i>
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
    <div class="banner_checkout">
        <div class="top-bar_checkout">
            <p>Thời gian thanh toán của bạn sẽ hết hạn trong <span id="timer">10:00</span></p>
        </div>

        <div class="container_checkout">
            <div class="text-date">
                <h1>THIÊN ĐƯỜNG BẢO SƠN - NGÀY SỬ DỤNG : <span id="ticket-date_checkout">19/6/2024</span></h1>
            </div>
            <div class="sub-container_checkout">
                <div class="form-container_checkout">
                    <div class="customer-info_checkout">
                        <div class="sub-customer-info_checkout">
                            <h2>THÔNG TIN KHÁCH HÀNG</h2>
                            <div class="line_checkout"></div>
                            <form id="registrationForm" action="#">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="fullName">Họ Tên <span style="color: red">*</span></label>
                                        <input disabled type="text" id="fullName" name="full_name" value="<?php echo $userInfo[0]['name'] ?>">
                                        <div class="error-message" id="fullNameError">Vui lòng nhập họ tên.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số Điện Thoại <span style="color: red">*</span></label>
                                        <input disabled type="text" id="phone" name="phone" value="<?php echo $userInfo[0]['phone'] ?>">
                                        <div class="error-message" id="phoneError">Vui lòng nhập số điện thoại hợp
                                            lệ.</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input disabled type="email" id="email" name="email" value="<?php echo $userInfo[0]['email'] ?>">
                                        <div class="error-message" id="emailError">Vui lòng nhập email hợp lệ.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Quốc Gia</label>
                                        <select id="country" name="country">
                                            <option class="option-content1" value="">Chọn quốc gia</option>
                                            <?php
                                            $countryModel = $this->model('CountryModel');
                                            $countries = $countryModel->getAllCountry();
                                            foreach ($countries as $key => $value) {
                                            ?>
                                                <option <?php if (trim($value['countryName']) == trim($userInfo[0]['country'])) echo 'selected' ?> value="<?php echo $value['countryName'] ?>"><?php echo $value['countryName'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="address">Địa Chỉ</label>
                                        <input disabled type="text" id="address" name="address" value="<?php echo $userInfo[0]['address'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="idNumber">Số CMND</label>
                                        <input disabled type="text" id="idNumber" name="idNumber" value="<?php echo $userInfo[0]['id_number'] ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="payment-info_checkout">
                        <div class="sub-payment-info_checkout">
                            <h2>HÌNH THỨC THANH TOÁN</h2>
                            <div class="line_checkout_checkout"></div>
                            <div class="payment-method_checkout">
                                <div class="form-visa">
                                    <input type="radio" id="visa" name="payment" value="visa" checked>
                                    <img src="assets/img/visa.png" alt="">
                                    <label for="visa">Thẻ quốc tế</label>
                                </div>
                                <div class="line2_checkout"></div>
                                <div class="form-domestic">
                                    <input type="radio" id="domestic" name="payment" value="domestic">
                                    <img src="assets/img/atm.png" alt="">
                                    <label for="domestic">Thẻ/Tài khoản ngân hàng nội địa</label>
                                </div>
                                <div class="line2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-summary">
                    <div class="sub-order-summary">
                        <h2>ĐƠN HÀNG</h2>
                        <div class="order-details">
                            <span id="ticketId" style="display: none;"></span>
                            <p>Ngày sử dụng: <span class="order-date" id="order-date">21/06/2024</span></p>
                            <div class="list-order-item">
                                <div class="order-item-line">
                                    <div class="line2_checkout"></div>
                                    <div class="order-item">
                                        <div class="item-description">
                                            <p>VÉ THAM QUAN KHÁCH CAO TRÊN 1,3M</p>
                                        </div>
                                        <div class="item-price">
                                            <p>390,000 VND</p>
                                            <p>x1</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line2_checkout"></div>
                            <div class="order-summary-details">
                                <div class="summary-row">
                                    <span>THÀNH TIỀN</span>
                                    <span id="subtotal">390,000 VND</span>
                                </div>
                                <div class="summary-row">
                                    <span>GIẢM GIÁ</span>
                                    <span id="discount">0 VND</span>
                                </div>
                                <div class="summary-row total">
                                    <span>TỔNG TIỀN</span>
                                    <span id="total-price">390,000 VND</span>
                                </div>
                                <p class="vat-included">(Đã bao gồm VAT)</p>
                            </div>
                            <!-- <div class="coupon-section">
                                <input type="text" placeholder="MÃ KHUYẾN MẠI" class="coupon-input">
                                <button class="apply-button">ÁP DỤNG</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="order-actions">
                        <button class="back-button"></button>
                        <button class="checkout-button" id="confirm-btn-checkout">THANH TOÁN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="content-footer">
            <p>Copyright © 2023 baosonparadise.vn - Bản quyền website thuộc về CÔNG TY TNHH MỘT THÀNH VIÊN DU LỊCH
                GIẢI TRÍ THIÊN ĐƯỜNG BẢO SƠN</p>
        </div>
    </div>
</div>

<form method="post" action="<?php echo _HOST_PATH_ ?>\clients\SendMailBooking" class="modal-confirm-btn-checkout">
    <div class="modal-buy-checkout">
        <div class="modal-header">
            <div class="modal-header__right">
                <i class="fa-regular fa-file-lines"></i>
                <p>ĐIỀU KHOẢN DỊCH VỤ</p>
            </div>
            <div class="modal-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="list-table-container">
            <div class="notification">
                <p>Quý vị vui lòng xác nhận thông tin bên dưới đã chính xác, vì <b style="color: red; font-weight: 700;"> MÃ ĐẶT
                        VÉ</b>
                    sẽ được hệ thống gửi tới
                    <b style="color: red; font-weight: 500;"> email</b> quý vị cung cấp.
                </p>
            </div>

            <div class="tickets-info-checkout">
                <p><b>Họ tên: </b><span id="info-fullname-checkout">Hoàng Văn Vũ</span></p>
                <p><b>Số điện thoại: </b><span id="info-number-checkout">0565097603</span></p>
                <p><b>Email: </b><span id="info-email-checkout">vusun2k2004@gmail.com</span></p>
                <input type="hidden" name="mailCustomer" value="" id="mailCustomer">
            </div>

            <hr class="hr_ticket_line">
            <div class="modal-footer">
                <button type="submit" class="modal-footer-success" id="btn-to-email-checkout">
                    XÁC NHẬN
                </button>
            </div>
        </div>
    </div>
</form>