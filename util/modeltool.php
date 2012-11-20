<?php
/**
 * return $val itself or  NULL if $val is not set
 * @param mixed $val
 * @return mixed
 */
function isNullVal($val) {
    if(isset($val)) {
        return $val;
    }
    return 'NULL';
}
?>
