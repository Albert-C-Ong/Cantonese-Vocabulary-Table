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
         $priority;
  
  public function __construct($ch, $jyut, $pn, $eng, $prio = null) {
    
    $this -> chinese = $ch;
    $this -> jyutping = $jyut; 
    $this -> pinyin = $pn; 
    $this -> english = $eng; 
    $this -> priority = $prio; 
  }
  
  public function __toString() {
    
    $ch = (string) $this -> chinese; 
    $jyut = (string) $this -> jyutping; 
    $pn = (string) $this -> pinyin; 
    $eng = (string) $this -> english; 
    
    return "($ch, $jyut, $pn, $eng)<br>";
  }
  
  // Coverts the Word into an HTML table row. 
  public function to_table_row() {
    
    $ch = (string) $this -> chinese; 
    $jyut = (string) $this -> jyutping; 
    $pn = (string) $this -> pinyin; 
    $eng = (string) $this -> english; 
    
    return "<tr> 
              <td>$ch</td> <td>$jyut</td> <td>$pn</td> <td>$eng</td> 
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