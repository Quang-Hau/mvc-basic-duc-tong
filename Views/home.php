<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>
</head>

<body>
    <h1>đây là trang chủ</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users  as $user) : ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td>
                    <a href="<?= BASE_URL . '?act=user-detail&id=' .  $user['id']  ?>">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>