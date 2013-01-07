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
    private $pro_sim;
    private $pro_touch;
    private $pro_camera;
    private $pro_wifi;
    private $pro_3g;
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
    
    public function setSim($sim) {
        $this->pro_sim = (int) $sim;
    }
    
    public function getSim() {
        return $this->pro_sim;
    }

    public function setCamera($camera) {
        $this->pro_camera = (bool) $camera;
    }
    
    public function getCamera() {
        return $this->pro_camera;
    }

    public function setTouch($touch) {
        $this->pro_touch = (bool) $touch;
    }
    
    public function getTouch() {
        return $this->pro_touch;
    }
    
    public function setWifi($wifi) {
        $this->pro_wifi = (bool) $wifi;
    }
    
    public function getWifi() {
        return $this->pro_wifi;
    }
    
    public function set3G($yes) {
        $this->pro_3g = (bool) $yes;
    }
    
    public function get3G() {
        return $this->pro_3g;
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
            `pro_vote`, `pro_available`, `pro_price`, `pro_sim`, `pro_touch`, `pro_camera`,
            `pro_wifi`, `pro_3g`, `cat_id`)
            VALUES ('%s','%s','%s',%d,%d,%d,%d,%d,%d,%d,%d,%d);",
        $this->pro_name,
        $this->pro_thumb,
        $this->pro_description,
        $this->pro_vote,
        $this->pro_available,
        $this->pro_price,
        $this->pro_sim,
        $this->pro_touch,
        $this->pro_camera,
        $this->pro_wifi,
        $this->pro_3g,
        $this->cat_id);
    }
    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE `products`
            SET `pro_name`='%s',`pro_thumb`='%s',`pro_description`='%s',
            `pro_vote`=%d,`pro_available`=%d,`pro_price`=%d, `pro_sim`=%d,
            `pro_touch`=%d, `pro_camera`=%d, `pro_wifi`=%d, `pro_3g`=%d,`cat_id`=%d
            WHERE `pro_id`=%d;",
        $this->pro_name,
        $this->pro_thumb,
        $this->pro_description,
        $this->pro_vote,
        $this->pro_available,
        $this->pro_price,
        $this->pro_sim,
        $this->pro_touch,
        $this->pro_camera,
        $this->pro_wifi,
        $this->pro_3g,
        $this->cat_id,
        $this->pro_id);
    }
    /**
     * @see Entity::toSelectByIdQuery()
     */    
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `pro_id`, `pro_name`, `pro_thumb`, `pro_description`, `pro_vote`, `pro_available`, `pro_price`, `pro_sim`, `pro_touch`, `pro_camera`, `pro_wifi`, `pro_3g`, `cat_id` FROM `products`
            WHERE `pro_id` = %d;", (int) $id);
    }


}

?>
