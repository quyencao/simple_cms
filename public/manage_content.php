<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php") ?>
<?php
  if(isset($_GET["subject"])) {
    $selectd_subject_id = $_GET["subject"];
    $selectd_page_id = null;
  } else if (isset($_GET["page"])) {
    $selectd_page_id = $_GET["page"];
    $selectd_subject_id = null;
  } else {
    $selectd_page_id = null;
    $selectd_subject_id = null;
  }
?>
 <div id="main">
   <div id="navigation">
     <ul class="subjects">
      <?php
         $subjects_set = find_all_subjects();
      ?>
      <?php
        while($subject = mysqli_fetch_assoc($subjects_set)) {
      ?>
          <?php
              echo "<li";
              if($subject["id"] == $selectd_subject_id) {
                echo " class=\"selected\"";
              }
              echo ">";
          ?>
          <a href="manage_content.php?subject=<?php echo urlencode($subject["id"]); ?>"><?php echo $subject["menu_name"]; ?></a>
          <?php
             $pages_set = find_pages_for_subject($subject["id"]);
          ?>
          <ul class="pages">
            <?php
              while($page = mysqli_fetch_assoc($pages_set)) {
            ?>
              <?php
                  echo "<li";
                  if($page["id"] == $selectd_page_id) {
                    echo " class=\"selected\"";
                  }
                  echo ">";
              ?>
                <a href="manage_content.php?page=<?php echo urlencode($page["id"]); ?>"><?php echo $page["menu_name"]; ?></a>
              </li>
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
     <?php echo $selectd_subject_id ?>
     <?php echo $selectd_page_id ?>
   </div>
 </div>
<?php include("../includes/layout/footer.php"); ?>
