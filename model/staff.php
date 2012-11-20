<?php

require_once 'entity.php';

/**
 * This class associated with staffs table in database
 */
class Staff implements Entity {

    private $staff_id;
    private $staff_email;
    private $staff_pass;
    private $staff_first_name;
    private $staff_last_name;
    private $staff_phone;
    private $staff_address;
    private $staff_gender;
    private $staff_birth;
    private $staff_kind;
    
    /**
     * 
     * @param int $id
     */
    function setId($id) {
        $this->staff_id = (int) $id;
    }

    /**
     * 
     * @return int
     */
    function getId() {
        return $this->staff_id;
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
        $this->staff_email = $email;
    }

    /**
     * 
     * @return string
     */
    function getEmail() {
        return $this->staff_email;
    }

    /**
     * 
     * @param int $pass
     */
    function setPass($pass) {
        $this->staff_pass = md5(sha1($pass . $this->staff_email));
    }

    /**
     * return the encrypted password
     * @return string
     */
    function getPassEncrypted() {
        return $this->staff_pass;
    }

    /**
     * 
     * @param string $first_name
     */
    function setFirstName($first_name) {
        $this->staff_first_name = addcslashes(mysql_real_escape_string($first_name), '%_');
    }

    /**
     * 
     * @return string
     */
    function getFirstName() {
        return $this->staff_first_name;
    }

    /**
     * 
     * @param string $last_name
     */
    function setLastName($last_name) {
        $this->staff_last_name = addcslashes(mysql_real_escape_string($last_name), '%_');
    }

    /**
     * 
     * @return int
     */
    function getLastName() {
        return $this->staff_last_name;
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
        $this->staff_phone = $phone;
    }

    /**
     * 
     * @return string
     */
    function getPhone() {
        return $this->staff_phone;
    }

    /**
     * 
     * @param string $address
     */
    function setAddress($address) {
        $this->staff_address = addcslashes(mysql_real_escape_string($address), '%_');
    }

    /**
     * 
     * @return string
     */
    function getAddress() {
        return $this->staff_address;
    }

    /**
     * 
     * @param bool $gender true for man, false for woman
     */
    function setGender($gender) {
        $this->staff_gender = (bool) $gender;
    }

    /**
     * 
     * @return bool
     */
    function getGender() {
        return $this->staff_gender;
    }

    /**
     * 
     * @param DateTime $birth
     */
    function setBirth(DateTime $birth) {
        $this->staff_birth = $birth->format('Y-m-d');
    }

    /**
     * 
     * @return \DateTime
     */
    function getBirth() {
        return new DateTime($this->staff_birth);
    }
    
    /**
     * 
     * @param int $kind
     */
    function setKind($kind) {
        $this->staff_kind = (int) $kind;
    }

    /**
     * 
     * @return int
     */
    function getKind() {
        return $this->staff_kind;
    }
    
    /**
     * @see Entity::toDeleteByIdQuery()
     */
    public function toDeleteByIdQuery() {
        return sprintf("DELETE FROM `staffs`
            WHERE `staff_id` = %d;", $this->staff_id);
    }

    /**
     * @see Entity::toInsertQuery()
     */
    public function toInsertQuery() {
        return sprintf("INSERT INTO `staffs`(`staff_email`, `staff_pass`, `staff_first_name`,
            `staff_last_name`, `staff_phone`, `staff_address`, `staff_gender`, `staff_birth`, `staff_kind`)
            VALUES ('%s','%s','%s','%s','%s','%s',%d,'%s',%d);");
    }

    /**
     * @see Entity::toUpdateByIdQuery()
     */
    public function toUpdateByIdQuery() {
        return sprintf("INSERT INTO `staffs`(`staff_email`, `staff_pass`, `staff_first_name`,
            `staff_last_name`, `staff_phone`, `staff_address`, `staff_gender`, `staff_birth`, `staff_kind`)
            VALUES ('%s','%s','%s','%s',%d,'%s',%d,'%s', %d);",
        $this->staff_email,
        $this->staff_pass,
        $this->staff_first_name,
        $this->staff_last_name,
        $this->staff_phone,
        $this->staff_address,
        $this->staff_gender,
        $this->staff_birth,
        $this->staff_kind);
    }

    /**
     * @see Entity::toSelectByIdQuery()
     */
    public static function toSelectByIdQuery($id) {
        return sprintf("SELECT `staff_id`, `staff_email`, `staff_pass`, `staff_first_name`, `staff_last_name`, `staff_phone`, `staff_address`, `staff_gender`, `staff_birth`, `staff_kind`
            FROM `staffs` WHERE = %d;", (int) $id);
    }

}

?>