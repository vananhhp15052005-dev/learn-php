<?php

require_once '/var/www/src/config/db.php';

$pageTitle = 'Quản lý người dùng';
$sql = '
    SELECT *
    FROM users
';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<div>
    <h1>Quản lý người dùng</h1>
    <button onclick='window.location.href = "create.php"'>Them nguoi dung</button>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?=htmlspecialchars($row['id']) ?></td>
                    <td><?=htmlspecialchars($row['username'])?></td>
                    <td><?=htmlspecialchars($row['email'])?></td>
                    <td><?=htmlspecialchars($row['created_at'])?></td>
                    <td>
                        <a href="edit.php?id=<?=htmlspecialchars($row['id']) ?>">Sửa</a>
                        <a href="delete.php?id=<?=htmlspecialchars($row['id']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>