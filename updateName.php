<?php
require_once 'core/init.php';

$user = new UserLogin();

if (isset($_POST['fname']) || isset($_POST['lName'])) {
    $newFirstname = $_POST['fname'];
    $newLastname = $_POST['lname'];

    // Perform the SQL update
    $user_id = $user->data()->id;
    $sql = "UPDATE userlogin SET fname = ?, lname = ? WHERE id = ?";
    $params = array($newFirstname, $newLastname, $user_id);
    if (DB::getInstance()->query($sql, $params)->error()) {
        echo "error0";
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();    }
} else {
    echo "error1"; // Return error if first name or last name is not set
}

?>

