<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php") ?>
 <div id="main">
   <div id="navigation">
     <ul class="subjects">
      <?php
         $query  = "SELECT * ";
         $query .= "FROM subjects ";
         $query .= "WHERE visible = 1 ";
         $query .= "ORDER BY position ASC";
         $subjects_set = mysqli_query($connection, $query);
         confirm_query($subjects_set);
      ?>
      <?php
        while($subject = mysqli_fetch_assoc($subjects_set)) {
      ?>
        <li>
          <?php echo $subject["menu_name"]; ?>
          <?php
             $query  = "SELECT * ";
             $query .= "FROM pages ";
             $query .= "WHERE visible = 1 AND ";
             $query .= "subject_id = {$subject["id"]} ";
             $query .= "ORDER BY position ASC";
             $pages_set = mysqli_query($connection, $query);
             confirm_query($pages_set);
          ?>
          <ul class="pages">
            <?php
              while($page = mysqli_fetch_assoc($pages_set)) {
            ?>
              <li><?php echo $page["menu_name"]; ?></li>
            <?php
              }
            ?>
          </ul>
        </li>
      <?php
        }
      ?>
      <?php
            mysqli_free_result($subjects_set);
      ?>
    </ul>
   </div>
   <div id="page">
     <h2>Manage Content</h2>
   </div>
 </div>
<?php include("../includes/layout/footer.php"); ?>
