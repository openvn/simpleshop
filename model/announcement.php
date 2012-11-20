<?php

require_once 'entity.php';

/**
 * This class associated with announcements table in database
 */
class Announcement implements Entity {

    private $ann_id;
    private $ann_description;
    private $ann_content;

    function setId($id) {
        $this->ann_id = (int) $id;
    }

    /**
     * @return int
     */
    function getId() {
        return $this->ann_id;
    }

    function setDescription($des) {
        $this->ann_description = addcslashes(mysql_real_escape_string($des), '%_');
    }

    /**
     * @return string
     */
    function getDescription() {
        return $this->ann_description;
    }

    function setContent($cont) {
        $this->ann_content = addcslashes(mysql_real_escape_string($cont), '%_');
    }

    /**
     * @return string
     */
    function getContent() {
        return $this->ann_content;
    }

    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO announcements (ann_description, ann_content)
                            VALUES ('%s', '%s');",
                $this->ann_description,
                $this->ann_content);
    }

    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE announcements
                            SET ann_description = '%s', ann_content = '%s'
                            WHERE ann_id = %d;",
                $this->ann_description,
                $this->ann_content,
                $this->ann_id);
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM announcements
                            WHERE ann_id = %d;", $this->ann_id);
    }

    /**
     * @see Entity::toSelectByIdQuery($id)
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT ann_id, ann_description, ann_content
                            FROM announcements
                            WHERE ann_id = %d;", (int) $id);
    }

}

?>