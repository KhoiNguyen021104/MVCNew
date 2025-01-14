<?php
// test: booking_date => date_of_use
$dataChart = [];
foreach ($revenue as $key => $value) {
    // echo '<pre>';
    // print_r($value);
    // echo '</pre>';
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'total_price') {
            $dataChart[$key][$key1] = $value1;
        }
        if ($key1 == 'date_of_use') {
            if (isset(explode("/", $value1)[1])) {
                $month = explode("/", $value1)[1];
            } else {
                $month = explode("-", $value1)[1];
            }
            $month = (int) $month;
            $dataChart[$key][$key1] = $month;
            $year = explode("-", $value1)[0];
            $year = (int) $year;
            $dataChart[$key]['year'] = $year;
        }
    }
}
for ($i = 0; $i < count($dataChart); $i++) {
    for ($j = $i + 1; $j < count($dataChart); $j++) {
        if (
            $dataChart[$i]['date_of_use'] == $dataChart[$j]['date_of_use']
            && $dataChart[$i]['year'] == $dataChart[$j]['year']
        ) {
            $dataChart[$i]['total_price'] += $dataChart[$j]['total_price'];
            array_splice($dataChart, $j, 1);
            $j = $i;
        }
    }
}

$dataChartYear = [];
foreach ($revenueYear as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'total_price') {
            $dataChartYear[$key][$key1] = $value1;
        }
        if ($key1 == 'date_of_use') {
            $year = explode("-", $value1)[0];
            $year = (int) $year;
            $dataChartYear[$key]['year'] = $year;
        }
    }
}
// echo '<pre>';
// print_r($dataChartYear);
// echo '</pre>';
for ($i = 0; $i < count($dataChartYear); $i++) {
    for ($j = $i + 1; $j < count($dataChartYear); $j++) {
        if ($dataChartYear[$i]['year'] == $dataChartYear[$j]['year']) {
            $dataChartYear[$i]['total_price'] += $dataChartYear[$j]['total_price'];
            array_splice($dataChartYear, $j, 1);
            $j = $i;
        }
    }
}

?>
<?php
$old = getFlashData('old');
$yearSta = 2024;
?>
<form action="<?php echo _HOST_PATH_ ?>/admin/Statistics/" method="post" class="mb-3 mt-3 ms-3">
    <h4>Thời gian thống kê</h4>
    <div class="mb-3 d-flex w-50">
        <div class="timeSta w-50 me-3"">
            <label for=" date_of_use">Ngày bắt đầu</label>
            <input value="<?php if (isset($old['dateStart'])) {
                                echo $old['dateStart'];
                            } ?>" type="date" name="dateStart" id="" class="form-control"">
        </div>
        <div class=" timeSta w-50"">
            <label for="date_of_use">Ngày kết thúc</label>
            <input value="<?php if (isset($old['dateEnd'])) {
                                echo $old['dateEnd'];
                            } ?>" type="date" name="dateEnd" id="" class="form-control"">
        </div>
    </div>
    <button type=" submit" class="btn btn-primary px-3 py-2 fw-bold text-light">Thống kê </button>
            <a href=" <?php echo _HOST_PATH_ ?>/admin/Statistics/" class="me-3 px-3 py-2 fw-bold text-light btn btn-danger">
                <i class="fa-solid fa-rotate-left"></i>
                Reset
            </a>
</form>

<!-- revenue - variation-->
<div class="" style="margin-bottom: 5rem;">
    <h3 class="text-center text-primary">Doanh thu bán vé <?php echo "$timeSearch" ?></h3>
    <table class="table table-bordered text-center table-striped border-primary" style="margin: auto;">
        <thead class="table-primary">
            <th width="3%">STT</th>
            <th>Tháng</th>
            <th>Doanh thu(VNĐ)</th>
        </thead>

        <tbody>
            <?php
            $model = new Model();
            if (!empty($dataChart)) {
                foreach ($dataChart as $key => $value) {
            ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <!-- <?php
                                if ($key % 3 == 0) {
                                    echo '<td rowspan="3" style="text-align: center; vertical-align: middle;">1</td>';
                                }
                                ?> -->
                        <td><?php echo $value['date_of_use'] ?></td>
                        <td><?php echo number_format($value['total_price'], 0, ",", ".") ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="11" class="text-primary">Không có số liệu thống kê</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="d-flex">
        <div class="revenue mt-3 me-3 w-50">
            <h4 class="text-center text-primary">Biểu đồ doanh thu bán vé</h4>
            <div class="chart-box w-100">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="variation mt-3 w-50">
            <h4 class="text-center text-primary">Biến động doanh thu bán vé</h4>
            <div class="chart-box w-100">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- revenue - percent -->

<!-- percent -->
<div class="d-flex " style="margin-bottom: 5rem;">
    <div class="m-auto ms-0 w-50" style="height: 20%;">
        <h3 class="text-center text-primary">Doanh thu theo loại vé <?php echo "$timeSearch" ?></h3>
        <table class="table table-bordered text-center table-striped border-primary m-auto ms-0 w-100 h-100">
            <thead class="table-primary">
                <th width="3%">STT</th>
                <th>Loại vé</th>
                <th>Số lượng</th>
                <th>Doanh thu(VNĐ)</th>
            </thead>

            <tbody>
                <?php
                $model = new Model();
                if (!empty($typeTicketChar)) {
                    foreach ($typeTicketChar as $key => $value) {
                        $x = (int)$value['price'] * 1000 * $value['count'];
                ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $value['ticket_name'] ?></td>
                            <td><?php echo $value['count'] ?></td>
                            <td><?php echo number_format($x, 0, ",", ".") ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11" class="text-primary">Không có số liệu thống kê</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="percent mt-3" style="width: 35%;">
        <h4 class="text-center text-primary">Biểu đồ tỉ lệ loại vé được bán <?php echo "$timeSearch" ?></h4>
        <div class="chart-box d-flex justify-content-center m-auto w-100">
            <canvas id="myChart1"></canvas>
        </div>
    </div>
</div>
<!-- percent -->

<!-- Statistic by year -->

<form action="<?php echo _HOST_PATH_ ?>/admin/Statistics/" method="post" class="mb-3 mt-3 ms-3">
    <h4>Thời gian thống kê</h4>
    <select name="yearSta" id="" class="form-control mb-3" style="width: 20%">
        <option class="text-center" value="">---- Chọn năm thống kê ---</option>
        <!-- <option class="text-center" value="2023">2023</option>
        <option class="text-center" value="2024">2024</option> -->
        <?php
        if (!empty($dataChartYear)) {
            foreach ($dataChartYear as $key => $value) {
        ?>
                <option class="text-center" value="<?php echo $value['year'] ?>"><?php echo $value['year'] ?></option>
        <?php
            }
        }
        ?>
    </select>
    <button type=" submit" class="btn btn-primary px-3 py-2 fw-bold text-light">Thống kê </button>
    <a href=" <?php echo _HOST_PATH_ ?>/admin/Statistics/" class="me-3 px-3 py-2 fw-bold text-light btn btn-danger">
        <i class="fa-solid fa-rotate-left"></i>
        Reset
    </a>
</form>
<div class="" style="margin-bottom: 5rem;">
    <h3 class="text-center text-primary">Doanh thu bán vé qua các năm</h3>
    <table class="table table-bordered text-center table-striped border-primary" style="margin: auto;">
        <thead class="table-primary">
            <th width="3%">STT</th>
            <th>Năm</th>
            <th>Doanh thu(VNĐ)</th>
        </thead>
        <tbody>
            <?php
            if (!empty($dataChartYear)) {
                foreach ($dataChartYear as $key => $value) {
            ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $value['year'] ?></td>
                        <td><?php echo number_format($value['total_price'], 0, ",", ".") ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="11" class="text-primary">Không có số liệu thống kê</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="d-flex">
        <div class="revenue mt-3 me-3 w-50">
            <h4 class="text-center text-primary">Biểu đồ doanh thu bán vé qua các năm</h4>
            <div class="chart-box w-100">
                <canvas id="myChart3"></canvas>
            </div>
        </div>
        <div class="variation mt-3 w-50">
            <h4 class="text-center text-primary">Biến động doanh thu bán vé qua các năm</h4>
            <div class="chart-box w-100">
                <canvas id="myChart4"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Statistic by year -->



<!-- Tạo biểu đồ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
<!-- revenue -->
<script>
    const labels = ['1', '2', '3', '4', '5', '6 ',
        '7', '8', '9', '10', '11', '12'
    ];
    // const labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6 ',
    //     'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
    // ];
    let dataChart = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var i = 0;
    <?php
    foreach ($dataChart as $value) {
    ?>
        dataChart.splice(<?php echo ($value['date_of_use'] - 1) ?>, 1, <?php echo $value['total_price'] ?>);
    <?php
    }
    ?>
    const data = {
        labels: labels,
        datasets: [{
            label: 'Doanh thu',
            data: dataChart,
            backgroundColor: [
                'rgb(247, 202, 201)',
                'rgb(146, 168, 209)',
                'rgb(136, 176, 75)',
                'rgb(255, 111, 97)',
                'rgb(149, 82, 81)',
                'rgb(181, 101, 167)',
                'rgb(0, 155, 119)',
                'rgb(221, 65, 36)',
                'rgb(214, 80, 118)',
                'rgb(69, 184, 172)',
                'rgb(239, 192, 80)',
                'rgb(91, 94, 166)',
                'rgb(107, 91, 149)',
                'rgb(188, 36, 60)',
                'rgb(195, 68, 122)',
                'rgb(152, 180, 212)',
                'rgb(255, 214, 98)',
                'rgb(0, 148, 115)',
                'rgb(217, 79, 112)',
                'rgb(142, 124, 195)',
                'rgb(221, 194, 131)',
                'rgb(69, 181, 170)',
                'rgb(224, 129, 25)',
                'rgb(75, 116, 71)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)'
                    }
                }
            },
        },
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
<!-- revenue -->

<!-- percent -->
<script>
    let labelDChart = [];
    let dataDChart = [];
    <?php
    foreach ($typeTicketChar as $key => $value) {
        foreach ($value as $key1 => $value1) {
            if ($key1 == 'ticket_name') {
    ?>
                labelDChart.push(<?php echo '"' . $value1 . '"' ?>)
            <?php
            } else if ($key1 == 'count') {
            ?>
                dataDChart.push(<?php echo $value1 ?>)
    <?php
            }
        }
    }
    ?>
    const data1 = {
        labels: labelDChart,
        datasets: [{
            label: 'Số lượt bán',
            data: dataDChart,
            backgroundColor: [
                'rgb(247, 202, 201)',
                'rgb(146, 168, 209)',
                'rgb(136, 176, 75)',
                'rgb(255, 111, 97)',
                'rgb(149, 82, 81)',
                'rgb(181, 101, 167)',
                'rgb(0, 155, 119)',
                'rgb(221, 65, 36)',
                'rgb(214, 80, 118)',
                'rgb(69, 184, 172)',
                'rgb(239, 192, 80)',
                'rgb(91, 94, 166)',
                'rgb(107, 91, 149)',
                'rgb(188, 36, 60)',
                'rgb(195, 68, 122)',
                'rgb(152, 180, 212)',
                'rgb(255, 214, 98)',
                'rgb(0, 148, 115)',
                'rgb(217, 79, 112)',
                'rgb(142, 124, 195)',
                'rgb(221, 194, 131)',
                'rgb(69, 181, 170)',
                'rgb(224, 129, 25)',
                'rgb(75, 116, 71)'
            ],
            hoverOffset: 4
        }]
    };
    const config1 = {
        type: 'doughnut',
        data: data1,
    };
    const myChart1 = new Chart(
        document.getElementById('myChart1'),
        config1
    );
</script>
<!-- percent -->

<!-- variation -->
<script>
    let labelLChart = [];
    let dataLChart = [];
    const data2 = {
        labels: labels,
        datasets: [{
            label: 'Doanh thu',
            data: dataChart,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };
    const config2 = {
        type: 'line',
        data: data2,
        scales: {
            x: {
                beginAtZero: false,
                title: {
                    display: true,
                    text: 'Tháng'
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Doanh thu (VNĐ)'
                }
            }
        },
    };
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
</script>
<!-- variation -->



<!-- Statistic by year -->
<script>
    const labelsYear = [];
    let dataChartYear = [];
    var i = 0;
    <?php
    foreach ($dataChartYear as $value) {
    ?>
        dataChartYear.push(<?php echo ($value['total_price'] - 1) ?>)
        labelsYear.push(<?php echo ($value['year']) ?>)
    <?php
    }
    ?>
    const dataYear = {
        labels: labelsYear,
        datasets: [{
            label: 'Doanh thu',
            data: dataChartYear,
            backgroundColor: [
                'rgb(247, 202, 201)',
                'rgb(146, 168, 209)',
                'rgb(136, 176, 75)',
                'rgb(255, 111, 97)',
                'rgb(149, 82, 81)',
                'rgb(181, 101, 167)',
                'rgb(0, 155, 119)',
                'rgb(221, 65, 36)',
                'rgb(214, 80, 118)',
                'rgb(69, 184, 172)',
                'rgb(239, 192, 80)',
                'rgb(91, 94, 166)',
                'rgb(107, 91, 149)',
                'rgb(188, 36, 60)',
                'rgb(195, 68, 122)',
                'rgb(152, 180, 212)',
                'rgb(255, 214, 98)',
                'rgb(0, 148, 115)',
                'rgb(217, 79, 112)',
                'rgb(142, 124, 195)',
                'rgb(221, 194, 131)',
                'rgb(69, 181, 170)',
                'rgb(224, 129, 25)',
                'rgb(75, 116, 71)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const configYear = {
        type: 'bar',
        data: dataYear,
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Năm'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)'
                    }
                }
            },
        },
    };
    const myChartYear = new Chart(
        document.getElementById('myChart3'),
        configYear
    );
</script>

<script>
    const data4 = {
        labels: labelsYear,
        datasets: [{
            label: 'Doanh thu',
            data: dataChartYear,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };
    const config4 = {
        type: 'line',
        data: data4,
        scales: {
            x: {
                beginAtZero: false,
                title: {
                    display: true,
                    text: 'Năm'
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Doanh thu (VNĐ)'
                }
            }
        },
    };
    const myChart4 = new Chart(
        document.getElementById('myChart4'),
        config4
    );
</script>

<!-- Statistic by year -->

<!-- Doanh thu thuê đồ -->

<div class="d-flex">
    <div class="revenue mt-3 me-3" style="width: 60%;">
        <h4 class="text-center text-primary">Biểu đồ doanh thu thuê đồ</h4>
        <div class="chart-box w-100">
            <canvas id="myChartRent"></canvas>
        </div>
    </div>
    <div class="percent mt-3" style="width: 40%;">
        <h4 class="text-center text-primary">Biểu đồ tỉ lệ loại đồ đã được thuê <?php echo "$timeSearch" ?></h4>
        <div class="chart-box  w-100">
            <canvas id="myChartRent1"></canvas>
        </div>
    </div>
</div>
<?php
foreach ($revenueRent as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'time_rent') {
            $date = explode(' ', $value1)[0];
            $month = explode('-', $date)[1];
            $year = explode('-', $date)[0];
            $revenueRent[$key]['month'] = (int) $month;
            $revenueRent[$key]['year'] = (int) $year;
        }
    }
}
?>
<script>
    const labelRent = ['1', '2', '3', '4', '5', '6 ',
        '7', '8', '9', '10', '11', '12'
    ];
    let dataChartRent = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var i = 0;
    <?php
    foreach ($revenueRent as $value) {
    ?>
        dataChartRent.splice(<?php echo ($value['month'] - 1) ?>, 1, <?php echo $value['total_rent_price'] ?>);
    <?php
    }
    ?>
    const dataRent = {
        labels: labels,
        datasets: [{
            label: 'Doanh thu',
            data: dataChartRent,
            backgroundColor: [
                'rgb(247, 202, 201)',
                'rgb(146, 168, 209)',
                'rgb(136, 176, 75)',
                'rgb(255, 111, 97)',
                'rgb(149, 82, 81)',
                'rgb(181, 101, 167)',
                'rgb(0, 155, 119)',
                'rgb(221, 65, 36)',
                'rgb(214, 80, 118)',
                'rgb(69, 184, 172)',
                'rgb(239, 192, 80)',
                'rgb(91, 94, 166)',
                'rgb(107, 91, 149)',
                'rgb(188, 36, 60)',
                'rgb(195, 68, 122)',
                'rgb(152, 180, 212)',
                'rgb(255, 214, 98)',
                'rgb(0, 148, 115)',
                'rgb(217, 79, 112)',
                'rgb(142, 124, 195)',
                'rgb(221, 194, 131)',
                'rgb(69, 181, 170)',
                'rgb(224, 129, 25)',
                'rgb(75, 116, 71)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const configRent = {
        type: 'bar',
        data: dataRent,
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)'
                    }
                }
            },
        },
    };
    const myChartRent = new Chart(
        document.getElementById('myChartRent'),
        configRent
    );
</script>
<script>
    let labelDChartRent = [];
    let dataDChartRent = [];
    <?php
    foreach ($typeDevices as $key => $value) {
        foreach ($value as $key1 => $value1) {
            if ($key1 == 'device_name') {
    ?>
                labelDChartRent.push(<?php echo '"' . $value1 . '"' ?>)
            <?php
            } else if ($key1 == 'total_quantity_rent') {
            ?>
                dataDChartRent.push(<?php echo $value1 ?>)
    <?php
            }
        }
    }
    ?>
    const dataRent1 = {
        labels: labelDChartRent,
        datasets: [{
            label: 'Số lượt thuê',
            data: dataDChartRent,
            backgroundColor: [
                'rgb(247, 202, 201)',
                'rgb(146, 168, 209)',
                'rgb(136, 176, 75)',
                'rgb(255, 111, 97)',
                'rgb(149, 82, 81)',
                'rgb(181, 101, 167)',
                'rgb(0, 155, 119)',
                'rgb(221, 65, 36)',
                'rgb(214, 80, 118)',
                'rgb(69, 184, 172)',
                'rgb(239, 192, 80)',
                'rgb(91, 94, 166)',
                'rgb(107, 91, 149)',
                'rgb(188, 36, 60)',
                'rgb(195, 68, 122)',
                'rgb(152, 180, 212)',
                'rgb(255, 214, 98)',
                'rgb(0, 148, 115)',
                'rgb(217, 79, 112)',
                'rgb(142, 124, 195)',
                'rgb(221, 194, 131)',
                'rgb(69, 181, 170)',
                'rgb(224, 129, 25)',
                'rgb(75, 116, 71)'

            ],
            hoverOffset: 4
        }]
    };
    const configRent1 = {
        type: 'doughnut',
        data: dataRent1,
    };
    const myChartRent1 = new Chart(
        document.getElementById('myChartRent1'),
        configRent1
    );
</script>

<!-- Doanh thu thuê đồ -->