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
    /**
     * @var Auth
     */
    protected $auth;
    function __construct() {
        $this->tmpl = new Template;
        $this->db = new Model(LoadSetting('db_host'), LoadSetting('db_user'), LoadSetting('db_pass'), LoadSetting('db_name'));
        $this->auth = new Auth($this->db);
    }
    function NotFound() {
        $this->tmpl->NotFound();
    }
    abstract function Index();
}

?>