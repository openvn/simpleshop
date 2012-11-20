<?php

require_once 'entity.php';

/**
 * This class associated with deals table in database
 */
class Deal implements Entity {

    private $deal_id;
    private $deal_banner;
    private $deal_content;
    private $deal_start;
    private $deal_end;
    private $pro_id;

    /**
     * @param int $id
     */
    function setId($id) {
        $this->deal_id = (int) $id;
    }

    /**
     * @return int
     */
    function getId() {
        return $this->deal_id;
    }
    /**
     * @param string $banner
     */
    function setBanner($banner) {
        $this->deal_banner = addcslashes(mysql_real_escape_string($banner), '%_');
    }
    /**
     * @return string
     */
    function getBanner() {
        return $this->deal_banner;
    }

    /**
     * 
     * @param string $cont
     */
    function setContent($cont) {
        $this->deal_content = addcslashes(mysql_real_escape_string($cont), '%_');
    }

    /**
     * 
     * @return string
     */
    function getContent() {
        return $this->deal_content;
    }

    /**
     * 
     * @param DateTime $datetime
     * @throws Exception
     */
    function setStart(DateTime $datetime) {
        if(isset($this->deal_end)) {
            if($datetime > $this->getEnd()) {
                throw new Exception(sprintf('Start must before End (current start: %s, end %s)',
                $datetime->format('Y-m-d'),
                $this->deal_end));
            }
        }
        $this->deal_start = $datetime->format('Y-m-d');
    }

    /**
     * 
     * @return DateTime
     */
    function getStart() {
        return new DateTime($this->deal_start);
    }

    /**
     * 
     * @param DateTime $datetime
     * @throws Exception
     */
    function setEnd(DateTime $datetime) {
        if(isset($this->deal_start)) {
            if ($datetime < $this->getStart()) {
                throw new Exception(sprintf('End must after Start (current start: %s, end %s)',
                $this->deal_start,
                $datetime->format('Y-m-d')));
            }
        }
        $this->deal_end = $datetime->format('Y-m-d');
    }

    /**
     * 
     * @return DateTime
     */
    function getEnd() {
        return new DateTime($this->deal_end);
    }

    /**
     * 
     * @param int $id
     */
    function setProduct($id) {
        $this->pro_id = (int) $id;
    }

    /**
     * 
     * @return int
     */
    function getProduct() {
        return $this->pro_id;
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf('DELETE FROM deals
            WHERE deal_id = %d;', $this->deal_id);
    }
    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO deals(deal_banner. deal_content, deal_start, deal_end, pro_id)
            VALUES ('%s', %s', '%s', '%s', %d);",
        $this->deal_banner,
        $this->deal_content,
        $this->deal_start,
        $this->deal_end,
        $this->pro_id);
    }
    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE deals SET deal_banner = '%s', deal_content = '%s', deal_start = '%s', deal_end = '%s', pro_id = %d
            WHERE deal_id = %d;",
        $this->deal_banner,
        $this->deal_content,
        $this->deal_start,
        $this->deal_end,
        $this->pro_id,
        $this->deal_id);
    }
    /**
     * @see Entity::toSelectByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT deal_id, deal_banner, deal_content, deal_start, deal_end, pro_id
            FROM deals
            WHERE deal_id = %d;", (int) $id);
    }

}

?>
