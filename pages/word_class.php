<?php
/* Written by Albert Ong
 *
 * A class that represents a word in the vocabulary table.
 * Used for sorting and printing words. 
 */ 

class Word {
  
  public $chinese, 
         $chinese_variation, 
         $jyutping, 
         $pinyin, 
         $english, 
         $priority;
  
  public function __construct($ch, $ch_var, $jyut, $pn, $eng) {
    
    $this -> chinese = $ch;
    $this -> chinese_variation = $ch_var; 
    $this -> jyutping = $jyut; 
    $this -> pinyin = $pn; 
    $this -> english = $eng; 
  }
  
  public function __toString() {
    
    $ch = $this -> chinese; 
    $jyut = $this -> jyutping; 
    $pn = $this -> pinyin; 
    $eng = $this -> english; 
    
    return "($ch, $jyut, $pn, $eng)<br>";
  }
  
  // Coverts the Word into an HTML table row. 
  public function to_table_row() {
    
    $ch = $this -> chinese; 
    $jyut = $this -> jyutping; 
    $pn = $this -> pinyin; 
    $eng = $this -> english;  
    
    $var = $this -> chinese_variation; 
    $ch_var = $var != null ? "<br>$var" : null; 
    
    return "<tr> 
              <td>$ch$ch_var</td> <td>$jyut</td> <td>$pn</td> <td>$eng</td> 
            </tr>";
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