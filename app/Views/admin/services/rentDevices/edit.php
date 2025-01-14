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
    <h1 class="text-center w-100 text-primary">Sửa thông tin thiết bị, dụng cụ cho thuê</h1>
    <div class="mt-4 field-input d-flex justify-content-center align-items-center">
        <form action="<?php echo _HOST_PATH_ ?>/admin/Devices/postEditDevice/id=<?php echo $detailDevice['device_id'] ?>" method="post" class="w-50" enctype="multipart/form-data">
            <div class="d-flex justify-between mb-3">
                <div class="me-3" style="width: 70%;">
                    <label for="">Tên thiết bị</label>
                    <input required type="text" name="device_name" id="" class="form-control" placeholder="Nhập tên thiết bị"
                    value="<?php 
                        echo $detailDevice['device_name']
                    ?>">
                </div>
                <div style="width: 30%;">
                    <label for="">Số lượng</label>
                    <input required type="number" name="quantity" id="" class="form-control" placeholder="Nhập số lượng"
                    value="<?php 
                        echo $detailDevice['quantity']
                    ?>">
                </div>
            </div>
            <div class="d-flex justify-between mb-3">
                <div class="w-50 me-3">
                    <label for="">Giá thuê/giờ(VNĐ)</label>
                    <input required type="number" name="price_rent" id="" class="form-control" placeholder="Nhập giá thuê"
                    value="<?php 
                        echo $detailDevice['price_rent']
                    ?>">
                </div>
                <div class="w-50">
                    <label for="">Giá đền bú nếu hỏng/mất (VNĐ)</label>
                    <input required type="number" name="price_compensation" id="" class="form-control" placeholder="Nhập giá đền bù"
                    value="<?php 
                        echo $detailDevice['price_compensation']
                    ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="">Ảnh thiết bị</label>
                <input required type="file" name="device_image" id="" class="form-control">
                <img class="mt-3" style="width: 200px; transform: translateX(100%);" src="<?php echo _HOST_PATH_?>\public\assets\admin\images\devices\<?php echo $detailDevice['device_image'] ?>" alt="">
            </div>
            <div class="w-100 d-flex justify-content-center align-items-center mb-5">
                <button type="submit" class="w-100 mt-3 btn btn-primary py-2 fw-bold">Cập nhật</button>
            </div>
        </form>
    </div>
</div>