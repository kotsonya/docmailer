
<html>
    <head>
        <title>DocMailer βeta</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="DM_02_css.css">
        <link rel="icon" type="image/png" href="images/favicon_dm_256px.png">
    </head>
    <body>
        <?php
        //session kezdés
        session_start();
        include_once 'dm_functions.php';


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

        include_once 'dm_functions.php';
        $conn = connect_db();


        if (isset($_POST["submit"])) {

            if (!validate_reg_login_name($_POST["username"])) {
                $value_error_username = $_POST["username"];
                $value_error_password_1 = $_POST["password"];
                $value_error_password_2 = $_POST["password_2"];
                $value_error_full_name = $_POST["full_name"];
                $value_error_target_email = $_POST["target_email"];

                $errorMsg = $lang_array["error_reg_login_name"];
            } elseif (!validate_reg_passwords($_POST["password"], $_POST["password_2"])) {
                $value_error_username = $_POST["username"];
                $value_error_password_1 = $_POST["password"];
                $value_error_password_2 = $_POST["password_2"];
                $value_error_full_name = $_POST["full_name"];
                $value_error_target_email = $_POST["target_email"];

                $errorMsg = $lang_array["error_reg_passwords"];
            } elseif (validate_target_email($_POST["target_email"])) {
                $value_error_username = $_POST["username"];
                $value_error_password_1 = $_POST["password"];
                $value_error_password_2 = $_POST["password_2"];
                $value_error_full_name = $_POST["full_name"];
                $value_error_target_email = $_POST["target_email"];

                $errorMsg = $lang_array["error_reg_target_email"];
            } else {
                if (isset($_POST["terms_checkbox"])) {
                    $sqlplusz = "INSERT INTO user(login_name, password, full_name, target_email, info_email,last_number)  VALUES ('" . $_POST["username"] . "', '" . encode_password($_POST["password"]) . "', '" . $_POST["full_name"] . "', '" . $_POST["target_email"] . "', '" . $_POST["target_email"] . "',0)";
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
                } else {
                    $value_error_username = $_POST["username"];
                    $value_error_password_1 = $_POST["password"];
                    $value_error_password_2 = $_POST["password_2"];
                    $value_error_full_name = $_POST["full_name"];
                    $value_error_target_email = $_POST["target_email"];

                    $errorMsg = $lang_array["error_terms"];
                }
            }
        }
        ?>

        <!DOCTYPE html>
    <div class="container" >
        <div class="d-flex justify-content-center h-100" >
            <div class="card">
                <div class="card-header" style="background-color:rgba(15,76,129,0.3)">
                    <h3><span>Doc</span>Mailer</h3>
                </div>

                <div class="card-body">
                    <form method="post">

                        <div class="input-group form-group" >
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="<?php echo $lang_array["user_name"]; ?>" name="username" value="<?php echo $value_error_username ?>" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="<?php echo $lang_array['password']; ?>" name="password" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="<?php echo $lang_array['password_again']; ?>" name="password_2" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="<?php echo $lang_array['full_name']; ?>" name="full_name" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="<?php echo $lang_array['target_email']; ?>" name="target_email" required>
                        </div>

                        <div class="input-group form-group"  style="color:#FFC312">
                            <input type="checkbox" name="terms_checkbox" value="true"> <label><?php echo $lang_array['terms']; ?><a href="" data-toggle="modal" data-target="#t_and_c_modal"><?php echo $lang_array['terms_short_name']; ?></a></label>

                        </div>

                        <div class="form-group">
                            <input  type="submit" value="<?php echo $lang_array['registration']; ?>" class="btn float-right login_btn" name="submit" />
                        </div>
                    </form>

                </div>
                <div class="error" align="center" style = "color: lightyellow"><?php echo $errorMsg; ?></div>                                         

                <div class="card-footer">
                    <div style="text-align:left">

                        <a href="index.php?lang=<?php echo $_SESSION["lang"] ?>" style="float:left;"><?php echo $lang_array['back']; ?></a>
                    </div> 
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
</html>
