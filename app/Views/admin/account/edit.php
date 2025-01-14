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
        <form action="<?php echo _HOST_PATH_ ?>/admin/Account/postEditAccount/un=<?php echo $dataAcc['username'] ?>" method="post" class="w-50">
            <div class="mb-3">
                <h5>Thông tin đăng nhập</h5>
                <div class="mb-3">
                    <label for="">Tên đăng nhập</label>
                    <input required type="text" name="username" id="" class="form-control" placeholder="Nhập tên đăng nhập" value="<?php if(isset($old['username'])){echo $old['username'];}else{echo $dataAcc['username'];} ?>">
                    <?php getErr('usernameErr') ?>
                </div>
                <div class="mb-3">
                    <label for="">Mật khẩu</label>
                    <input required type="text" name="password" id="" class="form-control" placeholder="Nhập mật khẩu" value="<?php if(isset($old['password'])){echo $old['password'];}else{echo $dataAcc['pass_real'];} ?>">
                </div>
                <div class="mb-3">
                    <label for="">Nhập lại mật khẩu</label>
                    <input required type="text" name="confirmPassword" id="" class="form-control" placeholder="Nhập lại mật khẩu" value="<?php if(isset($old['confirmPassword'])){echo $old['confirmPassword'];}else{echo $dataAcc['pass_real'];} ?>">
                    <?php getErr('confirmPassword') ?>
                </div>
            </div>
            <div class="w-100 d-flex justify-content-center align-items-center">
                <button type="submit" class="w-100 mt-3 btn btn-primary py-2 fw-bold">Lưu</button>
            </div>
        </form>
    </div>
</div>