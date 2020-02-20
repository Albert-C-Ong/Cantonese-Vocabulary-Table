<?php
/* Written by Albert Ong
 *
 * Revision: 2019.12.21
 */ 

include "word_class.php"; 


function countCategories($categories) {
  
  $count = 0;
  
  foreach ($categories -> children() as $category) {
    
    $tag_name = $category -> getName();
    
    if ($tag_name == "subcategories") {
      $count += countCategories($category);
    }
    else {
      $count += 1;
    }
  }
  
  return $count; 
}


function printCategories($categories, 
                         $head = true, 
                         $subhead = false, 
                         $dividing_indices = array(), 
                         $count = 0, 
                         $parent = "") {
  
  global $link_to_header; 
  
  if ($head) {
    
    echo "<td><ul>"; 
    
    $total_category_count = countCategories($categories); 
  
    for ($i = 1; $i < 4; $i++) {

      $index = ceil($division + ($i * ($total_category_count / 4))); 

      array_push($dividing_indices, $index); 
    }
  }
  
  
  foreach ($categories -> children() as $category) {
    
    $tag_name = $category -> getName(); 
     
    if ($tag_name == "subcategories") {
      
       $next_subhead = true; 
      
       if ($subhead == true) {
         $next_subhead = false;
       }
      
       $subcat_parent = $category["parent"]; 
      
       if ($parent == "") {
         $next_parent = "$subcat_parent";
       }
      else {
        $next_parent = "$parent-$subcat_parent";;
      }
      
       $count = printCategories($category, false, $next_subhead, $dividing_indices, $count, $next_parent);   
    }
    
    else {
      $name = $category -> name;
      $name_lower = strtolower($name); 
      
      $chinese = $category -> chinese; 

      $incomplete = $category["incomplete"]; 

      $incomplete_text = ""; 
      
      if ($incomplete != '') {
        $incomplete_text = "(incomplete)";
      }
      
      
      if ($parent == "") {
        $category_link = strtolower($name);
      }
      else {
        $category_link = strtolower("$parent-$name");
      }
      
      $category_link = str_replace(" ", "-", $category_link);

      $link_to_header[$category_link] = "$name ($chinese)"; 
      
      if (!$head && !$subhead) {
        echo "<ul><ul><li><a href='#$category_link'>$name ($chinese) $incomplete_text</a></li></ul></ul>\n"; 
      }
      
      else if (!$head) {
        echo "<ul><li><a href='#$category_link'>$name ($chinese) $incomplete_text</a></li></ul>\n"; 
      }
      
      else {
        echo "<li><a href='#$category_link'>$name ($chinese) $incomplete_text</a></li>\n"; 
      }
      
      $count += 1; 
      
      if (in_array($count, $dividing_indices)) {
        echo "</ul></td>\n<td><ul>"; 
      } 
    }
  }
  
  if ($count == countCategories($categories)) {
    echo "</ul></td>"; 
  }
  
  
  return $count; 
}


function printWords($words, $link_to_header) {
  
  $buckets = array(); 
  
  foreach ($words -> children() as $word) {
    
    $chinese = $word -> chinese;
    $jyutping = $word -> jyutping;
    $pinyin = $word -> pinyin;
    $english = $word -> english;
    
    $category = $word["category"]; 
    $subcategory = $word["subcategory"]; 
    $subcategory2 = $word["subcategory2"]; 
    
    $word_obj = new Word($chinese, $jyutping, $pinyin, $english, $category, $subcategory, $subcategory2); 
    
    $categories = $word_obj -> getCategories(); 
    
    
    if (array_key_exists($categories, $buckets)) {
      array_push($buckets[$categories], $word_obj); 
    }
    else {
      $buckets[$categories] = array($word_obj);
    }
  }
  
  foreach ($buckets as $category => $bucket) {
    
    usort($bucket, "cmp_word"); 
    
    echo 
    "<h1 id='$category'>$link_to_header[$category]</h1>
      <table>
      <tr>
        <th>Trad. Chinese <br>正體中文</th>
        <th>Jyutping <br>粵拼</th>
        <th>Pinyin <br>拼音 </th>
        <th>English <br>英文</th>
      </tr>"; 
    
    foreach ($bucket as $word) {
      
      echo $word -> toTableRow(); 
      
//      $chinese = $word -> chinese;
//      $jyutping = $word -> jyutping;
//      $pinyin = $word -> pinyin;
//      $english = $word -> english;
//      
//      echo "<tr> 
//              <td>$chinese</td> <td>$jyutping</td> <td>$pinyin</td> <td>$english</td> 
//            </tr> "; 
    }
  
    echo "</table>";
  }
}
?>


<html>

<head>
  <title>Cantonese Vocabulary Table</title> 
  <link rel="stylesheet" type="text/css" href="assets/master.css">
</head>

<body>
  <h1>Cantonese Vocabulary Table<br>廣東話詞彙圖表</h1>
  
  <table class="table-of-contents">
    <tr>
      <td class="heading" colspan="4"><h2>Table of Contents (目錄)</h2></td>
    </tr>
    <tr>
        <?php
          $categories_file = simplexml_load_file("database/categories.xml") or die("Error: Cannot create object");

          printCategories($categories_file);
        ?>
    </tr>
  </table>
  
  <?php
  $words_file = simplexml_load_file("database/words.xml") or die("Error: Cannot create object");

  printWords($words_file, $link_to_header);     
  ?>
  
  <!-- Additional resources and websites -->
  <h1 id="resources">Resources (資源)</h1>
  <ul>
    <li><a href="https://www.cantoneseclass101.com/cantonese-dictionary/">cantoneseclass101.com</a></li>
    <li><a href="http://www.cantonese.sheik.co.uk/">cantonese.sheik.co.uk</a></li>
    <li><a href="https://www.mdbg.net/chinese/dictionary">mdbg.net</a></li>
    <li><a href="http://mylanguages.org/learn_cantonese.php">mylanguages.org</a></li>
    <li><a href="https://cantonese.ca/">cantonese.ca</a></li>
  </ul>
</body>

</html>

