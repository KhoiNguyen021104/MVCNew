<div class="overlay" id="overlay"></div>

<div class="container mt-0" style="max-width: 100% !important;">
    <?php
    getSmg();
    ?>
</div>
<form action="<?php echo _HOST_PATH_ ?>/admin/Devices/" method="post" class="">
    <div class="action d-flex align-items-center mb-3">
        <a href="<?php echo _HOST_PATH_ ?>/admin/Devices/getAddDevice" class="btn btn-success m-3 py-2">
            <i class="fa-solid fa-plus"></i>
            <span class="text-center fw-bold">Thêm</span>
        </a>
        <div class="input-group w-50">
            <input type="search" name="device_name" id="" class="form-control" placeholder="Nhập tên thiết bị để tìm kiếm...">
            <button class="btn btn-primary" type="submit">
                <i style="cursor: pointer; height: 100%;" class="btn btn-primary d-flex input-group-text fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <a href="<?php echo _HOST_PATH_ ?>/admin\Devices" class="ms-3 me-1 px-3 py-2 fw-bold text-light btn btn-danger">
            <i class="fa-solid fa-rotate-left"></i>
            Reset
        </a>
    </div>
    <div class="mb-3">
        
    </div>
</form>

<table class="table table-bordered text-center table-striped border-primary">
    <thead class="table-primary">
        <th width="3%">STT</th>
        <th>Ảnh</th>
        <th>Tên thiết bị</th>
        <th>Giá thuê/giờ (VNĐ)</th>
        <th>Tiền đền bù (VNĐ)</th>
        <th>Số lượng</th>
        <th>Đã thuê</th>
        <th>Kho</th>
        <th width="5%">Sửa</th>
        <th width="5%">Xóa</th>
    </thead>

    <tbody>
        <tr>
            <?php
            if (!empty($devicesList)) {
                foreach ($devicesList as $key => $value) {
            ?>
        <tr>
            <td><?php echo ($key + 1) ?></td>
            <td><img width="100px" src="<?php echo _HOST_PATH_?>\public\assets\admin\images\devices\<?php echo $value['device_image'] ?>" alt=""></td>
            <td><?php echo $value['device_name'] ?></td>
            <td><?php echo $value['price_rent'] ?></td>
            <td><?php echo $value['price_compensation'] ?></td>
            <td><?php echo $value['quantity'] ?></td>
            <td><?php echo $value['quantity_rented']?></td>
            <td><?php 
                echo $value['quantity'] - $value['quantity_rented'];
            ?></td>
            <td>
                <a href="<?php echo _HOST_PATH_ ?>/admin/Devices/getEditDevices/id=<?php echo $value['device_id'] ?>">
                    <i class="btn btn-warning fa-solid fa-pen-to-square"></i>
                </a>
            </td>
            <td>
                <a id_delete="<?php echo $value['device_id'] ?>" class="btnDel" onclick="showDialog(this,'<?php echo _HOST_PATH_ ?>/admin/Devices/handleDeleteDevice/id=<?php echo $value['device_id'] ?>')">
                    <i class="btn btn-danger fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php
                }
            } else {
    ?>
    <tr>
        <td colspan="11" class="text-danger">Không có thiết bị cho thuê</td>
    </tr>
<?php
            }
?>
    </tbody>
</table>
</div>