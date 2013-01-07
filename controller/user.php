<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Controller {
    public function Index() {
        
    }
    
    public function Register() {
        
    }
    
    public function Register2() {
        
    }
    
    public function Inbox() {
        if(!$this->auth->IsMember()) {
            return;
        }
    }
}
?>
