<?php

require_once 'entity.php';
require_once 'announcement.php';
require_once 'category.php';
require_once 'deal.php';
require_once 'member.php';
require_once 'order.php';
require_once 'orderdetail.php';
require_once 'product.php';
require_once 'staff.php';
require_once 'ticket.php';

class Model {

    private $conn;
    private $err;
    
    public function __construct($server, $username, $password, $dbname) {
        $this->conn = new mysqli($server, $username, $password, $dbname);
        if ($this->conn->connect_errno) {
            die('Could not connect to server: (' . $this->connect_errno . ') ' . $this->conn->connect_error);
        }
    }
    
    /**
     * 
     * @return string
     */
    function Error() {
        return $this->err;
    }

    /**
     * 
     * @param Entity $entry
     * @return bool
     */
    public function InsertEntry(Entity $entry) {
        if ($this->conn->query($entry->toInsertQuery())) {
            $entry->setId($this->conn->insert_id);
            return true;
        }
        $this->err = $this->conn->error;
        return false;
    }
    /**
     * 
     * @param Entity $entry
     * @return bool
     */
    public function UpdateEntry(Entity $entry) {
        if ($this->conn->query($entry->toUpdateByIdQuery())) {
            return true;
        }
        $this->err = $this->conn->error;
        return false;
    }
    /**
     * 
     * @param Entity $entry
     * @return bool
     */
    public function DeleteEntry(Entity $entry) {
        if ($this->conn->query($entry->toDeleteByIdQuery())) {
            return true;
        }
        $this->err = $this->conn->error;
        return false;
    }

    /**
     * Return a category entry with given $id
     * @param int $id
     * @return Category|false return a category entry or false if not found
     */
    public function CategoryById($id) {
        $result = $this->conn->query(Category::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Category');
        }
        $this->err = $this->conn->error;
        return false;
    }
    /**
     * Return an announcement entry with given $id
     * @param int $id
     * @return Announcement|boolean
     */
    public function AnnouncementById($id) {
        $result = $this->conn->query(Announcement::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Announcement');
        }
        $this->err = $this->conn->error;
        return false;       
    }
    /**
     * 
     * @param int $id
     * @return Deal|boolean
     */
    function DealById($id) {
        $result = $this->conn->query(Deal::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Deal');
        }
        $this->err = $this->conn->error;
        return false;          
    }
    /**
     * 
     * @param int $id
     * @return Member|boolean
     */
    function MemberById($id) {
        $result = $this->conn->query(Member::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Member');
        }
        $this->err = $this->conn->error;
        return FALSE;        
    }
    /**
     * 
     * @param int $id
     * @return Order|boolean
     */
    function OrderById($id) {
        $result = $this->conn->query(Order::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Order');
        }
        $this->err = $this->conn->error;
        return FALSE;            
    }
    /**
     * 
     * @param int $id
     * @return OrderDetail|boolean
     */
    function OrderDetailById($id) {
        $result = $this->conn->query(OrderDetail::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('OrderDetail');
        }
        $this->err = $this->conn->error;
        return FALSE;          
    }
    /**
     * 
     * @param int $id
     * @return Product|boolean
     */
    function ProductById($id) {
        $result = $this->conn->query(Product::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Product');
        }
        $this->err = $this->conn->error;
        return FALSE; 
    }
    /**
     * 
     * @param int $id
     * @return Staff|boolean
     */
    function StaffById($id) {
        $result = $this->conn->query(Staff::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Staff');
        }
        $this->err = $this->conn->error;
        return FALSE;         
    }
    /**
     * 
     * @param int $id
     * @return Ticket|boolean
     */
    function TicketById($id) {
        $result = $this->conn->query(Ticket::toSelectByIdQuery($id));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Ticket');
        }
        $this->err = $this->conn->error;
        return FALSE;        
    }
    /**
     * 
     * @return Category[]|boolean
     */
    function AllCategories() {
        $result = $this->conn->query("SELECT `cat_id`, `cat_name`, `cat_is_main`, `cat_parent`
            FROM `categories`;");
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            $arr = array();
            while ($obj = $result->fetch_object('Category')) {
                $arr[] = $obj;
            }
            return $arr;
        }
        $this->err = $this->conn->error;
        return false;        
    }
    /**
     * 
     * @param int $num
     * @return Deal[]boolean
     */
    function RecentDeals($num) {
        $result = $this->conn->query("SELECT `deal_id`, `deal_banner`, `deal_content`, `deal_start`, `deal_end`, `pro_id`
            FROM `deals`
            ORDER BY `deal_id` DESC
            LIMIT ". (int) $num);
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            $arr = array();
            while ($obj = $result->fetch_object('Deal')) {
                $arr[] = $obj;
            }
            return $arr;
        }
        $this->err = $this->conn->error;
        return false;        
    }
    /**
     * 
     * @param int $num
     * @return Announcement[]|boolean
     */
    function RecentAnnouncements($num) {
        $result = $this->conn->query("SELECT `ann_id`, `ann_description`, `ann_content`
            FROM `announcements`
            ORDER BY `ann_id` DESC
            LIMIT ". (int) $num);
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            $arr = array();
            while ($obj = $result->fetch_object('Announcement')) {
                $arr[] = $obj;
            }
            return $arr;
        }
        $this->err = $this->conn->error;
        return false;       
    }
    
    function RecentProducts($num) {
        $result = $this->conn->query("SELECT `pro_id`, `pro_name`, `pro_thumb`, `pro_description`, `pro_vote`, `pro_available`, `pro_price`, `cat_id`
            FROM `products`
            ORDER BY `pro_id` DESC
            LIMIT ". (int) $num);
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            $arr = array();
            while ($obj = $result->fetch_object('Product')) {
                $arr[] = $obj;
            }
            return $arr;
        }
        $this->err = $this->conn->error;
        return false;          
    }
    /**
     * 
     * @param string $mem_email
     * @param string $mem_passHashed
     * @return boolean
     */
    function FindMember($mem_email, $mem_passHashed) {
        $result = $this->conn->query(Member::toSelectByIdPassword($mem_email, $mem_passHashed));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Member');
        }
        $this->err = $this->conn->error;
        return FALSE; 
    }
    
    function FindStaff($staff_email, $staff_passHashed) {
         $result = $this->conn->query(Staff::toSelectByIdPassword($staff_email, $staff_passHashed));
        if ($result) {
            if(!$result->num_rows) {
                $this->err = 'Entity not found';
                return FALSE;
            }
            return $result->fetch_object('Staff');
        }
        $this->err = $this->conn->error;
        return FALSE;        
    }
} 

?>