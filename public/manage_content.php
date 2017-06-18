<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php") ?>
<?php find_selected_page(); ?>
 <div id="main">
   <div id="navigation">
     <?php echo navigation($current_subject, $current_page); ?>
   </div>
   <div id="page">
     <?php if(isset($current_subject)) { ?>
       <h2>Manage Subject</h2>
       Menu name: <?php echo $current_subject["menu_name"]; ?>
     <?php } else if (isset($current_page)) { ?>
       <h2>Manage Page</h2>
       Menu name: <?php echo $current_page["menu_name"]; ?>
     <?php } else { ?>
       <?php echo "Please select a subject or a page" ?>
     <?php } ?>
   </div>
 </div>
<?php include("../includes/layout/footer.php"); ?>
