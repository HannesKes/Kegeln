<?php

if (ceil($total_rows / $records_per_page) != 1) {

  echo "<ul class='pagination justify-content-center'>";
  // button for first page
  if($page>2){
    echo "<li class='px-2 rounded'><a class='text-dark' href='$page_url' title='Go to the first page.'>1</a></li>";
    if($page>3){ // if there are more than three pages not all numbers are shown
      echo "<li class='px-2 rounded text-dark'>...</li>";
    }
  }

  // calculate total pages
  $total_pages = ceil($total_rows / $records_per_page);

  // range of links to show next to actual page
  $range = 1;

  // display links to 'range of pages' around 'current page'
  $initial_num = $page - $range;
  $condition_limit_num = ($page + $range)  + 1;

  for ($x=$initial_num; $x<$condition_limit_num; $x++) {

      // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
      if (($x > 0) && ($x <= $total_pages)) {

          // current page
          if ($x == $page) {
              echo "<li class='active px-2 rounded border border-primary'><a href='#' class='text-dark'>$x <span class='sr-only'>(current)</span></a></li>";
          }

          // not current page
          else {
              echo "<li class='px-2 rounded text-dark'><a class='text-dark' href='{$page_url}page=$x'>$x</a></li>";
          }
      }
  }

  // button for last page
  if($page<$total_pages){
    if(($total_pages - $page) >= 3){ // not all pages are shown, only the last number is shown
      echo "<li class='px-2 rounded text-dark'>...</li>";
      echo "<li class='px-2 rounded text-dark'><a class='text-dark' href='" .$page_url. "page={$total_pages}' title='Last page is {$total_pages}.'>";
          echo "$total_pages";
      echo "</a></li>";
    } else if(($total_pages - $page) == 2){ // if there are 2 pages left, only the last page is not shown yet
      echo "<li class='px-2 rounded text-dark'><a class='text-dark' href='" .$page_url. "page={$total_pages}' title='Last page is {$total_pages}.'>";
          echo "$total_pages";
      echo "</a></li>";
    } // if there is only one or no page left, the last page is already shown in the loop above
  }

  echo "</ul>";

}
?>
