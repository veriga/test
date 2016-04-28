<?php
$s = '10 яблуко впало на підлоогу та розбився';
$s_false = array('яблуко', 'підлоогу', 'розбився');
$s_true = array('яблук', 'підлогу', 'розбилось');
$s_result = str_replace($s_false, $s_true, $s);
echo $s_result;