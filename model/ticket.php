<?php

require_once 'entity.php';
require_once dirname( __FILE__ ).'/../util/modeltool.php';

/**
 * This class associated with tickets table in database
 */
class Ticket implements Entity {
    private $tic_id;
    private $tic_content;
    private $tic_type;
    private $tic_parent;
    private $mem_id;
    
    public function getId() {
        return $this->tic_id;
    }

    public function setId($id) {
        $this->tic_id = (int) $id;
    }

    public function getContent() {
        return $this->tic_content;
    }

    public function setContent($content) {
        $this->tic_content = addcslashes(mysql_real_escape_string($content), '%_');
    }

    public function getType() {
        return $this->tic_type;
    }

    public function setType($type) {
        $this->tic_type = (int) $type;
    }

    public function getParent() {
        return $this->tic_parent;
    }

    public function setParent($id) {
        $this->tic_parent = (int) $id;
    }

    public function getMember() {
        return $this->mem_id;
    }

    public function setMember($id) {
        $this->mem_id = (int) $id;
    }
    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM `tickets`
            WHERE `tic_id`=%d;", $this->tic_id);
    }
    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO `tickets`(`tic_content`, `tic_type`, `tic_parent`, `mem_id`)
            VALUES ('%s',%d,%s,%s);",
        $this->tic_content,
        $this->tic_type,
        isNullVal($this->tic_parent),
        isNullVal($this->mem_id));
    }
    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE `tickets`
            SET `tic_content`='%s',`tic_type`=%d,`tic_parent`=%s,`mem_id`=%s
            WHERE `tic_id`=%d;",
        $this->tic_content,
        $this->tic_type,
        isNullVal($this->tic_parent),
        isNullVal($this->mem_id),
        $this->tic_id);
    }
    /**
     * @see Entity::toSelectByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `tic_id`, `tic_content`, `tic_type`, `tic_parent`, `mem_id`
            FROM `tickets` WHERE `tic_id`= %d;", (int) $id);
    }
}

?>
