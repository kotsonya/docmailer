<html>

<head>

  <title>DocMailer βeta</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="DM_02_css.css">
          <link rel="icon" type="image/png" href="images/favicon_dm_256px.png">
  <meta charset="UTF-8">
</head>

<body>

  <?php
  session_start();
  $lang_array = parse_ini_file("language_ini/" . $_SESSION["lang"] . ".ini");
  include_once 'dm_functions.php';
  $errorMsg = "";
  $conn = connect_db();
//----------------User_datas-------------------------
  $user_id = $_SESSION["user_id"];
  $user_login_name = $_SESSION["user_login_name"];
  $user_full_name = $_SESSION["user_full_name"];
  $user_target_email = $_SESSION["user_target_email"];


//----------------Email_default_datas-------------------------
  
  $mail_adress = $user_target_email;
  $mail_subject = "";
  $mail_attachment = "";
  $mail_message = "";
  
  
  if (isset($_POST["submit_logout"])) {
    $logout_lang = $_SESSION["lang"];
    session_destroy();
    header("Location: index.php?lang=$logout_lang");
  }
  ?>

  <!DOCTYPE html>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand">DocMailer</a>

    <div class="collapse navbar-collapse" id="navbar_loggined">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="" data-toggle="modal" data-target="#modal_partners"><?php echo $lang_array['partners']; ?></a>

        </li>
        <li class="nav-item">
          <a class="nav-link " href="#" data-toggle="modal" data-target="#modal_categories"><?php echo $lang_array['categories']; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#" data-toggle="modal" data-target="#modal_logs"><?php echo $lang_array['logs']; ?></a>
        </li>
      </ul>

      <form class="form-inline my-2 my-lg-0" method="post">
       
		<i class="fas fa-user"></i>
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_user"><?php echo $user_full_name; ?></a>
        <button type="submit" class="btn" name="submit_logout"><?php echo $lang_array['logout']; ?> <i class="fa fa-power-off"></i></button>
      </form>
    </div>
  </nav>


    <!----EMAIL_DIV----------------------------------------------------------------------->

    <div class="container-lg email_form_container_class" id="email_form_container">
    <div class="d-flex justify-content-center" >
    <div class="card w-50 d-flex " id="email_card" style="background-color: rgba(0,0,0,0.2) !important;  resize: both; overflow: auto;">
        <div class="card-header" id="email_card_header" style="vertical-align: middle" >
            <p style="color: rgba(255,255,255,1);"><?php echo $lang_array['document_number']; ?> : <?php echo next_number($user_id) ?><p>
                
        </div>
        <div class="card-body" id="email_card_body">
            <form action="send_email.php" method="post" id="email_form" name="email_form" enctype="multipart/form-data">
                    <?php if (!empty($_GET['success']) && $_GET['success']) { ?>
<!--                          <button type="button" class="btn-sm"  id="sended_email_button" aria-hidden="true"><?php echo $lang_array['email_sended']; ?> <i class="fa fa-check"></i></button>-->
<p class="alert alert-success hide fadeTo" id="email_ok_alert" data-alert="alert" style="top:0"><?php echo $lang_array['email_sended']; ?></p>
                    <?php } ?>
                        
                            <div class="form-group" style="width: 100%">				  
                                <select class="form-control chosen" id="selected_partner_id" style="overflow: auto; max-height: 200px; resize: vertical;" data-placeholder="<?php echo $lang_array['partner']; ?>" name="selected_partner_id" required>
                                    <option></option>
                                    <?php
                                    $sql_partners_drop = "SELECT * FROM partners WHERE user_id=" . $user_id . " ORDER BY partners_name ";
                                    $result_partners_list_drop = $conn->query($sql_partners_drop);
                                    while ($row = mysqli_fetch_array($result_partners_list_drop)) {
                                        echo ' 
                                    <option value ="' . $row['partners_id'] . '">' . $row["partners_name"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                        <div class="form-group" style="width: 100%">				  
                            <select class="form-control chosen" style="overflow: auto; max-height: 200px" data-placeholder="<?php echo $lang_array['category']; ?>" id="selected_category_id" name="selected_category_id" required>
                                <option></option>
                                <?php
                                $sql_categories_drop = "SELECT * FROM categories WHERE user_id=" . $user_id . " ORDER BY category ";
                                $result_categories_list_drop = $conn->query($sql_categories_drop);
                                while ($row = mysqli_fetch_array($result_categories_list_drop)) {
                                    echo ' 
                                    <option value ="' . $row['category_id'] . '">' . $row["category"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        

                    <div class="form-group">
                            <input type="file" id="attached_file" name="attached_file">
                            </div>
                        
                    <div class="form-group">
                            <textarea class="form-control" rows="5" name="email_comment" placeholder="<?php echo $lang_array['comment']; ?>" id="email_comment" ></textarea>
                        
                </div>

                <button type="submit" class="btn float-right login_btn" name="sendEmail"></i><?php echo $lang_array['send']; ?><i class="fa fa-paper-plane" style="margin-left: 5px;margin-right: 0px;"></i></button>
                        </form>
                    </div>

    </div>
</div>
</div>
</div>
    
  <!----------------MODALS---------------->

  <!----------------Partners_list_MODAL---------------->
  <div class="modal fade" id="modal_partners" data-backdrop="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array['partners']; ?></p>
          <button id="page_reload_plu" type="button" class="close"  onclick="" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="container"></div>
        <div class="modal-body">
            <table id="partners_table" class="table table-striped table-bordered" style="width: 100%;">
              <!--                    <table id = "partners_table" class = "table table-striped table-bordered" style="font-size: 14px;">-->
              <thead>
                <button class="btn" type="button" data-toggle="modal" style="float:right;" data-target="#modal_add_partner"><i class="fa fa-plus"></i> <?php echo $lang_array["add"]; ?></button>
                <br>
                <br>

                <tr>
                            <td style="width:20%" ><?php echo $lang_array["name"]; ?></td>
                            <td style="width:40%"><?php echo $lang_array['address']; ?></td>
                            <td style="width:30%"><?php echo $lang_array["contacts"]; ?></td>
                            <td style="width:10%"></td>

                </tr>
              </thead>
              <tbody class="partner_list">
                <?php
                $sql_partners = "SELECT * FROM partners WHERE user_id=" . $user_id . " ORDER BY partners_name ";
                $result_partners_list = $conn->query($sql_partners);
                while ($row = mysqli_fetch_array($result_partners_list)) {
                  echo '
                               <tr>  
                                    <td>' . $row["partners_name"] . '</td>  
                                    <td>' . $row["partners_address"] . '</td>  
                                    <td>' . $row["partners_contacts"] . '</td>
                                    <td style="white-space:nowrap;">
                                    <td><a href="#" class="edit_partner btn btn-sm" data-id="' . $row['partners_id'] . '" data-toggle="modal" data-target="#modal_edit_partner"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="#" class="delete_partner btn btn-sm" data-id="' . $row['partners_id'] . '" data-toggle="modal" data-target="#modal_delete_partner"><i class="fa fa-trash"></i></a></td>
                               </tr>';
                }
                ?>
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="close" id="page_reload_pld"  data-dismiss="modal" aria-hidden="true">×</button>
        </div>
      </div>
    </div>
  </div>

  <!----------------Partner_add_MODALS---------------->

  <div class="modal fade" id="modal_add_partner" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array["add"]; ?></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><label><?php echo $lang_array["name"]; ?></label><input type="text" class="form-control" id="partner_name"></p>
          <p><label><?php echo $lang_array['address']; ?></label><input type="text" class="form-control" id="partner_address"></p>
          <p><label><?php echo $lang_array["contacts"]; ?></label><input type="text" class="form-control" id="partner_contacts"></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-target="#modal_add_partner"><?php echo $lang_array["cancel"]; ?></button>
          <button type="button" class="btn btn-primary" id="add_partner" data-toggle="modal" data-dismiss="modal" data-target="#modal_add_partner"><?php echo $lang_array["add"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  
    <!----------------Partner_edit_MODAL---------------->

    <div class="modal fade" id="modal_edit_partner" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array["edit"]; ?></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="edit_modal_content"></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-target="#modal_edit_partner"><?php echo $lang_array["cancel"]; ?></button>
          <button type="button" class="btn btn-primary" id="save_partner_edit" data-toggle="modal" data-dismiss="modal" data-target="#modal_edit_partner"><?php echo $lang_array["ok"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <!----------------Partner_delete_MODAL---------------->

  <div class="modal fade" id="modal_delete_partner" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array["really"]; ?></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="delete_modal_content"></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-target="#modal_delete_partner"><?php echo $lang_array["cancel"]; ?></button>
          <button type="button" class="btn btn-primary"  data-toggle="modal" data-dismiss="modal" data-target="#modal_delete_partner" id="delete_partner_confirm"><?php echo $lang_array["delete"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <!----------------Categories_list_MODAL---------------->
  <div class="modal fade" id="modal_categories" data-backdrop="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array['categories']; ?></p>
          <button type="button" class="close" id="page_reload_clu" onclick="" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="container"></div>
        <div class="modal-body">
            <table id="categories_table" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <button class="btn" type="button" data-toggle="modal" style="float:right; margin-left:5px;" data-target="#modal_add_categories"><i class="fa fa-plus"></i> <?php echo $lang_array["add"]; ?></button>
                <button class="btn" type="button" onclick="download_gmail_xml_js(<?php echo $user_id; ?>, '<?php echo $lang_array['gmail_filter_xml_file']; ?>')"  style="float:right;"><i class="fa fa-arrow-down" ></i> <?php echo $lang_array["export_to_gmail"]; ?></button>

                <br>
                <br>

                <tr>
                  <td style="width:90%"></td>
                  <td style="width:10%"></td>

                </tr>
              </thead>
              <tbody class="categories_list">
                <?php
                $sql_categories = "SELECT * FROM categories WHERE user_id=" . $user_id . " ORDER BY category ";
                $result_categories_list = $conn->query($sql_categories);
                
                while ($row = mysqli_fetch_array($result_categories_list)) {
                  echo '
                               <tr>  
                                    <td>' . $row["category"] . '</td>  
                                    <td style="white-space:nowrap;">
                                    <td><a href="#" class="edit_categories btn btn-sm" data-id="' . $row['category_id'] . '" data-toggle="modal" data-target="#modal_edit_categories"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="#" class="delete_categories btn btn-sm" data-id="' . $row['category_id'] . '" data-toggle="modal" data-target="#modal_delete_categories"><i class="fa fa-trash"></i></a></td>
                               </tr>';
                }
                ?>
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="close" id="page_reload_cld" onclick="" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
      </div>
    </div>
  </div>
  
  <!----------------Categories_add_MODAL---------------->

  <div class="modal fade" id="modal_add_categories" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array["add"]; ?></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p><label><?php echo $lang_array["categories"]; ?></label><input type="text" class="form-control" id="categories_name" required></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-target="#modal_add_categories"><?php echo $lang_array["cancel"]; ?></button>
          <button type="button" class="btn btn-primary" id="add_categories" data-toggle="modal" data-dismiss="modal" data-target="#modal_add_categories"><?php echo $lang_array["add"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <!----------------Categories_edit_MODAL---------------->

    <div class="modal fade" id="modal_edit_categories" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array["edit"]; ?></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="edit_modal_content_categories"></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-target="#modal_edit_categories"><?php echo $lang_array["cancel"]; ?></button>
          <button type="button" class="btn btn-primary" id="save_categories_edit" data-toggle="modal" data-dismiss="modal" data-target="#modal_edit_categories"><?php echo $lang_array["ok"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <!----------------Categories_delete_MODAL---------------->

  <div class="modal fade" id="modal_delete_categories" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title"><?php echo $lang_array["really"]; ?></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="delete_modal_content_categories"></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-target="#modal_delete_categories"><?php echo $lang_array["cancel"]; ?></button>
          <button type="button" class="btn btn-primary"  data-toggle="modal" data-dismiss="modal" data-target="#modal_delete_categories" id="delete_categories_confirm"><?php echo $lang_array["delete"]; ?></button>
        </div>
      </div>
    </div>
  </div>
  <!--------------------modal_logs------------------>
<div class="modal fade" id="modal_logs" data-backdrop="false" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title"><?php echo $lang_array['logs']; ?></p>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="container"></div>
            <div class="modal-body">
                <form id="form_logs_datatable" method="post" action="">
                    <table id="logs_table" class="table table-striped table-bordered" style="width:100%">
    <!--                    <table id = "logs_table" class = "table table-striped table-bordered" style="font-size: 14px;">-->
                        <thead>
                        <button class="btn" type="button" onclick="exportTableToCSV('dm_my_history.csv')" value="<?php echo $row["partners_id"] ?>" style="float:right;" data-target="#"><i class="fa fa-arrow-down" ></i> <?php echo $lang_array["excel_export"]; ?></button>
                        <br>
                        <br>

                        <tr>
                            <td style="width:25%"><?php echo $lang_array["date"]; ?></td>
                            <td style="width:75%"><?php echo $lang_array['subject']; ?></td>

                        </tr>
                        </thead>
                        <tbody>
                        

                            <?php
                            $sql_logs = "SELECT * FROM out_email_log WHERE user_id=" . $user_id . " ORDER BY out_email_date DESC ";
                            $result_logs = $conn->query($sql_logs);
                            while ($row = mysqli_fetch_array($result_logs)) {
                                echo '
                               <tr>  
                                    <td>' . $row["out_email_date"] . '</td>  
                                    <td>' . $row["out_email_subject"] . '</td>  
                               </tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                </form>
                
</table>

            </div>
            <div class="modal-footer">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>
        </div>
    </div>
</div>

<!------------User_modal--------------------->
<div class="modal fade" id="modal_user" data-backdrop="false" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title"><?php echo $lang_array['profil']; ?></p>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="container"></div>
            <div class="modal-body">
                            <?php
								echo $lang_array['user_name']." : ".$user_login_name."<br>";
								echo $lang_array['full_name']." : ".$user_full_name."<br>";
								echo $lang_array['target_email']." : ".$user_target_email."<br>";
                            ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
  <script src="dm_functions.js"></script>
  <script> $('.chosen').chosen();</script>

</body>

</html>