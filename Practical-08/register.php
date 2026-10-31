<?php
require __DIR__.'/config.php';
$name=trim($_POST['name']??''); $email=filter_var($_POST['email']??'', FILTER_VALIDATE_EMAIL);
if ($_SERVER['REQUEST_METHOD']==='POST') { if ($name==='' || !$email) exit('Invalid name or email.'); $stmt=$pdo->prepare('INSERT INTO students(name,email) VALUES(:name,:email)'); try{$stmt->execute(['name'=>$name,'email'=>$email]);echo 'Student added.';}catch(PDOException $e){http_response_code(400);echo 'Could not add student; check for duplicate email.';} }
?>
<form method="post"><input name="name" placeholder="Name" required><input name="email" type="email" placeholder="Email" required><button>Save</button></form>