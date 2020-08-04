<?php
/* Written by Albert Ong
 *
 * A class that represents a word in the vocabulary table.
 * Used for sorting and printing words. 
 */ 

class Word {
  
  public $chinese, 
         $jyutping, 
         $pinyin, 
         $english, 
         $category, 
         $subcategory, 
         $subcategory2; 
  
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
  
  // Coverts the Word into an HTML table row. 
  public function toTableRow() {
    
    $ch = (string) $this -> chinese; 
    $jyut = (string) $this -> jyutping; 
    $pn = (string) $this -> pinyin; 
    $eng = (string) $this -> english; 
    
    return "<tr> 
              <td>$ch</td> <td>$jyut</td> <td>$pn</td> <td>$eng</td> 
            </tr>";
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


// Comparison function for two Word objects. 
function cmp_word($a, $b) {

  $a_len = strlen($a -> chinese); 
  $b_len = strlen($b -> chinese); 
  
  if ($a_len == $b_len) {
    return strcmp($a -> jyutping, $b -> jyutping);
  }
  else {
    return $a_len > $b_len;
  }
}
?>