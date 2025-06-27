<?php
require_once "../Member.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parentId = $_POST['parentId'] !== "" ? (int)$_POST['parentId'] : NULL;

    $member = new Member();
    $conn = (new Database())->getConnection();

    $stmt = $conn->prepare("INSERT INTO Members (Name, ParentId) VALUES (?, ?)");
    $stmt->execute([$name, $parentId]);

    $id = $conn->lastInsertId();

    echo json_encode(['success' => true, 'id' => $id, 'name' => $name]);
}
?>
