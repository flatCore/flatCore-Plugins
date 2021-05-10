<?php
	
/**
 * send: '<input type="hidden" name="math_key" value="'.$rand_keys.'">';
 * check:
 
 if(isset($_POST['math_key'])) {
		if($_POST['math_a'] != $math_a[$_POST['math_key']]) {
			$sendform = false;
		}
	}
 
 */

$math_q = array('5+5','7+4','8-3','9-6','10-4','5+2','6+8','8+3','15-12','5+15','7+2','8+4','8-4');
$math_a = array(10,11,5,3,6,7,14,11,3,20,9,12,4);
$rand_keys = array_rand($math_q, 1);

?>