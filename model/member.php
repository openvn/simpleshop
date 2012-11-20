<?php

require_once 'entity.php';

/**
 * This class associated with members table in database
 */
class Member implements Entity {

    private $mem_id;
    private $mem_email;
    private $mem_pass;
    private $mem_first_name;
    private $mem_last_name;
    private $mem_level;
    private $mem_point;
    private $mem_phone;
    private $mem_address;
    private $mem_gender;
    private $mem_birth;

    /**
     * 
     * @param int $id
     */
    function setId($id) {
        $this->mem_id = (int) $id;
    }

    /**
     * 
     * @return int
     */
    function getId() {
        return $this->mem_id;
    }

    /**
     * 
     * @param string $email
     * @throws Exception
     */
    function setEmail($email) {
        if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)) {
            throw new Exception('Invalid email');
        }
        $this->mem_email = $email;
    }

    /**
     * 
     * @return string
     */
    function getEmail() {
        return $this->mem_email;
    }

    /**
     * 
     * @param int $pass
     */
    function setPass($pass) {
        $this->mem_pass = md5(sha1($pass . $this->mem_email));
    }

    /**
     * return the encrypted password
     * @return string
     */
    function getPassEncrypted() {
        return $this->mem_pass;
    }

    /**
     * 
     * @param string $first_name
     */
    function setFirstName($first_name) {
        $this->mem_first_name = addcslashes(mysql_real_escape_string($first_name), '%_');
    }

    /**
     * 
     * @return string
     */
    function getFirstName() {
        return $this->mem_first_name;
    }

    /**
     * 
     * @param string $last_name
     */
    function setLastName($last_name) {
        $this->mem_last_name = addcslashes(mysql_real_escape_string($last_name), '%_');
    }

    /**
     * 
     * @return int
     */
    function getLastName() {
        return $this->mem_last_name;
    }

    /**
     * 
     * @param int $level
     */
    function setLevel($level) {
        $this->mem_level = (int) $level;
    }

    /**
     * 
     * @return int
     */
    function getLevel() {
        return $this->mem_level;
    }

    /**
     * 
     * @param int $point
     */
    function setPoint($point) {
        $this->mem_point = (int) $point;
    }

    /**
     * 
     * @return int
     */
    function getPoint() {
        return $this->mem_point;
    }

    /**
     * 
     * @param string $phone 8-12 digit number
     * @throws Exception
     */
    function setPhone($phone) {
        $len = strlen($phone);
        if ($len > 12 || $len < 8) {
            throw new Exception('Phone number must be 8-12 digit (your phone: '.$phone.' with '.$len.' digit)');
        }
        $this->mem_phone = $phone;
    }

    /**
     * 
     * @return string
     */
    function getPhone() {
        return $this->mem_phone;
    }

    /**
     * 
     * @param string $address
     */
    function setAddress($address) {
        $this->mem_address = addcslashes(mysql_real_escape_string($address), '%_');
    }

    /**
     * 
     * @return string
     */
    function getAddress() {
        return $this->mem_address;
    }

    /**
     * 
     * @param bool $gender true for man, false for woman
     */
    function setGender($gender) {
        $this->mem_gender = (bool) $gender;
    }

    /**
     * 
     * @return bool
     */
    function getGender() {
        return $this->mem_gender;
    }

    /**
     * 
     * @param DateTime $birth
     */
    function setBirth(DateTime $birth) {
        $this->mem_birth = $birth->format('Y-m-d');
    }

    /**
     * 
     * @return \DateTime
     */
    function getBirth() {
        return new DateTime($this->mem_birth);
    }

    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM `members`
            WHERE `mem_id` = %d;", $this->mem_id);
    }

    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO `members`(`mem_email`, `mem_pass`, `mem_first_name`, `mem_last_name`,
            `mem_level`, `mem_point`, `mem_phone`, `mem_address`, `mem_gender`, `mem_birth`)
            VALUES ('%s','%s','%s','%s',%d,%d,'%s','%s',%d,'%s');",
        $this->mem_email,
        $this->mem_pass,
        $this->mem_first_name,
        $this->mem_last_name,
        $this->mem_level,
        $this->mem_point,
        $this->mem_phone,
        $this->mem_address,
        $this->mem_gender,
        $this->mem_birth);
    }

    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("UPDATE `members`
            SET `mem_email`='%s',`mem_pass`='%s',`mem_first_name`='%s',`mem_last_name`='%s',
            `mem_level`=%d,`mem_point`=%d,`mem_phone`='%s',`mem_address`='%s',`mem_gender`=%d,`mem_birth`='%s'
            WHERE `mem_id` = %d;",
        $this->mem_email,
        $this->mem_pass,
        $this->mem_first_name,
        $this->mem_last_name,
        $this->mem_level,
        $this->mem_point,
        $this->mem_phone,
        $this->mem_address,
        $this->mem_gender,
        $this->mem_birth,
        $this->mem_id);
    }

    /**
     * @see Entity::toSelectByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `mem_id`, `mem_email`, `mem_pass`, `mem_first_name`, `mem_last_name`,
            `mem_level`, `mem_point`, `mem_phone`, `mem_address`, `mem_gender`, `mem_birth` FROM `members`
            WHERE `mem_id` = %d;", (int) $id);
    }

}

?>
