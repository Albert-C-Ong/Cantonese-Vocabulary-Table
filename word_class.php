<?php
/* Written by Albert Ong
 *
 * Revision: 2019.12.21
 */ 


class Word {
  
  public $chinese;
  public $jyutping;
  public $pinyin; 
  public $english; 
  
  public $category; 
  public $subcategory; 
  public $subcategory2; 
  
  public function __construct($ch, $jyut, $pn, $eng, $sub, $subcat, $subcat2) {
    
    $this -> chinese = $ch;
    $this -> jyutping = $jyut; 
    $this -> pinyin = $pn; 
    $this -> english = $eng; 
    
    $this -> category = $sub; 
    $this -> subcategory = $subcat;  
    $this -> subcategory2 = $subcat2; 
  }
  
  public function __toString() {
    
    $ch = (string) $this -> chinese; 
    $jyut = (string) $this -> jyutping; 
    $pn = (string) $this -> pinyin; 
    $eng = (string) $this -> english; 
    
    return "($ch, $jyut, $pn, $eng)<br>";
  }
  
  public function getCategories() {
    
     $category_array = array($this -> category);
      
     if (!empty($this -> subcategory)) {
       array_push($category_array, $this -> subcategory);
     }
    
     if (!empty($this -> subcategory2)) {
       array_push($category_array, $this -> subcategory2);
     }
    
     $categories = join("-", $category_array); 
    
    return $categories; 
  }
}

function cmp_word($a, $b) {

  $a_ch = $a -> chinese;
  $b_ch = $b -> chinese; 
  
//  if (strpos($a_ch, '<br>') !== false) {
//    $a_len = explode("<br>", $a);
//  }

  $a_len = strlen($a -> chinese); 
  $b_len = strlen($b -> chinese); 

  if ($a_len == $b_len) {
    return strcmp($a -> jyutping, $b -> jyutping);
  }
  else {
    return $a_len > $b_len;
  }
}



//function main() {
//  
//  $words_file = simplexml_load_file("database/words.xml") or die("Error: Cannot create object");
//  
//  $word_array = array(); 
//  
//  foreach ($words_file -> children() as $word) {
//    
//    $chinese = $word -> chinese;
//    $jyutping = $word -> jyutping;
//    $pinyin = $word -> pinyin;
//    $english = $word -> english;
//    
//    $word_obj = new Word($chinese, $jyutping, $pinyin, $english); 
//    
//    array_push($word_array, $word_obj); 
//  }
//  
//  usort($word_array, "cmp_word"); 
//  
//  foreach ($word_array as $key => $value) {
//    echo $value;
//  }
//}
//
//if (basename(__FILE__, '.php') == "word_class") {
//  main();
//}

?>