<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {

    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;

    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $pgname = isset($_POST['pgname']) ? $_POST['pgname'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';

    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');

    $stmt = $pdo->prepare('INSERT INTO studentidsystem VALUES (?, ?, ?, ?, ?, ?)');

    $stmt->execute([$id, $fname, $lname, $mname, $birthdate, 
        $pgname, $contact, $created]);
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
    <h2><b>Personal Informations:</b></h2>  
        <form>
          <label for="fname">First Name:</label><br>
          <input type="text" id="fname" name="fname"><br>
          
          <label for="lname">Last Name:</label><br>
          <input type="text" id="lname" name="lname"><br>
          
          <label for="mname">Middle Name:</label><br>
          <input type="text" id="mname" name="mname"><br>
          
          <label for="birthdate">Birthdate:</label><br>
          <input type="text" id="birthdate" name="birthdate"><br>
          
          <label for="id">ID number:</label><br>
          <input maxlength="11" type="text" id="id" name="id"><br>
          
          <label for="pgname">Parent/Guardian Fullname:</label><br>
          <input type="text" id="pgname" name="pgname"><br>
          
          <label for="contact">Contact Number:</label><br>
          <input type="text" id="contact" name="contact"><br>
          
        </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>