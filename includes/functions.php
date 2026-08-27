<?php
/* functions.php
 *
 * Written by Albert Ong
 */ 

function formatJyutpingTones($jyutping) {

    $formatted_jyutping = "";
    $jyutping_words = explode(" ", $jyutping);

    foreach ($jyutping_words as $word) {

        $tone_number = $word[-1];
        $syllable = substr($word, 0, -1);

        if (is_numeric($tone_number)) {
            $formatted_jyutping .= "$syllable<img src='../assets/SVG/tone$tone_number.svg' height='22'> ";
        }
        else {
            $formatted_jyutping .= "$word ";
        }
        
    }

    return $formatted_jyutping; 
}
?>