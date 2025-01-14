<div class="overlay" id="overlay"></div>

<div class="container mt-0" style="max-width: 100% !important;">
    <?php
    getSmg();
    ?>
    <h4 class="mt-3 text-secondary fw-bold ms-3">Thông tin cá nhân người thuê</h4>
    <div class="personal-info ms-3 fw-bold">
        <p>Họ tên người thuê: <?php echo $slip[0]['rent_name'] ?></p>
        <p>Số điện thoại: <?php echo $slip[0]['rent_phone'] ?></p>
        <p>CMND/CCCD: <?php echo $slip[0]['rent_id_number'] ?></p>
        <p>Địa chỉ: <?php echo $slip[0]['rent_address'] ?></p>
    </div>
    <table class="mt-3 table table-bordered text-center table-striped border-primary">
        <thead class="table-primary">
            <th>STT</th>
            <th>Tên thiết bị</th>
            <th>Số lượng</th>
            <th>Đơn giá (/giờ)</th>
            <th>Thời điểm thuê</th>
            <th>Thời điểm trả đồ</th>
            <th>Thành Tiền (VNĐ)</th>
        </thead>

        <tbody>
            <tr>
                <?php
                if (!empty($slip)) {
                    $total = 0;
                    foreach ($slip as $key => $value) {
                ?>
            <tr>
                <td><?php echo ($key + 1) ?></td>
                <td><?php echo $value['device_name'] ?></td>
                <td><?php echo $value['quantity_rent'] ?></td>
                <td><?php echo $value['price_rent'] ?></td>
                <td><?php echo $value['time_rent'] ?></td>
                <td><?php echo date("Y-m-d H:i:s") ?></td>
                <td><?php
                        $timeReturn = date("Y-m-d H:i:s");
                        $date1 = new DateTime($value['time_rent']);
                        $date2 = new DateTime($timeReturn);
                        $interval = $date1->diff($date2);
                        $hoursDifference = $interval->h + ($interval->i / 60) + ($interval->s / 3600);
                        echo number_format(($value['quantity_rent'] * $value['price_rent'] * $hoursDifference), 0, '.', ',');
                        $total += $value['quantity_rent'] * $value['price_rent'] * $hoursDifference;
                    ?>
                </td>
            </tr>
        <?php
                    }
        ?>
        <tr>
            <td colspan="6" class="fw-bold">Tổng tiền: </td>
            <td><?php echo number_format($total, 0, '.', ',') ?></td>
        </tr>
    <?php
                } else {
    ?>
        <tr>
            <td colspan="11" class="text-danger">Không có khách hàng thuê đồ</td>
        </tr>
    <?php
                }
    ?>
        </tbody>
    </table>
    <a href="<?php echo _HOST_PATH_ ?>/admin\RentDevice\handleRentReturn\id=<?php echo $slip[0]['rental_slip_id'] ?>" class="btn btn-primary">Thanh toán</a>
</div>