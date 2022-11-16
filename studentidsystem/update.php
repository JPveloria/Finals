<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
        $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
        $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
        $pgname = isset($_POST['pgname']) ? $_POST['pgname'] : '';
        $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        $stmt = $pdo->prepare('UPDATE studentid SET id = ?, fname = ?, lname = ?, mname = ?, birthdate = ?, pgname = ?, contact = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $fname, $lname, $mname, $birthdate, $pgname, $contact, $created, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM studentid WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$student) {
        exit('Student doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
    <h2>Update Student #<?=$student['id']?></h2>
    <form action="update.php?id=<?=$student['id']?>" method="post">
        <label for="id">ID</label>
        <label for="fname">FirstName</label>
        
        <input type="text" name="id" placeholder="" value="<?=$student['id']?>" id="id">
        <input type="text" name="fname" placeholder="" value="<?=$student['fname']?>" id="fname">

        <label for="lname">LastName</label>
        <input type="text" name="lname" placeholder="" value="<?=$student['lname']?>" id="lname">

        <label for="mname">MiddleName</label>
        <input type="text" name="mname" placeholder="" value="<?=$student['mname']?>" id="mname">

        <label for="birthdate">Birthdate</label>
        <input type="text" name="birthdate" placeholder="" value="<?=$student['birthdate']?>" id="birthdate">

        <label for="pgname">Parent/Guardian Fullname</label>
        <input type="text" name="pgname" placeholder="" value="<?=$student['pgname']?>" id="pgname">

        <label for="contact">Contact</label>
        <input type="text" name="contact" placeholder="" value="<?=$student['contact']?>" id="contact">

        <label for="created">Created</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($student['created']))?>" id="created">
        <input type="submit" value="Update">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>