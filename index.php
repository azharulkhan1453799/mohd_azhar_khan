<?php
require_once "Member.php";
$member = new Member();
$allMembers = $member->fetchMembers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Member Tree</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        ul { list-style-type: none; }
        .modal { display: none; position: fixed; padding: 20px; background: #fff; border: 1px solid #ccc; top: 20%; left: 35%; }
    </style>
</head>
<body>
    <h2>Member Tree</h2>
    <div id="memberTree">
        <?php echo $member->buildTree($allMembers); ?>
    </div>
    <br>
    <button id="addBtn">Add Member</button>

    <!-- Modal -->
    <div class="modal" id="addModal">
        <h3>Add New Member</h3>
        <form id="addMemberForm">
            <label>Name: </label><input type="text" id="name" name="name"><br><br>
            <label>Parent: </label>
            <select id="parentId" name="parentId">
                <?php echo $member->getMemberOptions(); ?>
            </select><br><br>
            <button type="submit">Save Changes</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
