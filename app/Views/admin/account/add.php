<div class="container w-70 mt-0" style="max-width: 100% !important; margin-bottom: 72px !important;">
    <?php
    $this->render('blocks/admin/navbar');
    ?>
    <div class="handel-field m-3">
        <a href="<?php echo _HOST_PATH_ ?>/admin/Account" class="me-1 px-3 fw-bold text-light btn btn-danger">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
    </div>
    <?php
    getSmg();
    $old = getFlashData('old');
    ?>
    <div class="mt-4 field-input d-flex justify-content-center align-items-center">
        <form action="<?php echo _HOST_PATH_ ?>/admin/Account/postAddAccount" method="post" class="w-50">
            <div class="mb-3">
                <h5>Thông tin đăng nhập</h5>
                <div class="mb-3">
                    <label for="">Tên đăng nhập</label>
                    <input required type="text" name="username" id="" class="form-control" placeholder="Nhập tên đăng nhập" value="<?php echo (isset($old['username']) ? $old['username'] : '') ?>">
                    <?php getErr('usernameErr') ?>
                </div>
                <div class="mb-3">
                    <label for="">Mật khẩu</label>
                    <input required type="password" name="password" id="" class="form-control" placeholder="Nhập mật khẩu" value="<?php echo (isset($old['password']) ? $old['password'] : '') ?>">
                </div>
                <div class="mb-3">
                    <label for="">Nhập lại mật khẩu</label>
                    <input required type="password" name="confirmPassword" id="" class="form-control" placeholder="Nhập lại mật khẩu" value="<?php echo (isset($old['confirmPassword']) ? $old['confirmPassword'] : '') ?>">
                    <?php
                    getErr('confirmPassword');
                    ?>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <h5>Thông tin cá nhân</h5>
                <div class="mb-3 d-flex">
                    <div class="me-3" style="flex: 1;">
                        <label for="">Họ tên</label>
                        <input required type="text" name="name" id="" class="form-control" placeholder="Nhập họ tên" value="<?php echo (isset($old['name']) ? $old['name'] : '') ?>">
                    </div>
                    <div style="width: 40%;">
                        <label for="">Phân quyền</label>
                        <select name="role" id="" class="form-control">
                            <option class="text-center" value="">--- Chọn quyền ---</option>
                            <option class="text-center" value="0">Admin</option>
                            <option class="text-center" value="1">Khách hàng</option>
                        </select>
                        <?php getErr('role') ?>
                    </div>
                </div>
                <div class="mb-3 d-flex">
                    <div class="w-50 me-3">
                        <label for="">Email</label>
                        <input required type="email" name="email" id="" class="form-control" placeholder="Nhập email" value="<?php echo (isset($old['email']) ? $old['email'] : '') ?>">
                        <?php getErr('email') ?>
                    </div>
                    <div class="w-50">
                        <label for="">Số điện thoại</label>
                        <input required type="number" name="phone" id="" class="form-control" placeholder="Nhập số điện thoại" value="<?php echo (isset($old['phone']) ? $old['phone'] : '') ?>">
                        <?php getErr('phone') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Quốc tịch</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">Chọn quốc tịch</option>
                        <?php
                        $countryModel = $this->model('CountryModel');
                        $countries = $countryModel->getAllCountry();
                        foreach ($countries as $key => $value) {
                        ?>
                            <option <?php if (isset($old['country'])) {
                                        if ($old['country'] == $value['countryName']) echo 'selected';
                                    } ?> value="<?php echo $value['countryName'] ?>"><?php echo $value['countryName'] ?></option>
                        <?php
                        }
                        ?>
                        <!--  -->
                    </select>
                    <?php getErr('country') ?>
                </div>
                <div class="mb-3">
                    <label for="">Địa chỉ</label>
                    <input required type="text" name="address" id="" class="form-control" placeholder="Nhập địa chỉ" value="<?php echo (isset($old['address']) ? $old['address'] : '') ?>">
                </div>
                <div class="mb-3">
                    <label for="">CMND/CCCD</label>
                    <input required type="number" name="id_number" id="" class="form-control" placeholder="Nhập số CCCD/CMND" value="<?php echo (isset($old['id_number']) ? $old['id_number'] : '') ?>">
                    <?php getErr('id_number') ?>
                </div>
            </div>

            <div class="w-100 d-flex justify-content-center align-items-center">
                <button type="submit" class="w-100 mt-3 btn btn-primary py-2 fw-bold">Xác nhận thêm</button>
            </div>
        </form>
    </div>
</div>