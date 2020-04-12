<?php

session_start();

$lang_array = parse_ini_file("language_ini/" . $_SESSION["lang"] . ".ini");
$email_sender_properties_array = parse_ini_file("email_sender_ini/email_sender.ini");
include_once 'dm_functions.php';
require 'PHPMailer/PHPMailerAutoload.php';

$conn = connect_db();

$user_id = $_SESSION["user_id"];
$user_login_name = $_SESSION["user_login_name"];
$user_full_name = $_SESSION["user_full_name"];
$user_target_email = $_SESSION["user_target_email"];
$email_comment = $_POST['email_comment'];

$email_partner_id = $_POST['selected_partner_id'];
$email_category_id = $_POST['selected_category_id'];
$email_partner_name = "";
$email_partner_contacts = "";
$email_partner_address = "";
$email_category = "";

$sql_partner = "SELECT * FROM partners WHERE partners_id=" . $email_partner_id;
$result_partner = $conn->query($sql_partner);

if ($result_partner->num_rows == 1) {
    $row_partner = $result_partner->fetch_assoc();
    $email_partner_name = $row_partner['partners_name'];
    $email_partner_contacts = $row_partner['partners_contacts'];
    $email_partner_address = $row_partner['partners_address'];
}

$sql_category = "SELECT * FROM categories WHERE category_id=" . $email_category_id;
$result_category = $conn->query($sql_category);

if ($result_category->num_rows == 1) {
    $row_category = $result_category->fetch_assoc();
    $email_category = $row_category["category"];
}


$email_subject_original = next_number($user_id) . " - " . $email_partner_name . " - " . $email_category;
$email_subject = "=?UTF-8?B?" . base64_encode($email_subject_original) . "?=";


$email_body =  $lang_array["date"]. ": ".date("Y.m.d"). "\n" .$lang_array["document_number"] . ": " . next_number($user_id) . "\n\n" . $lang_array["partner_name"] . ": " . $email_partner_name . "\n" . $lang_array["partner_address"] . ": " . $email_partner_address . "\n" . $lang_array["partner_contacts"] . $email_partner_contacts . "\n\n" . $lang_array["comment"] . ": " . $email_comment;


try {
    $mail = new PHPMailer;
    $mail->charSet = "UTF-8";
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;

    $mail->Username = $email_sender_properties_array["email_username"];
    ;
    $mail->Password = $email_sender_properties_array["email_password"];

    $mail->setFrom($email_sender_properties_array["email_setfrom_address"], $email_sender_properties_array["email_setfrom_name"]);
    $mail->addAddress($user_target_email, $user_full_name);

    $mail->Subject = $email_subject;
    $mail->Body = $email_body;

//Attach a file
    $mail->WordWrap = 80;
    $_FILES['attached_file']['name'] = "=?UTF-8?B?" . base64_encode($_FILES['attached_file']['name']) . "?=";
    $mail->AddAttachment($_FILES['attached_file']['tmp_name'], $_FILES['attached_file']['name']);
    
    $mail->send();
    inc_next_number();

    $sql_add_logs = "INSERT INTO `out_email_log`(`user_id`, `out_email_subject`, `out_email_date`) VALUES (".$user_id.",'".$email_subject_original."','".date("Y-m-d H:i:s")."')";

    $conn->query($sql_add_logs);

    

    header("Location: dm_logined.php?success=1");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
