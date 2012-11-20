<?php
/**
 * Return an url format base on $pretty
 * @param string $controller
 * @param string $action
 * @param array $query
 * @param boolean $pretty
 * @return string
 */
function HREF($controller, $action, $query, $pretty) {
    $root = LoadSetting('location');
    if($pretty) {
        $src = $root.$controller.'/'.$action.'/';
        if(is_null($query) || count($query) < 1) {
            return $src;
        }
        foreach ($query as $key => $val) {
            $src .= $key.'/'.$val.'/';
        }
        return $src;
    }
    $src = $root.'index.php?controller='.$controller.'&action='.$action;
    if(is_null($query) || count($query) < 1) {
        return $src;
    }
    foreach ($query as $key => $val) {
        $src .= '&'.$key.'='.$val;
    }
    return $src;
}
?>
