<?php

require_once 'entity.php';

/**
 * This class associated with oders table in database
 */
class Order implements Entity {

    private $order_id;
    private $order_date;
    private $mem_id;

    /**
     * 
     * @param int $id
     */
    function setId($id) {
        $this->order_id = (int) $id;
    }
    /**
     * 
     * @return int
     */
    function getId() {
        return $this->order_id;
    }
    /**
     * 
     * @param DateTime $date
     */
    function setDate(DateTime $date) {
        $this->order_date = $date->format('Y-m-d');
    }
    /**
     * 
     * @return \DateTime
     */
    function getDate() {
        return new DateTime($this->order_date);
    }
    /**
     * 
     * @param int $id
     */
    function setMember($id) {
        $this->mem_id = (int) $id;
    }
    /**
     * 
     * @return int
     */
    function getMember() {
        return $this->mem_id;
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM `orders_detail`
            WHERE `order_id` = %d;
            DELETE FROM `orders`
            WHERE `order_id` = %d;
            ",
        $this->order_id,
        $this->order_id);
    }
    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO `orders`(`order_id`, `order_date`, `mem_id`)
            VALUES (%d,'%s',%s);",
        $this->order_id,
        $this->order_date,
        isNullVal($this->mem_id));
    }
    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE `orders` SET `order_date`='%s',`mem_id`=%s
            WHERE `order_id`=%d;",
        $this->order_date,
        isNullVal($this->mem_id),
        $this->order_id);
    }
    /**
     * @see Entity::toSelectByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `order_id`, `order_date`, `mem_id` FROM `orders`
            WHERE `order_id` = %d", (int) $id);
    }
}

?>
