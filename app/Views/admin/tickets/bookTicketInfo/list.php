<div class="overlay" id="overlay"></div>
<div class="container mt-0" style="max-width: 100% !important;">
    <?php
    getSmg();
    ?>
</div>

<form action="<?php echo _HOST_PATH_ ?>/admin/BookTicketInfo/" method="post" class="">
    <div class="action d-flex align-items-center ms-3 mb-3">
        <div class="input-group w-50">
            <input type="search" name="booking_id" id="" class="form-control" placeholder="Nhập mã hóa đơn để tìm kiếm...">
            <button class="btn btn-primary" type="submit">
                <i style="cursor: pointer; height: 100%;" class="btn btn-primary d-flex input-group-text fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <a href="<?php echo _HOST_PATH_ ?>/admin/BookTicketInfo/" class="ms-3 px-3 py-2 fw-bold text-light btn btn-danger">
            <i class="fa-solid fa-rotate-left"></i>
            Reset
        </a>
    </div>
    <!-- Filter search -->
</form>

<table class="table table-bordered text-center table-striped border-primary">
    <thead class="table-primary">
        <th width="3%">STT</th>
        <th>Mã hóa đơn</th>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Ngày đặt</th>
        <th>Ngày sử dụng</th>
        <th>Tổng giá (VNĐ)</th>
        <th width="15%">Trạng thái thanh toán</th>
        <th width="5%">Xem</th>
        <th width="5%">Xoá</th>
    </thead>

    <tbody>
        <tr>
            <?php
            if (!empty($bookingList)) {
                foreach ($bookingList as $key => $value) {
            ?>
        <tr>
            <td><?php echo ($key + 1) ?></td>
            <td><?php echo 'HDTDBS-' . $value['booking_id'] ?></td>
            <td><?php echo $value['name'] ?></td>
            <td><?php echo $value['email'] ?></td>
            <td><?php echo $value['phone'] ?></td>
            <td><?php echo $value['booking_date'] ?></td>
            <td><?php echo $value['date_of_use'] ?></td>
            <td><?php echo number_format($value['total_price'], 0, ",", ".") ?></td>
            <td>
                <?php
                    $type = 'danger';
                    if ($value['payment_status'] == 1)
                        $type = 'primary';
                ?>
                <span class="fw-bold w-100 btn btn-<?php echo $type ?>">
                    <?php echo ($value['payment_status'] == 1) ? "Đã thanh toán" : "Chưa thanh toán" ?>
                </span>
            </td>
            <td>
                <a href="<?php echo _HOST_PATH_ ?>/admin/BookTicketInfo/getDetailBookTicketInfo/id=<?php echo $value['booking_id'] ?>">
                    <i class="btn btn-success fa-solid fa-eye"></i>
                </a>
            </td>
            <td>
                <a href="<?php echo _HOST_PATH_ ?>/admin/BookTicketInfo/handleDeleteBookTicketInfo/id=<?php echo $value['booking_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                    <i class="btn btn-danger fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php
                }
            } else {
    ?>
    <tr>
        <td colspan="11" class="text-primary">Không có đơn đặt vé</td>
    </tr>
<?php
            }
?>
    </tbody>
</table>