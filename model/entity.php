<?php

interface Entity {

    /**
     * set primary key for entity
     * @param int $id
     */
    public function setId($id);

    /**
     * return a SQL insert query string for this entry
     * @return string
     */
    public function toInsertQuery();

    /**
     * return a SQL update query string for this entry
     * @return string
     */
    public function toUpdateByIdQuery();

    /**
     * return a SQL delete query string for this entry
     * @return string
     */
    public function toDeleteByIdQuery();

    /**
     * return a SQL select query string base on the $id
     * @static
     * @param int $id
     * @return string
     */
    public static function toSelectByIdQuery($id);
}

?>