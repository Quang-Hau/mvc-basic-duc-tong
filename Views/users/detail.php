<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem chi tiết người dùng</title>
</head>
<body>
    <!-- detail.php ở trong Foder users vì nhóm  lại dễ quản lí vì trong dự án chúng ta có nhiều đối tượng -->
     <h1>Chi tiết người dùng : <?= $user['name']?></h1>
                                    <!-- // vì dữ liệu đã trả về controller nên biến $user đã là 1 mảng nên ta có thể truy xuất -->
    <table>
        <tr>
            <th>Tên trường</th>
            <th>Giá trị</th>
        </tr>

        <tr>
            <td>Name</td>
            <td><?= $user['name']?></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><?= $user['email']?></td>
        </tr>
    </table>                               
</body>
</html>