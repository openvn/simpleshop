<?php
abstract class Controller {
    /**
     *
     * @var Template
     */
    protected $tmpl;
    /**
     *
     * @var Model
     */
    protected $db;
    function __construct() {
        $this->tmpl = new Template;
        $this->db = new Model(LoadSetting('db_host'), LoadSetting('db_user'), LoadSetting('db_pass'), LoadSetting('db_name'));
    }
    function NotFound() {
        $this->tmpl->NotFound();
    }
    abstract function Index();
}

?>