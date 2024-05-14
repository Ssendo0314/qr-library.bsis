<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path to autoload.php as per your project structure

ob_start();
require_once 'core/init.php';

$user = new UserLogin(); //Current

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'email' => array(
            'email' => 'email',
            'required' => true,
            'min' => 2,
            'unique' => 'userlogin'
        ),
        'id' => array(
            'required' => true,
            'regex' => '/^MAX\d{7}$/'
        )
    ));
    if ($validate->passed()) {
        // Generate random username and password
        $randomUsername = 'user_' . uniqid();
        $randomPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

        $user = new Userlogin();
        try {
            $user->create(array(
                'id' => Input::get('id'),
                'username' => $randomUsername,
                'email' => Input::get('email'),
                'password' => Hash::make($randomPassword),
                'joined' => date('Y-m-d H:i:s'),
                'permission' => Input::get('userRole'),
                'fname' => '',
                'lname' => '',
                'login_id' => '',
                'avatar' => '',
                'current_session' => 0,
                'online' => 0,
            ));

            // Send email
            $mail = new PHPMailer(true);

            // Set mail server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'jhayleanne@gmail.com'; // SMTP username
            $mail->Password = 'hipxlaboldktgoyn'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Set sender and recipient
            $mail->setFrom('jhayleanne@gmail.com', 'BPC Library Management System');
            $mail->addAddress(Input::get('email'));

            // Set email content
            $mail->isHTML(true);
            $mail->Subject = '[ACTION REQUIRED] User Account Credentials for BPC Library Management System';
            $mail->Body = '
            <html>
            <head>
                <title>New User Account Information</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #fff;
                        border-radius: 10px;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                        padding: 30px;
                    }
                    h2 {
                        color: #333;
                    }
                    p {
                        color: #666;
                    }
                    .notice {
                        background-color: #f9f9f9;
                        border-left: 6px solid #007bff;
                        padding: 10px;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>New User Account Information</h2>
                    <p>Hello,</p>
                    <p>Your new account has been successfully created. Here are your login credentials:</p>
                    <ul>
                        <li><strong>Username:</strong> ' . $randomUsername . '</li>
                        <li><strong>Password:</strong> ' . $randomPassword . '</li>
                    </ul>
                    <div class="notice">
                        <p><strong>Notice:</strong> After logging in, it is highly encouraged to update your details and secure your account by changing your password.</p>
                    </div>
                </div>
            </body>
            </html>
        ';

            // Send the email
            $mail->send();

            Session::flash('UserAdded', 'New User has been successfully added.');
            Session::flash('Username', $randomUsername); // Store random username in session
            Session::flash('Password', $randomPassword); // Store random password in session
            Redirect::to('admin.php?action=userList');
        } catch (Exception $e) {
            // Handle the exception, if needed
            Session::flash('Error', $e->getMessage());
            Redirect::to('admin.php?action=userList');
        }
    } else {
        foreach ($validate->errors() as $error) {
            Session::flash('Error', $error);
            Redirect::to('admin.php?action=userList');
        }
    }
}
ob_end_flush();
