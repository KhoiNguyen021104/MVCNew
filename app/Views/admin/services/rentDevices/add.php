<div class="container mt-0" style="max-width: 100% !important;">
    <?php
    $this->render('blocks/admin/navbar');
    ?>
    <div class="handel-field m-3">
        <a href="<?php echo _HOST_PATH_ ?>/admin/Devices" class="me-1 px-3 fw-bold text-light btn btn-danger">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
    </div>
    <?php
    getSmg();
    ?>
    <div class="mt-4 field-input d-flex justify-content-center align-items-center">
        <form action="<?php echo _HOST_PATH_ ?>/admin/Devices/postAddDevice" method="post" class="w-50" enctype="multipart/form-data">
            <div class="d-flex justify-between mb-3">
                <div style="width: 70%;" class="me-3">
                    <label for="">Tên đồ</label>
                    <input required type="text" name="device_name" id="" class="form-control" placeholder="Nhập tên đồ">
                </div>
                <div style="width: 30%;">
                    <label for="">Số lượng</label>
                    <input required type="number" name="quantity" id="" class="form-control" placeholder="Nhập số lượng">
                </div>
            </div>
            <div class="d-flex justify-between mb-3">
                <div class="w-50 me-3">
                    <label for="">Giá thuê/giờ(VNĐ)</label>
                    <input required type="text" name="price_rent" id="" class="form-control" placeholder="Nhập giá thuê">
                    <?php getErr('price_rent') ?>
                </div>
                <div class="w-50">
                    <label for="">Giá đền bú nếu hỏng/mất (VNĐ)</label>
                    <input required type="text" name="price_compensation" id="" class="form-control" placeholder="Nhập giá đền bù">
                    <?php getErr('price_compensation') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Ảnh thiết bị</label>
                <input required type="file" name="device_image" id="" class="form-control">

            </div>
            <div class="w-100 d-flex justify-content-center align-items-center mb-5">
                <button type="submit" class="w-100 mt-3 btn btn-primary py-2 fw-bold">Thêm thiết bị</button>
            </div>
        </form>
    </div>
</div>