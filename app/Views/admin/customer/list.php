<div class="overlay" id="overlay"></div>

<div class="container w-70 mt-0" style="max-width: 100% !important;">
    <?php
    $this->render('blocks/admin/navbar');
    ?>
    <?php
    getSmg();
    ?>
    <form action="<?php echo _HOST_PATH_ ?>/admin/Customer/" method="post" class="">
        <div class="action d-flex align-items-center">
            <a href="<?php echo _HOST_PATH_ ?>/admin/Customer/getAddCustomer" class="btn btn-success m-3 py-2">
                <i class="fa-solid fa-plus"></i>
                <span class="text-center fw-bold">Thêm khách hàng</span>
            </a>

            <div class="input-group w-50">
                <input type="search" name="name" id="" class="form-control" placeholder="Nhập tên khách hàng để tìm kiếm...">
                <button class="btn btn-primary" type="submit">
                    <i style="cursor: pointer; height: 100%;" class="btn btn-primary d-flex input-group-text fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <a href="<?php echo _HOST_PATH_ ?>/admin/Customer/" class="ms-3 px-3 py-2 fw-bold text-light btn btn-danger">
                <i class="fa-solid fa-rotate-left"></i>
                Reset
            </a>
        </div>
    <table class="table table-bordered text-center table-striped border-primary">
        <thead class="table-primary">
            <th width="4%">STT</th>
            <th width="15%">Tên khách hàng</th>
            <th width="20%">Email</th>
            <th width="12%">Số điện thoại</th>
            <th width="10%">Quốc gia</th>
            <th width="12%">CCCD</th>
            <th width="20%">Địa chỉ</th>
            <th width="5%">Sửa</th>
            <th width="5%">Xóa</th>
        </thead>
        <tbody>
            <?php
            if (!empty($listCustomer)) {
                foreach ($listCustomer as $key => $value) {
            ?>
                    <tr>
                        <td><?php echo ($key + 1) ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td><?php echo $value['phone'] ?></td>
                        <td><?php echo $value['country'] ?></td>
                        <td><?php echo $value['id_number'] ?></td>
                        <td><?php echo $value['address'] ?></td>
                        <td>
                            <a href="<?php echo _HOST_PATH_ ?>/admin/Customer/getEditCustomer/id=<?php echo $value['user_id'] ?>">
                                <i class="btn btn-warning fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <a id_delete="<?php echo $value['user_id'] ?>" class="btnDel" onclick="showDialog(this,'<?php echo _HOST_PATH_ ?>/admin/Customer/handleDeleteCustomer/id=<?php echo $value['user_id'] ?>')">
                                <i class="btn btn-danger fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="8" class="text-primary">Không có khách hàng</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>