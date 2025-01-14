<?php
getSmg();
$old = getFlashData('old');
?>

<div class="wrapper">
    <form action="<?php echo _HOST_PATH_ ?>/auth/register/postRegister  " method="post" class="">
        <h1>Đăng ký</h1>
        <div class="input-box">
            <input type="text" id="display_name" name="display_name" placeholder="Họ và tên " required>
            <i class="fa-solid fa-face-grin-hearts"></i>
        </div>
        <div class="input-box">
            <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required value="<?php
                                                                                                            if (isset($old)) {
                                                                                                                echo $old['username'];
                                                                                                            }
                                                                                                            ?>">
            <i class='bx bxs-user'></i>
            <?php getErr('usernameRegisErr') ?>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required value="<?php
                                                                                                        if (isset($old)) {
                                                                                                            echo $old['password'];
                                                                                                        }
                                                                                                        ?>">
            <i class='bx bxs-lock' onclick="togglePass(this)"></i>
        </div>
        <div class="input-box">
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Nhập lại mật khẩu" required value="<?php
                                                                                                                                if (isset($old)) {
                                                                                                                                    echo $old['confirmPassword'];
                                                                                                                                }
                                                                                                                                ?>">
            <i class='bx bxs-lock' onclick="togglePass(this)"></i>
            <?php getErr('password') ?>
        </div>
        <div class="input-box">
            <input type="text" id="phone" name="phone" placeholder="Số điện thoại" required value="<?php
                                                                                                    if (isset($old)) {
                                                                                                        echo $old['phone'];
                                                                                                    }
                                                                                                    ?>">
            <i class='bx bxs-phone'></i>
            <?php getErr('phone') ?>
        </div>
        <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Email" required value="<?php
                                                                                            if (isset($old)) {
                                                                                                echo $old['email'];
                                                                                            }
                                                                                            ?>">
            <i class='bx bxs-envelope'></i>
            <?php getErr('email') ?>
        </div>
        <div class="input-box">
            <input type="text" id="cccd" name="id_number" placeholder="Số CMND/CCCD" required value="<?php
                                                                                                        if (isset($old)) {
                                                                                                            echo $old['id_number'];
                                                                                                        }
                                                                                                        ?>">
            <i class="fa-solid fa-id-card"></i>
            <?php getErr('id_number') ?>
        </div>
        <div class="input-box">
            <input type="text" id="address" name="address" placeholder="Địa chỉ" required value="<?php
                                                                                                    if (isset($old)) {
                                                                                                        echo $old['address'];
                                                                                                    }
                                                                                                    ?>">
            <i class="fa-solid fa-location-dot"></i>
        </div>
        <div class="input-box">
            <select name="country" id="country" class="py-0">
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
            </select>
            <i class="fa-solid fa-earth-asia"></i>
            <?php getErr('country') ?>
        </div>
        <div class="mb-2 d-flex align-items-start">
            <input <?php if(isset($old)) echo 'checked' ?> type="checkbox" id="acceptPolicy" style="margin-top: 5px; margin-right: 5px;" required>
            <label for="acceptPolicy">Tôi đồng ý với mọi điều khoản và dịch vụ của Công viên</label>
        </div>
        <input type="hidden" name="role" value="1">
        <button type="submit" class="btn btn-danger" name="">Đăng ký</button>
        <div class="register-link">
            <p>Đã có tài khoản ? <a href="<?php echo _HOST_PATH_ ?>/auth/login">Đăng nhập</a></p>
        </div>
    </form>
</div>