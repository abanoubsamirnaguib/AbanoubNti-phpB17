<?php
// echo "hello";

$token = "Bearer 125|Nenh9dMcL4hSjHVHgkr7MDTxouYAY5dRJaoy4fp4" ; 
$tok = substr($token, 0, strpos($token , "|" ));
$int = (int) filter_var($tok, FILTER_SANITIZE_NUMBER_INT); 
echo  $int;
?> 
