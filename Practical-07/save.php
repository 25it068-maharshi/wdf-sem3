<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed'); }
$name = trim(strip_tags($_POST['name'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$message = trim(strip_tags($_POST['message'] ?? ''));
if ($name === '' || !$email || $message === '') { http_response_code(400); exit('Invalid input.'); }
$file = __DIR__ . '/data/submissions.csv';
$fp = fopen($file, 'a');
if (!$fp) { http_response_code(500); exit('Unable to save submission.'); }
fputcsv($fp, [$name, $email, $message, date(DATE_ATOM)]); fclose($fp);
echo 'Submission saved successfully.';
?>