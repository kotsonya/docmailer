// modal close event
$('body').on('hidden.bs.modal', function() {
    if ($('.modal.show').length > 0) {
      $('body').addClass('modal-open');
    }

    $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
  });

//-----------------PARTNERS--------------------

  // partner list refresh
  function partnerRefresh() {
    $.ajax({
      type: "POST",
      url: "ajax/partner_refresh.php",
      success: function(data) {
        $('.partner_list').html(data);
      }
    });
  }

  // ajax calls
  $('.partner_list').on('click', 'a.edit_partner', function() {
    var id = $(this).data('id');
    $.ajax({
      type: "POST",
      url: "ajax/partner_edit.php",
      data: {
        id: id
      },
      success: function(data) {
        $('.edit_modal_content').html(data);
      }
    })
  });

  $('#add_partner').click(function() {
    var name = $('#partner_name').val();
    var address = $('#partner_address').val();
    var contact = $('#partner_contacts').val();

    $.ajax({
      type: "POST",
      url: "ajax/add_partner.php",
      data: {
        partner_name: name,
        partner_address: address,
        partner_contact: contact
      },
      success: function() {
        partnerRefresh();
      }
    })
  });

  $('#save_partner_edit').click(function() {
    var id = $('#partner_id_edit').val();
    var name = $('#partner_name_edit').val();
    var address = $('#partner_address_edit').val();
    var contact = $('#partner_contacts_edit').val();

    $.ajax({
      type: "POST",
      url: "ajax/partner_save_edit.php",
      data: {
        id: id,
        partner_name: name,
        partner_address: address,
        partner_contact: contact
      },
      success: function() {
        partnerRefresh();
      }
    })
  });

  $('.partner_list').on('click', 'a.delete_partner', function() {
    var val = $(this).data('id');
    $.ajax({
      type: "POST",
      url: "ajax/partner_delete_data.php",
      data: {
        id: val
      },
      success: function(data) {
        $('.delete_modal_content').html(data);
      }
    })
  });

  $('#delete_partner_confirm').click(function() {
    var id = $('#partner_id').val();

    $.ajax({
      type: "POST",
      url: "ajax/partner_delete.php",
      data: {
        id: id
      },
      success: function() {
        partnerRefresh();
      }
    })
  });
  
  //-----------------CATEGORIES--------------------
  // categories list refresh
  function categoriesRefresh() {
    $.ajax({
      type: "POST",
      url: "ajax/categories_refresh.php",
      success: function(data) {
        $('.categories_list').html(data);
		
      }
    });
  }
  
    // ajax calls
  $('.categories_list').on('click', 'a.edit_categories', function() {
    var id = $(this).data('id');
    $.ajax({
      type: "POST",
      url: "ajax/categories_edit.php",
      data: {
        id: id
      },
      success: function(data) {
        $('.edit_modal_content_categories').html(data);
      }
    })
  });

  $('#add_categories').click(function() {
    var category_name = $('#categories_name').val();

    $.ajax({
      type: "POST",
      url: "ajax/add_categories.php",
      data: {
        category_post: category_name
      },
      success: function() {
        categoriesRefresh();
      }
    })
  });

  $('#save_categories_edit').click(function() {
      
    var id = $('#categories_id_edit').val();
    var category_data = $('#categories_data_edit').val();

    $.ajax({
      type: "POST",
      url: "ajax/categories_save_edit.php",
      data: {
        id: id,
        category_data: category_data
      },
      success: function() {
        categoriesRefresh();
      }
    })
  });

  $('.categories_list').on('click', 'a.delete_categories', function() {
    var val = $(this).data('id');
    $.ajax({
      type: "POST",
      url: "ajax/categories_delete_data.php",
      data: {
        id: val
      },
      success: function(data) {
        $('.delete_modal_content_categories').html(data);
      }
    })
  });

  $('#delete_categories_confirm').click(function() {
    var id = $('#categories_id_delete').val();

    $.ajax({
      type: "POST",
      url: "ajax/categories_delete.php",
      data: {
        id: id
      },
      success: function() {
        categoriesRefresh();
      }
    })
  });
  
  
//-------export CSV------------
 function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "data:text/csv;charset=utf-8"});


    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
};

function exportTableToCSV(filename) {
    var csv = [];
    var rows = modal_logs.querySelectorAll("tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(";"));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
};

//-------export_gmail_filters------------
 
 function download_gmail_xml_js(user_id, file_name) {
         $.ajax({
      type: "POST",
      url: "ajax/export_gmail_filters.php",
	  dataType: "text",
      data: {
        user_id: user_id
      },success: function(content) {
	var txtFile;
    // Txt file
	content = content.substr(2);
	console.log("content:", content);
    txtFile = new Blob([content], {type: "data:text;charset=utf-8"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = file_name;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(txtFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
      }, function (err){
		  console.log(err)
	  }
    })
  };

 

$('#sended_email_button').click(function() {
    $.ajax({
      type: "POST",
      url: "ajax/dm_logined.php",
	
  });
  });
  


$("#email_ok_alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#email_ok_alert").slideUp(500);
});

document.getElementById("page_reload_plu").onclick = function() {reload()};

            function reload() {
                window.location = window.location.href.split("?")[0];
            }
            
document.getElementById("page_reload_pld").onclick = function() {reload()};

            function reload() {
                window.location = window.location.href.split("?")[0];
            }
document.getElementById("page_reload_clu").onclick = function() {reload()};

            function reload() {
                window.location = window.location.href.split("?")[0];
            }
document.getElementById("page_reload_cld").onclick = function() {reload()};

            function reload() {
                window.location = window.location.href.split("?")[0];
            }            