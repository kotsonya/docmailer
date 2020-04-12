<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
//ADATB 
        include_once 'dm_functions.php';
        $conn = connect_db();
// nyelvesítés
        index_lang();
        $lang_array = parse_ini_file("language_ini/" . $_SESSION["lang"] . ".ini");
        $errorMsg = "";
        $reg_errormsg = "";
        $value_error_username = "";

        if (isset($_POST["submit"])) {


            $sql = "SELECT id, login_name, full_name, target_email FROM user WHERE login_name='" . $_POST["username"] . "' AND password='" . encode_password($_POST["password"]) . "'";
            $result = $conn->query($sql);
            //ha stimmel a felhasz/jelszó

            if ($result->num_rows == 1) {
                $_SESSION["login"] = true; //megjelölni, hogyha kellene még

                $row = $result->fetch_assoc();
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_login_name"] = $row["login_name"];
                $_SESSION["user_full_name"] = $row["full_name"];
                $_SESSION["user_target_email"] = $row["target_email"];
                
                $sql_add_login_log = "INSERT INTO login_log (user_id, login_date)  VALUES ('".$row["id"]."', '".date("Y-m-d H:i:s")."')";
                $conn->query($sql_add_login_log);
            }
            //ha nem stimmel a felhasz/jelszó
            else {
                $errorMsg = $lang_array["invalid_acc"];
                $value_error_username = $_POST["username"];
            }

            $_SESSION["user"] = $_POST["username"];
        }

//átírányítás
        if (isset($_SESSION["login"])) {

            header("Location: dm_logined.php");
        }
//        -------------------------------------
//      regisztráció  
//        -------------------------------------
        $errorMsg = "";
     
        
        ?>



        <div class="language_link">

            <a href="index.php?lang=hu" style = "color: <?php
        
            if ($_SESSION["lang"] == "hu") {
            echo "gray";
        } else {
            echo "#0F4C81";
        }
        ?>">hu</a> <?php echo "<font color='gray'> | </font>" ?></a><a href="index.php?lang=en" style="color:  <?php

        if ($_SESSION["lang"] == "en") {
                   echo "gray";
               } else {
                   echo "#0F4C81";
               }
               ?>">en</a>
    </div>

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
                            <input type="password" class="form-control" placeholder="<?php echo $lang_array['password']; ?>" name="password" required >
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?php echo $lang_array['login']; ?>" class="btn float-right login_btn" name="submit" />
                        </div>
                    </form>

                </div>

                <div class="error" align="center" style = "color: lightyellow"><?php echo $errorMsg; ?></div>                                      
                <div class="card-footer">
                    <div style="text-align:right">
                        <a href="" style="float:left;" data-toggle="modal" data-target="#wit_modal"><?php echo $lang_array['what_is_it']; ?></a>
                     <a href="dm_reg.php" style="float:right;"><?php echo $lang_array['registration']; ?></a>
                    </div> 
                </div>


            </div>
        </div>

    </div>


<!-----------------------------------------
--------------------MODALS-----------------
------------------------------------------->


<!-----------------------------------------        
--------------------wit_modal---------------
------------------------------------------->        

  <div class="modal fade bannerformmodal" id="wit_modal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
            <p class="modal-title" id="myModalLabel"><span>Doc</span>Mailer</p>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
          
        </div>
        <div class="modal-body">
          <div align="justify">
                        <?php echo $lang_array["what_is_it_text"]; ?>
          </div>
        
      </div>
    </div>
  </div>
</div>
  </div>
       

      
      
  </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
</body>
</html>