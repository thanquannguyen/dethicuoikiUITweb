<!DOCTYPE html>

<head>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
        }

        .form-row {
            display: flex;
            margin: 2px;
        }

        /* .display-info {
            display: flex;
            margin: 2px;
        } */
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        // function showUser(str) {
        //     if (str == "") {
        //         document.getElementById("txtHint").innerHTML = "";
        //         return;
        //     }
        //     var xmlhttp = new XMLHttpRequest();
        //     xmlhttp.onreadystatechange = function () {
        //         if (this.readyState == 4 && this.status == 200) {
        //             document.getElementById("txtHint").innerHTML = this.responseText;
        //         }
        //     }
        //     xmlhttp.open("GET", "getuser.php?q=" + str, true);
        //     xmlhttp.send();
        // }

        $(document).ready(function () {
            $('.deletecongdan').click(function () {
                var row = $(this).closest('tr');
                var macongdan = row.find('td:nth-child(2)').text();
                // alert(id);
                $.ajax({
                    type: 'POST',
                    url: 'index.php',
                    data: { deletecongdan: macongdan },
                    success: function (result) {
                        if (result == 'success'){
                        row.remove();
                        } else {
                            alert('request fails');
                        }
                    }
            });
            });
        });

    </script>
</head>

<body>
    <?php
    $connect = new mysqli('localhost', 'root', '', 'dethicuoikiuitweb');
    if ($connect->errno !== 0) {
        die("Error: Could not connect to the database. An error " . $connect->error . " ocurred.");
    }
    ?>

    <div class="form-row">
        <form method="POST" action="#">
            <table border="1" cellspacing="0">
                <tr>
                    <td>Mã điểm cách ly</td>
                    <td><input type="input" name="madiemcachly"></td>
                </tr>
                <tr>
                    <td>Tên điểm</td>
                    <td><input type="input" name="tendiemcachly"></td>
                </tr>
                <tr>
                    <td>Địa chỉ </td>
                    <td><input type="input" name="diachi"></td>
                </tr>
                <tr>
                    <td>Sức chứa </td>
                    <td><input type="input" name="succhua"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="Submit" value="Thêm điểm cách ly" name="Submit"></td>
                </tr>
            </table>
        </form>

        <form method="POST" action="#">
            <table border="1" cellspacing="0">
                <tr>
                    <td>Mã công dân</td>
                    <td><input type="input" name="macongdan"></td>
                </tr>
                <tr>
                    <td>Tên công dân</td>
                    <td><input type="input" name="tencongdan"></td>
                </tr>
                <tr>
                    <td>Giới tính </td>
                    <td><input type="checkbox" name="gioitinh"> (Chọn tương ứng giới tính là 'Nam')</td>
                </tr>
                <tr>
                    <td>Năm sinh </td>
                    <td><input type="date" name="namsinh"></td>
                </tr>
                <tr>
                    <td>Nước về </td>
                    <td><input type="input" name="nuocve"></td>
                </tr>
                <tr>
                    <td>Tên điểm cách ly </td>
                    <td>
                        <?php
                        echo "<select name='selectdiemcachly'>";

                        $hienthidiemcachly = "select * from diemcachly";
                        $ketquahienthidiemcachly = $connect->query($hienthidiemcachly);
                        if ($ketquahienthidiemcachly->num_rows > 0) {
                            while ($row = $ketquahienthidiemcachly->fetch_row()) {
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                        } else
                            echo "Không có thông tin";
                        echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center"><input type="Submit" value="Thêm công dân" name="Submit"></td>
                </tr>
            </table>
        </form>
    </div>

    <br><br>

    <div class="display-info">
        <?php
        //Chọn hệ ký tự là utf8 để có thể in ra tiếng Việt. $connect->set_charset('utf8'); //csdl tiếng việt
        if (isset($_POST['Submit']) && ($_POST['Submit'] == "Thêm điểm cách ly")) {
            // include "connect.php";
            $madiemcachly = $_POST['madiemcachly'];
            $tendiemcachly = $_POST['tendiemcachly'];
            $diachi = $_POST['diachi'];
            $succhua = $_POST['succhua'];
            $str = "insert into diemcachly values ('$madiemcachly','$tendiemcachly','$diachi', '$succhua')";
            if ($connect->query($str) == true) {
                echo "Thêm thành công";
            } else {
                echo "Thêm không thành công";
            }

        }

        // include "connect.php";
        $hienthidiemcachly = "select * from diemcachly";
        $ketquahienthidiemcachly = $connect->query($hienthidiemcachly);
        echo "<table border='1' cellspacing='0'>";
        echo "<tr><th>STT</th><th>Mã điểm cách ly</th><th>Tên điểm cách ly</th><th>Địa chỉ</th><th>Sức chứa</th></tr>";
        $stt = 1;
        if ($ketquahienthidiemcachly->num_rows > 0) {
            while ($row = $ketquahienthidiemcachly->fetch_row()) {
                echo "<tr>";
                echo "<td>$stt</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>";
                echo "</tr>";
                $stt++;
            }
        } else {
            echo "<tr>";
            echo "<td colspan='5'>Không có thông tin điểm cách ly</td>";
            echo "</tr>";
        }


        //Chọn hệ ký tự là utf8 để có thể in ra tiếng Việt. $connect->set_charset('utf8'); //csdl tiếng việt
        if (isset($_POST['Submit']) && ($_POST['Submit'] == "Thêm công dân")) {
            // include "connect.php";
            $macongdan = $_POST['macongdan'];
            $tencongdan = $_POST['tencongdan'];
            $gioitinh = 0;
            if (array_key_exists('gioitinh', $_POST)) {
                if (!empty($_POST['gioitinh'])) {
                    $gioitinh = 1;
                }
            }
            $namsinh = $_POST['namsinh'];
            $nuocve = $_POST['nuocve'];
            //  $selectdiemcachly = $_POST[''];
            if (isset($_POST['selectdiemcachly'])) {
                $madiemcachly = $_POST['selectdiemcachly'];
            }
            echo $madiemcachly;

            $str = "insert into congdan values ('$macongdan','$tencongdan','$gioitinh', '$namsinh','$nuocve','$madiemcachly')";
            if ($connect->query($str) == true) {
                echo "Thêm thành công";
            } else {
                echo "Thêm không thành công";
            }

        }

        // include "connect.php";
        $hienthicongdan = "select * from congdan";
        $ketquahienthicongdan = $connect->query($hienthicongdan);
        echo "<form method=\"POST\" action=\"\">";
        echo "<table border='1' cellspacing='0'>";
        echo "<tr><th>STT</th><th>Mã công dân</th><th>Tên công dân</th><th>Giới tính</th><th>Năm sinh</th><th>Nước về</th><th>Chức năng</th></tr>";
        $stt = 1;
        $displaygioitinh = '';
        if ($ketquahienthicongdan->num_rows > 0) {
            while ($row = $ketquahienthicongdan->fetch_row()) {
                if ($row[2] == 1) {
                    $displaygioitinh = "Nam";
                } else
                    $displaygioitinh = "Nữ";
                echo "<tr>";
                echo "<td>$stt</td><td>$row[0]</td><td>$row[1]</td><td>$displaygioitinh</td><td>$row[3]</td><td>$row[4]</td><td><a href='#' class='viewcongdan'>View</a>&nbsp<form action='#' method='post'><input type='hidden'
                value='".$row[0]."' name='deletecongdan'><input type='submit' name='submit' class='deletecongdan' value='DELETE'>
                </form></td>";
                echo "</tr>";
                $stt++;
            }
        } else {
            echo "<tr>";
            echo "<td colspan='6'>Không có thông tin công dân</td>";
            echo "</tr>";
        }
        echo "</form>";


        // if (isset($_GET['delete_id']) && $_GET['delete_id'] > 0) {
        if (isset($_POST['submit']) && $_POST['submit'] == "DELETE") {
            $deletecongdan = $_POST['deletecongdan'];
            $str = "DELETE FROM congdan WHERE `congdan`.`macongdan` = '$deletecongdan'";
            if ($connect->query($str) == true) {
                echo "Xoá thành công";
            } else {
                echo "Xoá không thành công";
            }
        }
        $connect->close();
        ?>
    </div>

</body>