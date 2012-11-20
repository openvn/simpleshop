<?php

require_once 'entity.php';

/**
 * This class associated with products table in database
 */
class Product implements Entity {
    private $pro_id;
    private $pro_name;
    private $pro_thumb;
    private $pro_description;
    private $pro_vote;
    private $pro_available;
    private $pro_price;
    private $cat_id;
    
    public function getId() {
        return $this->pro_id;
    }

    public function setId($id) {
        $this->pro_id = (int) $id;
    }

    public function getName() {
        return $this->pro_name;
    }

    public function setName($name) {
        $this->pro_name = addcslashes(mysql_real_escape_string($name), '%_');
    }

    public function getThumb() {
        return $this->pro_thumb;
    }

    public function setThumb($thumb) {
        $this->pro_thumb = addcslashes(mysql_real_escape_string($thumb), '%_');
    }

    public function getDescription() {
        return $this->pro_description;
    }

    public function setDescription($description) {
        $this->pro_description = addcslashes(mysql_real_escape_string($description), '%_');
    }

    public function getVote() {
        return $this->pro_vote;
    }

    public function setVote($vote) {
        $this->pro_vote = (int) $vote;
    }

    public function getAvailable() {
        return $this->pro_available;
    }

    public function setAvailable($available) {
        $this->pro_available = (int) $available;
    }

    public function getPrice() {
        return $this->pro_price;
    }

    public function setPrice($price) {
        $this->pro_price = (int) $price;
    }

    public function getCategory() {
        return $this->cat_id;
    }

    public function setCategory($id) {
        $this->cat_id = (int) $id;
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM `products`
            WHERE `pro_id`=%d;", $this->pro_id);
    }
    /**
     * @see Entity::toInsertQuery()
     */    
    public function toInsertQuery() {
        return sprintf("INSERT INTO `products`(`pro_name`, `pro_thumb`, `pro_description`,
            `pro_vote`, `pro_available`, `pro_price`, `cat_id`)
            VALUES ('%s','%s','%s',%d,%d,%d,%d);",
        $this->pro_name,
        $this->pro_thumb,
        $this->pro_description,
        $this->pro_vote,
        $this->pro_available,
        $this->pro_price,
        $this->cat_id);
    }
    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE `products`
            SET `pro_name`='%s',`pro_thumb`='%s',`pro_description`='%s',
            `pro_vote`=%d,`pro_available`=%d,`pro_price`=%d,`cat_id`=%d
            WHERE `pro_id`=%d;",
        $this->pro_name,
        $this->pro_thumb,
        $this->pro_description,
        $this->pro_vote,
        $this->pro_available,
        $this->pro_price,
        $this->cat_id,
        $this->pro_id);
    }
    /**
     * @see Entity::toSelectByIdQuery()
     */    
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `pro_id`, `pro_name`, `pro_thumb`, `pro_description`, `pro_vote`, `pro_available`, `pro_price`, `cat_id` FROM `products`
            WHERE `pro_id` = %d;", (int) $id);
    }


}

?>
