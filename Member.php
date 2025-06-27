<?php
require_once "db.php";

class Member {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function fetchMembers() {
        $stmt = $this->conn->prepare("SELECT * FROM Members");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buildTree($members, $parentId = NULL) {
        $tree = "<ul>";
        foreach ($members as $member) {
            if ($member['ParentId'] == $parentId) {
                $tree .= "<li data-id='{$member['id']}'>{$member['Name']}";
                $tree .= $this->buildTree($members, $member['id']);
                $tree .= "</li>";
            }
        }
        $tree .= "</ul>";
        return $tree;
    }

   public function getMemberOptions() {
    $members = $this->fetchMembers();
    $options = "<option value=''>-- Select Parent --</option>";
    foreach ($members as $m) {
        $options .= "<option value='{$m['id']}'>{$m['Name']}</option>";
    }
    return $options;
}

}
?>
