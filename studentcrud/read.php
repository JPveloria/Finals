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

$stmt = $pdo->prepare('SELECT * FROM Student ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$studentidsystem = $stmt->fetchAll(PDO::FETCH_ASSOC);
$student = $pdo->query('SELECT COUNT(*) FROM studentidsystem')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Read student</h2>
	<a href="create.php" class="create-studentidsystem">Create Student's ID information</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Title</td>
                <td>Created</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($student as $students): ?>
            <tr>
                <td><?=$students['id']?></td>
                <td><?=$students['fname']?></td>
                <td><?=$students['email']?></td>
                <td><?=$students['phone']?></td>
                <td><?=$students['title']?></td>
                <td><?=$students['created']?></td>
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
		<?php if ($page*$records_per_page < $student): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>
</body>
</html>