<?php
getSmg();
?>
<form class="mb-5" action="<?php echo _HOST_PATH_ ?>/admin/RentDevice/rentDevice" method="post">
    <div class="container" style="max-width: 100% !important; margin-top: 1.5rem !important;">
        <h2 class="text-center w-100 text-primary mb-3">Thông tin thuê thiết bị, dụng cụ</h2>
        <div class="row" style="max-width: 100% !important;">
            <div class="col-7 m-auto">
                <h4 class="ms-3 text-secondary">Thông tin cá nhân</h4>
                <div class="ms-3 mb-3 d-flex align-items-center">
                    <label style="width: 25%;" class="fw-bold" for="">Tên người thuê</label>
                    <input style="flex: 1;" required type="text" name="rent_name" id="" class="ms-2 form-control" placeholder="Nhập tên người thuê">
                </div>
                <div class="ms-3 mb-3 d-flex align-items-center">
                    <label style="width: 25%;" class="fw-bold" for="">Số điện thoại</label>
                    <input style="flex: 1;" required type="number" name="rent_phone" id="" class="ms-2 form-control" placeholder="Nhập số điện thoại">
                </div>
                <div class="ms-3 mb-3 d-flex align-items-center">
                    <label style="width: 25%;" class="fw-bold" for="">CMND/CCCD</label>
                    <input style="flex: 1;" required type="text" name="rent_id_number" id="" class="ms-2 form-control" placeholder="Nhập CMND/CCCD">
                </div>
                <div class="ms-3 mb-3 d-flex align-items-center">
                    <label style="width: 25%;" class="fw-bold" for="">Địa chỉ</label>
                    <input style="flex: 1;" required type="text" name="rent_address" id="" class="ms-2 form-control" placeholder="Nhập địa chỉ">
                </div>
            </div>
        </div>
        <div class="row" style="max-width: 100% !important;">
            <div class="col-7 m-auto">
                <h4 class="ms-3 text-secondary">Đồ thuê</h4>
                <div class="ms-3"><?php getErr('quantity_rent') ?></div>
                <table class="table table-bordered text-center table-striped border-primary w-100 ms-3 mt-3">
                    <thead class="table-primary fw-bold">
                        <td>Tên thiết bị</td>
                        <td>Giá thuê</td>
                        <td>Giá đền bù</td>
                        <td>Kho</td>
                        <td width="20%">Số lượng thuê</td>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($devicesList)) {
                            foreach ($devicesList as $key => $value) {
                        ?>
                                <tr>
                                    <td><?php echo $value['device_name'] ?></td>
                                    <td><?php echo $value['price_rent'] ?></td>
                                    <td><?php echo $value['price_compensation'] ?></td>
                                    <td><?php echo $value['quantity'] ?></td>
                                    <td><input type="number" name="quantity_rent-<?php echo $value['device_id']; ?>" id="" class="form-control"></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <td colspan="5" class="text-center text-danger">Không còn thiết bị, dụng cụ để thuê</td>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="max-width: 100% !important;">
            <div class="col-7 m-auto d-flex justify-content-end pe-0">
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</form>