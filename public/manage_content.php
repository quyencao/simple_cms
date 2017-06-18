<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php") ?>
 <div id="main">
   <div id="navigation">
     <ul class="subjects">
      <?php
         $subjects_set = find_all_subjects();
      ?>
      <?php
        while($subject = mysqli_fetch_assoc($subjects_set)) {
      ?>
        <li>
          <?php echo $subject["menu_name"]; ?>
          <?php
             $pages_set = find_pages_for_subject($subject["id"]);
          ?>
          <ul class="pages">
            <?php
              while($page = mysqli_fetch_assoc($pages_set)) {
            ?>
              <li><?php echo $page["menu_name"]; ?></li>
            <?php
              }
            ?>
            <?php
                  mysqli_free_result($pages_set);
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
