<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM studentid ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$studentid = $stmt->fetchAll(PDO::FETCH_ASSOC);
$id_student = $pdo->query('SELECT COUNT(*) FROM studentid')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Student ID</h2>
	<a href="create.php" class="create-students">Create student</a>
	<table>
        <thead>
            <tr>
                <td>ID</td>
                <td>FirstName</td>
                <td>LastName</td>
                <td>MiddleName</td>
                <td>Birthdate</td>
                <td>Parent/GuardianName</td>
                <td>Contact</td>
                <td>Created</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studentid as $student): ?>
            <tr>
                <td><?=$student['id']?></td>
                <td><?=$student['fname']?></td>
                <td><?=$student['lname']?></td>
                <td><?=$student['mname']?></td>
                <td><?=$student['birthdate']?></td>
                <td><?=$student['pgname']?></td>
                <td><?=$student['contact']?></td>
                <td><?=$student['created']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$student['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$student['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $id_student): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>
</body>
</html>