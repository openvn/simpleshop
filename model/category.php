<?php

require_once 'entity.php';
require_once dirname( __FILE__ ).'/../util/modeltool.php';

/**
 * This class associated with categories table in database
 */
class Category implements Entity {

    private $cat_id;
    private $cat_name;
    private $cat_is_main;
    private $cat_parent;

    /**
     * @param int $id
     */
    function setId($id) {
        $this->cat_id = (int) $id;
    }

    /**
     * @return int
     */
    function getId() {
        return $this->cat_id;
    }

    /**
     * @param string $name
     */
    function setName($name) {
        $this->cat_name = addcslashes(mysql_real_escape_string($name), '%_');
    }

    /**
     * @return string
     */
    function getName() {
        return $this->cat_name;
    }

    /**
     * @param bool $is_main
     */
    function setMain($is_main) {
        $this->cat_is_main = (bool) $is_main;
        if ($this->cat_is_main) {
            $this->cat_parent = 0;
        }
    }

    /**
     * @return boolean
     */
    function getMain() {
        return $this->cat_is_main;
    }

    /**
     * @param int $id
     */
    function setParent($id) {
        $this->cat_parent = (int) $id;
        if ($this->cat_parent > 0) {
            $this->cat_is_main = false;
        }
    }

    /**
     * 
     * @return int
     */
    function getParent() {
        return $this->cat_parent;
    }

    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO categories (cat_name, cat_is_main, cat_parent)
				VALUES ('%s', %d, %s);",
                $this->cat_name,
                $this->cat_is_main,
                isNullVal($this->cat_parent));
    }

    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE categories
				SET cat_name = '%s', cat_is_main = %d, cat_parent = %d
				WHERE cat_id = %d;",
                $this->cat_name,
                $this->cat_is_main,
                isNullVal($this->cat_parent),
                $this->cat_id);
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM categories
				WHERE cat_id = %d;", $this->cat_id);
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT cat_id, cat_name, cat_is_main, cat_parent
				FROM categories
				WHERE cat_id = %d;", (int) $id);
    }

}

?>