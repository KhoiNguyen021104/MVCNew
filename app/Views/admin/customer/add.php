<div class="container w-70 mt-0" style="max-width: 100% !important;">
    <?php
    $this->render('blocks/admin/navbar');
    ?>
    <div class="handel-field m-3">
        <a href="<?php echo _HOST_PATH_ ?>/admin/Customer/" class="me-1 px-3 fw-bold text-light btn btn-danger">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
    </div>
    <?php
    getSmg();
    $old = getFlashData('old')
    ?>
    <div class="mt-4 field-input d-flex justify-content-center align-items-center">
        <form action="<?php echo _HOST_PATH_ ?>/admin/Customer/postAddCustomer" method="post" class="w-50">
            <div class="mb-3">
                <label for="">Tên khách hàng</label>
                <input required type="text" name="name" id="" class="form-control" placeholder="Nhập tên khách hàng" value="<?php echo (isset($old['name']) ? $old['name'] : '') ?>">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input required type="email" name="email" id="" class="form-control" placeholder="Nhập email" value="<?php echo (isset($old['email']) ? $old['email'] : '') ?>">
            </div>
            <div class="mb-3">
                <label for="">Số điện thoại</label>
                <input required type="number" name="phone" id="" class="form-control" placeholder="Nhập số điện thoại" value="<?php echo (isset($old['phone']) ? $old['phone'] : '') ?>"">
            <?php getErr('phone') ?>
            </div>
            <div class=" mb-3">
                <label for="">Quốc gia</label>
                <select name="country" id="country" class="form-control">
                    <option value="">Chọn quốc gia</option>
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
                </select>
                <?php
                getErr('country');
                ?>
            </div>
            <div class="mb-3">
                <label for="">CCCD</label>
                <input required type="number" name="id_number" id="" class="form-control" placeholder="Nhập số CCCD" value="<?php echo (isset($old['id_number']) ? $old['id_number'] : '') ?>">
                <?php getErr('id_number') ?>
            </div>
            <div class="mb-3">
                <label for="">Địa chỉ</label>
                <input required type="text" name="address" id="" class="form-control" placeholder="Nhập địa chỉ" value="<?php echo (isset($old['address']) ? $old['address'] : '') ?>">
            </div>

            <div class="w-100 d-flex justify-content-center align-items-center">
                <button type="submit" class="w-100 mt-3 btn btn-primary py-2 fw-bold">Xác nhận thêm</button>
            </div>
        </form>
    </div>
</div>