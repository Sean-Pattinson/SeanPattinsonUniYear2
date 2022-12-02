<?php
session_start();
ini_set("session.save_path", "/home/unn_w16004894/public_html");
if(isset($_SESSION['logged-in'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Login process script</title>
</head>
<body>
<?php
$username = filter_has_var(INPUT_POST, 'username') ? $_POST['username'] : null;
$username = trim($username);
$password = filter_has_var(INPUT_POST, 'password') ? $_POST['password'] : null;
$password = trim($password);

$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);

$username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($username) || empty($password)) {
    echo "<p>You need to enter a usename and password. Please try <a href='index.html'>again</a>.</p>\n";
}
else {
    try {
        //clear session settings that may be present from a previous session.
        unset($_SESSION['username']);
        unset($_SESSION['logged-in']);

        require_once ("functions.php");
        $dbConn = getConnection();

        $loginSQL = "SELECT passwordHash FROM nmc_users WHERE username = :username";
        $stmt = $dbConn->prepare($loginSQL);
        $stmt->execute(array(':username' => $username));
        $user = $stmt->fetchObject();

        if($user) {
            if(password_verify($password, $user->passwordHash)) {
                echo "<p>Logon successful!</p>\n";
                echo "<a href='chooseRecordList.php'>Choose Record List</a>\n";

                /* Set a session variable called logged-in and give it a value of true
                   to indicate a successful login attempt.*/
                $_SESSION['logged-in'] = true;

                /* Set a session variable called username and add the user's username as
                   the value*/
                $_SESSION['username'] = $username;
                session_write_close();
                if(isset($_SESSION['logged-in'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                echo "<p>The username or password were incorrect. Please try
                      <a href='index.html'>again</a>.</p>\n";
            }
        } else {
            echo "<p>The username or password were incorrect. Please try
                      <a href='index.html'>again</a>.</p>\n";
        }
    } catch (Exception $e) {
        echo "Record not found: " . $e->getMessage();
    }
}
?>
</body>
</html>
