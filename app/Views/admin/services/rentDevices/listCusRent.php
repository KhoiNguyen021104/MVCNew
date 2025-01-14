<div class="overlay" id="overlay"></div>

<div class="container mt-0" style="max-width: 100% !important;">
    <?php
    getSmg();
    ?>
</div>
<form action="<?php echo _HOST_PATH_ ?>/admin/RentDevice/getCusRent" method="post" class="">
    <div class="action d-flex align-items-center mb-3">
        <div class="input-group w-50 ms-3">
            <input type="search" name="rent_name" id="" class="form-control" placeholder="Nhập tên khách hàng để tìm kiếm...">
            <button class="btn btn-primary" type="submit">
                <i style="cursor: pointer; height: 100%;" class="btn btn-primary d-flex input-group-text fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <a href="<?php echo _HOST_PATH_ ?>/admin/RentDevice/getCusRent" class="ms-3 me-1 px-3 py-2 fw-bold text-light btn btn-danger">
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
        <th>Họ tên</th>
        <th>Số điện thoại</th>
        <th>CMND/CCCD</th>
        <th>Địa chỉ</th>
        <th>Thời gian thuê</th>
        <th>Thời gian trả</th>
        <th>Tiền thuê (VNĐ)</th>
        <th>Trạng thái</th>
        <th>Trả đồ</th>
    </thead>

    <tbody>
        <tr>
            <?php
            if (!empty($cusRentList)) {
                foreach ($cusRentList as $key => $value) {
            ?>
        <tr>
            <td><?php echo ($key + 1) ?></td>
            <td><?php echo $value['rent_name'] ?></td>
            <td><?php echo $value['rent_phone'] ?></td>
            <td><?php echo $value['rent_id_number'] ?></td>
            <td><?php echo $value['rent_address'] ?></td>
            <td><?php echo $value['time_rent'] ?></td>
            <td><?php echo $value['time_return'] ?></td>
            <td><?php echo $value['total_rent_price'] ?></td>
            <td class="fw-bold <?php echo ($value['rent_status'] == 0 ? 'text-danger' : 'text-primary') ?>"><?php echo ($value['rent_status'] == 0 ? 'Chưa trả' : 'Đã trả') ?></td>
            <td>
                <a href="<?php echo _HOST_PATH_ ?>/admin/RentDevice/getBillRent/id=<?php echo $value['rental_slip_id'] ?>">
                    <i class="btn btn-success fa-solid fa-rotate-left"></i>
                </a>
            </td>
        </tr>
    <?php
                }
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
</div>