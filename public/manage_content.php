<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  // 2. Perform database query
  $query  = "SELECT * ";
  $query .= "FROM subjects ";
  $query .= "WHERE visible = 1 ";
  $query .= "ORDER BY position DESC";
  $result = mysqli_query($connection, $query);
  confirm_query($result);
?>
<?php include("../includes/layout/header.php") ?>
 <div id="main">
   <div id="navigation">
     <ul class="subjects">
      <?php
        // 3. Use return data
        while($subject = mysqli_fetch_assoc($result)) {
      ?>
        <li><?php echo $subject["menu_name"] . "({$subject["id"]})"; ?></li>
      <?php
        }
      ?>
    </ul>
   </div>
   <div id="page">
     <h2>Manage Content</h2>
   </div>
 </div>
<?php
      // 4. Release returned data
      mysqli_free_result($result);
?>
<?php include("../includes/layout/footer.php"); ?>
