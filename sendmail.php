<?php
// ===============================
// TALENTIME DRIVING SCHOOL
// Professional Contact Form Mailer
// ===============================

// CHANGE THIS EMAIL TO YOUR RECEIVING EMAIL
$to = "nkosananxumalo514@gmail.com";

// Website details
$site_name = "Talentime Driving School";
$site_email = "nkosananxumalo514@gmail.com";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $name    = trim(htmlspecialchars($_POST["name"] ?? ""));
    $email   = trim(filter_var($_POST["email"] ?? "", FILTER_SANITIZE_EMAIL));
    $course  = trim(htmlspecialchars($_POST["course"] ?? "Not specified"));
    $message = trim(htmlspecialchars($_POST["message"] ?? ""));

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        showError("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showError("Invalid email address.");
    }

    // Email subject
    $subject = "New Driving School Inquiry from $name";

    // Email body
    $body = "
    You have received a new message from your website contact form.

    ==============================
    Full Name: $name
    Email: $email
    Course Interested: $course
    ==============================

    Message:
    $message
    ";

    // Email headers
    $headers  = "From: $site_name <$site_email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        showSuccess();
    } else {
        showError("Message could not be sent. Please try again later.");
    }
}

// ===============================
// SUCCESS MESSAGE PAGE
// ===============================
function showSuccess() {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Message Sent</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f4f6f8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .box {
                background: white;
                padding: 40px;
                text-align: center;
                border-radius: 8px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }
            h1 {
                color: #FD5D14;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                background: #FD5D14;
                color: white;
                padding: 12px 25px;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class='box'>
            <h1>Thank You!</h1>
            <p>Your message has been sent successfully.<br>We will contact you shortly.</p>
            <a href='contact.html'>Back to Contact Page</a>
        </div>
    </body>
    </html>
    ";
    exit;
}

// ===============================
// ERROR MESSAGE PAGE
// ===============================
function showError($error) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f4f6f8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .box {
                background: white;
                padding: 40px;
                text-align: center;
                border-radius: 8px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }
            h1 {
                color: red;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                background: #333;
                color: white;
                padding: 12px 25px;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class='box'>
            <h1>Oops!</h1>
            <p>$error</p>
            <a href='contact.html'>Go Back</a>
        </div>
    </body>
    </html>
    ";
    exit;
}
?>
