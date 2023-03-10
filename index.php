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
                    // url: 'index.php',
                    data: { deletecongdan: macongdan },
                    success: function (result) {
                        row.remove();

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
                    <td>M?? ??i???m c??ch ly</td>
                    <td><input type="input" name="madiemcachly"></td>
                </tr>
                <tr>
                    <td>T??n ??i???m</td>
                    <td><input type="input" name="tendiemcachly"></td>
                </tr>
                <tr>
                    <td>?????a ch??? </td>
                    <td><input type="input" name="diachi"></td>
                </tr>
                <tr>
                    <td>S???c ch???a </td>
                    <td><input type="input" name="succhua"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="Submit" value="Th??m ??i???m c??ch ly" name="Submit"></td>
                </tr>
            </table>
        </form>

        <form method="POST" action="#">
            <table border="1" cellspacing="0">
                <tr>
                    <td>M?? c??ng d??n</td>
                    <td><input type="input" name="macongdan"></td>
                </tr>
                <tr>
                    <td>T??n c??ng d??n</td>
                    <td><input type="input" name="tencongdan"></td>
                </tr>
                <tr>
                    <td>Gi???i t??nh </td>
                    <td><input type="checkbox" name="gioitinh"> (Ch???n t????ng ???ng gi???i t??nh l?? 'Nam')</td>
                </tr>
                <tr>
                    <td>N??m sinh </td>
                    <td><input type="date" name="namsinh"></td>
                </tr>
                <tr>
                    <td>N?????c v??? </td>
                    <td><input type="input" name="nuocve"></td>
                </tr>
                <tr>
                    <td>T??n ??i???m c??ch ly </td>
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
                            echo "Kh??ng c?? th??ng tin";
                        echo "</select>";
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center"><input type="Submit" value="Th??m c??ng d??n" name="Submit"></td>
                </tr>
            </table>
        </form>

        <form action="#" method="POST">
            <table border="1" cellspacing="0">
                <tr>
                    <td>T??n ??i???m c??ch ly</td>
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
                            echo "Kh??ng c?? th??ng tin";
                        echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>T??n c??ng d??n</td>
                    <td>
                        <?php
                        echo "<select name='selectcongdan'>";

                        $hienthicongdan = "select * from congdan";
                        $ketquahienthicongdan = $connect->query($hienthicongdan);
                        if ($ketquahienthicongdan->num_rows > 0) {
                            while ($row = $ketquahienthicongdan->fetch_row()) {
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                        } else
                            echo "Kh??ng c?? th??ng tin";
                        echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Danh s??ch c??c tri???u ch???ng</td>
                </tr>
            </table>
        </form>

    </div>

    <br><br>

    <div class="display-info">
        <?php
        //Ch???n h??? k?? t??? l?? utf8 ????? c?? th??? in ra ti???ng Vi???t. $connect->set_charset('utf8'); //csdl ti???ng vi???t
        if (isset($_POST['Submit']) && ($_POST['Submit'] == "Th??m ??i???m c??ch ly")) {
            // include "connect.php";
            $madiemcachly = $_POST['madiemcachly'];
            $tendiemcachly = $_POST['tendiemcachly'];
            $diachi = $_POST['diachi'];
            $succhua = $_POST['succhua'];
            $str = "insert into diemcachly values ('$madiemcachly','$tendiemcachly','$diachi', '$succhua')";
            if ($connect->query($str) == true) {
                echo "Th??m th??nh c??ng";
            } else {
                echo "Th??m kh??ng th??nh c??ng";
            }

        }

        // include "connect.php";
        $hienthidiemcachly = "select * from diemcachly";
        $ketquahienthidiemcachly = $connect->query($hienthidiemcachly);
        echo "<table border='1' cellspacing='0'>";
        echo "<tr><th>STT</th><th>M?? ??i???m c??ch ly</th><th>T??n ??i???m c??ch ly</th><th>?????a ch???</th><th>S???c ch???a</th></tr>";
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
            echo "<td colspan='5'>Kh??ng c?? th??ng tin ??i???m c??ch ly</td>";
            echo "</tr>";
        }


        //Ch???n h??? k?? t??? l?? utf8 ????? c?? th??? in ra ti???ng Vi???t. $connect->set_charset('utf8'); //csdl ti???ng vi???t
        if (isset($_POST['Submit']) && ($_POST['Submit'] == "Th??m c??ng d??n")) {
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
                echo "Th??m th??nh c??ng";
            } else {
                echo "Th??m kh??ng th??nh c??ng";
            }
        }

        // if (isset($_GET['delete_id']) && $_GET['delete_id'] > 0) {
        if (isset($_POST['submit']) && $_POST['submit'] == "DELETE") {
            $deletecongdan = $_POST['deletecongdan'];
            $str = "DELETE FROM congdan WHERE `congdan`.`macongdan` = '$deletecongdan'";
            if ($connect->query($str) == true) {
                echo "Xo?? th??nh c??ng";
            } else {
                echo "Xo?? kh??ng th??nh c??ng";
            }
        }

        // include "connect.php";
        $hienthicongdan = "select * from congdan";
        $ketquahienthicongdan = $connect->query($hienthicongdan);
        echo "<table border='1' cellspacing='0'>";
        echo "<tr><th>STT</th><th>M?? c??ng d??n</th><th>T??n c??ng d??n</th><th>Gi???i t??nh</th><th>N??m sinh</th><th>N?????c v???</th><th>Ch???c n??ng</th></tr>";
        $stt = 1;
        $displaygioitinh = '';
        if ($ketquahienthicongdan->num_rows > 0) {
            while ($row = $ketquahienthicongdan->fetch_row()) {
                if ($row[2] == 1) {
                    $displaygioitinh = "Nam";
                } else
                    $displaygioitinh = "N???";
                echo "<tr>";
                echo "<td>$stt</td><td>$row[0]</td><td>$row[1]</td><td>$displaygioitinh</td><td>$row[3]</td><td>$row[4]</td><td><form method='post' action='#'><input type='hidden'
                value='" . $row[0] . "' name='deletecongdan'><a href='?viewcongdan=$row[0]'>View</a>&nbsp<input type='submit' name='submit' class='deletecongdan' value='DELETE'></form>
                </td>";
                echo "</tr>";
                $stt++;
            }
        } else {
            echo "<tr>";
            echo "<td colspan='6'>Kh??ng c?? th??ng tin c??ng d??n</td>";
            echo "</tr>";
        }

        ?>

        <?php
        if (isset($_GET['viewcongdan'])) {
            echo "ok";
            $viewcongdan = $_GET['viewcongdan'];
            echo $viewcongdan;
            $hienthicongdan = "select * from congdan where macongdan = '$viewcongdan'";
            $ketquahienthicongdan = $connect->query($hienthicongdan);
            $displaygioitinh = '';
            if ($ketquahienthicongdan->num_rows > 0) {
                while ($row = $ketquahienthicongdan->fetch_row()) {
                    if ($row[2] == 1) {
                        $displaygioitinh = "checked";
                    } else
                        $displaygioitinh = "";
                    echo "<form method=\"POST\" action=\"#\">";
                    echo "            <table border=\"1\" cellspacing=\"0\">";
                    echo "                <tr>";
                    echo "                    <td>M?? c??ng d??n</td>";
                    echo "                    <td><input type=\"input\" name=\"macongdan\" value='$row[0]' readonly></td>";
                    echo "                </tr>";
                    echo "                <tr>";
                    echo "                    <td>T??n c??ng d??n</td>";
                    echo "                    <td><input type=\"input\" name=\"tencongdan\" value='$row[1]'></td>";
                    echo "                </tr>";
                    echo "                <tr>";
                    echo "                    <td>Gi???i t??nh </td>";
                    echo "                    <td><input type=\"checkbox\" name=\"gioitinh\" $displaygioitinh> (Ch???n t????ng ???ng gi???i t??nh l?? 'Nam')</td>";
                    echo "                </tr>";
                    echo "                <tr>";
                    echo "                    <td>N??m sinh </td>";
                    echo "                    <td><input type=\"date\" name=\"namsinh\" value='$row[3]'></td>";
                    echo "                </tr>";
                    echo "                <tr>";
                    echo "                    <td>N?????c v??? </td>";
                    echo "                    <td><input type=\"input\" name=\"nuocve\" value='$row[4]'></td>";
                    echo "                </tr>";
                    echo "                <tr>";
                    echo "                    <td>T??n ??i???m c??ch ly </td>";
                    echo "                    <td>";
                    echo "<select name='selectdiemcachly'>";
                    $hienthidiemcachly = "select * from diemcachly";
                    $ketquahienthidiemcachly = $connect->query($hienthidiemcachly);
                    if ($ketquahienthidiemcachly->num_rows > 0) {
                        while ($row = $ketquahienthidiemcachly->fetch_row()) {
                            echo "<option value='$row[0]'>$row[1]</option>";
                        }
                    } else
                        echo "Kh??ng c?? th??ng tin";
                    echo "</select>";
                    echo "                    </td>";
                    echo "                </tr>";
                    echo "";
                    echo "                <tr>";
                    echo "                    <td colspan=\"2\" align=\"center\"><input type=\"Submit\" value=\"Update\" name=\"Submit\"></td>";
                    echo "                </tr>";
                    echo "            </table>";
                    echo "        </form>";
                }
            }
        }

        if (isset($_POST['Submit']) && ($_POST['Submit'] == "Update")) {
            // include "connect.php";
            var_dump("ok");
            $macongdan = $_POST['macongdan'];
            $tencongdan = $_POST['tencongdan'];
            var_dump($tencongdan);
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

            // $str = "insert into congdan values ('$macongdan','$tencongdan','$gioitinh', '$namsinh','$nuocve','$madiemcachly')";
            $str = "UPDATE `congdan` SET `TenCongDan` = '$tencongdan', `GioiTinh` = '$gioitinh', `NamSinh` = '$namsinh', `NuocVe` = '$nuocve', `MaDiemCachLy` = 'HCM' WHERE `congdan`.`MaCongDan` = '$macongdan'";
            if ($connect->query($str) == true) {
                echo "Update th??nh c??ng";
            } else {
                echo "Update kh??ng th??nh c??ng";
            }
        }

        // $connect->close();
        ?>
    </div>

</body>