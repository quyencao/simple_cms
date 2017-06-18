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
    //$query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC";
    $subjects_set = mysqli_query($connection, $query);
    confirm_query($subjects_set);
    return $subjects_set;
  }

  function find_subject_by_id($subject_id) {
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    $query .= "LIMIT 1";
    $subjects_set = mysqli_query($connection, $query);
    confirm_query($subjects_set);
    if($subject = mysqli_fetch_assoc($subjects_set)) {
      return $subject;
    } else {
      return null;
    }
  }

  function find_pages_for_subject($subject_id) {
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 AND ";
    $query .= "subject_id = {$safe_subject_id} ";
    $query .= "ORDER BY position ASC";
    $pages_set = mysqli_query($connection, $query);
    confirm_query($pages_set);
    return $pages_set;
  }

  function find_page_by_id($page_id) {
    global $connection;

    $safe_page_id = mysqli_real_escape_string($connection, $page_id);

    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$page_id} ";
    $query .= "LIMIT 1";

    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    if($page = mysqli_fetch_assoc($page_set)) {
      return $page;
    } else {
      return null;
    }
  }

  function navigation($subject_array, $page_array) {
     $output = "<ul class=\"subjects\">";
     $subjects_set = find_all_subjects();

     while($subject = mysqli_fetch_assoc($subjects_set)) {
          $output .= "<li";
          if($subject_array && $subject["id"] == $subject_array["id"]) {
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
                 if($page_array && $page["id"] == $page_array["id"]) {
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

  function find_selected_page() {
    global $current_subject;
    global $current_page;
    
    if(isset($_GET["subject"])) {
      $current_subject = find_subject_by_id($_GET["subject"]);
      $current_page = null;
    } else if (isset($_GET["page"])) {
      $current_page = find_page_by_id($_GET["page"]);
      $current_subject = null;
    } else {
      $current_subject = null;
      $current_page = null;
    }
  }
?>
