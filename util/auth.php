<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author nvcnvn
 */
class Auth {
    private $db;
    function __construct(Model $model) {
        $this->db = $model;
    }
    /**
     * 
     * @param string $mem_email
     * @param string $mem_pass
     * @return boolean|Member
     */
    function MemberVerify($mem_email, $mem_pass) {
        $mem = $this->db->FindMember($mem_email, md5(sha1($mem_pass . $mem_email)));
        if(!$mem) {
            return FALSE;
        }
        return $mem;
    }
    /**
     * 
     * @param string $mem_email
     * @param string $mem_pass
     * @param boolean $remember
     */    
    function MemberLoggin($mem_email, $mem_pass, $remember) {
        $mem = $this->MemberVerify($mem_email, $mem_pass);
        if(!$mem) {
            return FALSE;
        }
        $_SESSION['mem_logged'] = TRUE;
        $_SESSION['mem_info'] = $mem;
        return TRUE;
    }
    /**
     * 
     * @return boolean
     */
    function IsMember() {
        if(isset($_SESSION['mem_logged'])) {
            return TRUE;
        }
        return FALSE;
    }
    /**
     * 
     * @param string $staff_email
     * @param string $staff_pass
     * @return boolean|Staff
     */    
    function  StaffVerify($staff_email, $staff_pass) {
        $staff = $this->db->FindStaff($staff_email, md5(sha1($staff_pass . $staff_email)));
        if(!$staff) {
            return FALSE;
        }
        return $staff;
    }
    /**
     * 
     * @param string $staff_email
     * @param string $staff_pass
     * @param boolean $remember
     */    
    function  StaffLoggin($staff_email, $staff_pass, $remember) {
        $staff = $this->StaffVerify($staff_email, $staff_pass);
        if(!$staff) {
            return FALSE;
        }
        $_SESSION['staff_logged'] = TRUE;
        $_SESSION['staff_info'] = $staff;
        return TRUE;
    }
    /**
     * 
     * @return boolean
     */
    function IsStaff() {
        if(isset($_SESSION['staff_logged'])) {
            return TRUE;
        }
        return FALSE;
    }
}

?>
