<?php
  function confirm_query($result_set) {
    if(!$result_set) {
      die("Database query failed");
    }
  }

  function find_all_subjects() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC";
    $subjects_set = mysqli_query($connection, $query);
    confirm_query($subjects_set);
    return $subjects_set;
  }

  function find_pages_for_subject($subject_id) {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 AND ";
    $query .= "subject_id = {$subject_id} ";
    $query .= "ORDER BY position ASC";
    $pages_set = mysqli_query($connection, $query);
    confirm_query($pages_set);
    return $pages_set;
  }

  function navigation($subject_id, $page_id) {
     $output = "<ul class=\"subjects\">";
     $subjects_set = find_all_subjects();

     while($subject = mysqli_fetch_assoc($subjects_set)) {
          $output .= "<li";
          if($subject["id"] == $subject_id) {
            $output .= " class=\"selected\"";
          }
          $output .= ">";
          $output .= "<a href=\"manage_content.php?subject=";
          $output .= urlencode($subject["id"]);
          $output .= "\">{$subject["menu_name"]}</a>";

          $pages_set = find_pages_for_subject($subject["id"]);

          $output .= "<ul class=\"pages\">";
             while($page = mysqli_fetch_assoc($pages_set)) {
                 $output .= "<li";
                 if($page["id"] == $page_id) {
                   $output .= " class=\"selected\"";
                 }
                 $output .= ">";
                 $output .= "<a href=\"manage_content.php?page=";
                 $output .= urlencode($page["id"]);
                 $output .= "\">{$page["menu_name"]}</a>";
                 $output .= "</li>";
             }
         mysqli_free_result($pages_set);
         $output .= "</ul>";
         $output .= "</li>";
       }
         mysqli_free_result($subjects_set);
         $output .= "</ul>";

         return $output;
  }
?>
