<?php

require_once 'entity.php';

/**
 * This class associated with oders_detail table in database
 */
class OrderDetail implements Entity {
    private $detail_id;
    private $order_id;
    private $pro_id;
    private $order_number;
    private $pro_price;
    private $order_sum;
    
    function setId($id) {
        $this->detail_id = (int) $id;
    }
    function getId() {
        return $this->id;
    }
    function setOrderId($id) {
        $this->order_id = (int) $id;
    }
    function getOrderId() {
        return $this->order_id;
    }
    function setProductId($id) {
        $this->pro_id = (int) $id;
    }
    function getProductId() {
        return $this->pro_id;
    }
    function setNumber($num) {
        $this->order_number = (int) $num;
        $this->order_sum = $this->order_number * $this->pro_price;
    }
    function getNumber() {
        return $this->order_number;
    }
    function setProductPrice($price) {
        $this->pro_price = (int) $price;
        $this->order_sum = $this->order_number * $this->pro_price;
    }
    function getProductPrice() {
        return $this->pro_price;
    }
    function getSum() {
        return $this->order_sum;
    }
    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        sprintf("DELETE FROM `orders_detail`
            WHERE `order_id`=%d AND `pro_id`=%d",
        $this->order_id,
        $this->pro_id);
    }
    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO `orders_detail`(`order_id`, `pro_id`, `order_number`, `pro_pirce`, `order_sum`)
            VALUES (%d,%d,%d,%d,%d);",
        $this->order_id,
        $this->pro_id,
        $this->order_number,
        $this->pro_price,
        $this->order_sum);
    }
    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE `orders_detail`
            SET `order_id`=%d, `pro_id`=%d,`order_number`=%d,`pro_pirce`=%d,`order_sum`=%d
            WHERE `order_id`=%d AND `pro_id`=%d;",
        $this->order_id,
        $this->pro_id,
        $this->order_number,
        $this->pro_price,
        $this->order_sum,
        $this->order_id,
        $this->pro_id);
    }
    /**
     * @see Entity::toSelectByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `order_id`, `pro_id`, `order_number`, `pro_pirce`, `order_sum`
            FROM `orders_detail`
            WHERE `order_id` = %d;", (int) $id);
    }
}

?>
