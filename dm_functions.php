
<?php

/* session_start(); */

function connect_db() {
    //ADATB 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dm_v1";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");
    //kapcsolat ellenőrzése
    if (!$conn) {
        echo '<i style="color:#5379fa;">Connection failed!</i> ';
        die();
       
    }

    //helyes karakter megjelenítés

    return $conn;
}

function index_lang() {
    if (!isset($_GET["lang"])) {
        $_GET["lang"] = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
    }
    $_SESSION["lang"] = $_GET["lang"];
}

function validate_reg_login_name($fn_login_name) {
//    session_start();
    $conn = connect_db();
    $sql = "SELECT login_name FROM user WHERE login_name='" . $fn_login_name . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        return true;
    } else {
        return false;
    }
}

function validate_reg_passwords($fn_password_1, $fn_password_2) {
    if ($fn_password_1 == $fn_password_2) {
        return true;
    } else {
        return false;
    }
}

function validate_target_email($fn_target_email) {
    if (!filter_var($fn_target_email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function encode_password($fn_password) {
    return md5($fn_password, false);
}

function next_number($user_id) {
    $conn = connect_db();
    $last_number = 0;
    $last_year = 0;


    $sql_user = "SELECT last_number FROM user WHERE id=" . $user_id;
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows == 1) {
        $row_user = $result_user->fetch_assoc();
        $last_number = $row_user["last_number"];
    }

    $sql_log = "SELECT max(out_email_date) FROM out_email_log WHERE user_id=" . $user_id;
    $result_log = $conn->query($sql_log);

    if ($result_log->num_rows == 0) {
        return strval(date("Y")) . '/' . strval($last_number + 1);
    }
    
    if ($result_log->num_rows == 1) {
        $row_log = $result_log->fetch_assoc();
        $last_year = (int) $row_log["max(out_email_date)"];
    }

    

    if ($last_year == date("Y")) {
        return strval(date("Y")) . '/' . strval($last_number + 1);
    } else {
        return strval(date("Y")) . '/' . "1";
    }
}

function inc_next_number() {
    $user_id = $_SESSION["user_id"];
    $conn = connect_db();
    $last_number = 0;


    $sql_user = "SELECT last_number FROM user WHERE id=" . $user_id;
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows == 1) {
        $row_user = $result_user->fetch_assoc();
        $last_number = $row_user["last_number"];
    }
    $last_number = $last_number + 1;

    $sql_user_update = "UPDATE user SET last_number=" . $last_number . " WHERE id=" . $user_id;
    $result_update = $conn->query($sql_user_update);
}

function send_email() {
    
}

function registration() {
    $errorMsg = "";
    $reg_error = "";
    $value_error_username = "";
    $value_error_password_1 = "";
    $value_error_password_2 = "";
    $value_error_full_name = "";
    $value_error_target_email = "";
    $value_error_terms = false;
    $_POST["terms_checkbox"] = "";

    $lang_array = parse_ini_file("language_ini/" . $_SESSION["lang"] . ".ini");

//ADATB 

    if (isset($_POST["submit_reg_modal"])) {

        if (!validate_reg_login_name($_POST["username"])) {
            $value_error_username = $_POST["username"];
            $value_error_password_1 = $_POST["password"];
            $value_error_password_2 = $_POST["password_2"];
            $value_error_full_name = $_POST["full_name"];
            $value_error_target_email = $_POST["target_email"];
            $value_error_terms = $_POST["terms_checkbox"];

            $errorMsg = $lang_array["error_reg_login_name"];
        } elseif (!validate_reg_passwords($_POST["password"], $_POST["password_2"])) {
            $value_error_username = $_POST["username"];
            $value_error_password_1 = $_POST["password"];
            $value_error_password_2 = $_POST["password_2"];
            $value_error_full_name = $_POST["full_name"];
            $value_error_target_email = $_POST["target_email"];
            $value_error_terms = $_POST["terms_checkbox"];

            $errorMsg = $lang_array["error_reg_passwords"];
        } elseif (validate_target_email($_POST["target_email"])) {
            $value_error_username = $_POST["username"];
            $value_error_password_1 = $_POST["password"];
            $value_error_password_2 = $_POST["password_2"];
            $value_error_full_name = $_POST["full_name"];
            $value_error_target_email = $_POST["target_email"];
            $value_error_terms = $_POST["terms_checkbox"];

            $errorMsg = $lang_array["error_reg_target_email"];
        } else {
            $sqlplusz = "INSERT INTO user(login_name, password, full_name, target_email, info_email)  VALUES ('" . $_POST["username"] . "', '" . $_POST["password"] . "', '" . $_POST["full_name"] . "', '" . $_POST["target_email"] . "', '" . $_POST["target_email"] . "')";
            if ($conn->query($sqlplusz) === TRUE) {
                $sql = "SELECT id FROM user WHERE login_name='" . $_POST["username"] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $sqlplusz = "INSERT INTO login_log (user_id, login_date)  VALUES ('" . $row["id"] . "', '" . date("Y-m-d H:i:s") . "')";
                $conn->query($sqlplusz);

                //átírányítás
                header("Location: index.php");
            } else {
                echo "Error: " . $sqlplusz . "<br>" . $conn->error;
            }
        }
    }
}

?>
