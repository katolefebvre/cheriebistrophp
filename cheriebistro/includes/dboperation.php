<?php 

class DbOperation
{
    private $conn;

    function __construct()
    {
        require_once dirname(__FILE__) . '/constants.php';
        require_once dirname(__FILE__) . '/dbconnect.php';

        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function createMenuItem($name, $description, $time_slot_id, $price)
    {
        $stmt = $this->conn->prepare("INSERT INTO menu_item (name, description, time_slot_id, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $description, $time_slot_id, $price);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return MENU_ITEM_NOT_CREATED;
        }
    }

    public function createMenuItemCategoryConnection($menu_item_id, $category_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO menu_item_categories (menu_item_id, category_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $menu_item_id, $category_id);

        if ($stmt->execute()) {
            return MENU_ITEM_CATEGORY_CONNECTED;
        } else {
            return MENU_ITEM_CATEGORY_NOT_CONNECTED;
        }
    }

    public function getTimeSlots()
    {
        $result = array();
        $time_slots = array();

        $stmt = "SELECT * FROM time_slot";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($time_slots, $row);
                }
                return $time_slots;
            } else {
                return false;
            }
        }
    }

    public function getCategories()
    {
        $result = array();
        $categories = array();

        $stmt = "SELECT * FROM category";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($categories, $row);
                }
                return $categories;
            } else {
                return false;
            }
        }
    }

    public function getMenuItems()
    {
        $result = array();
        $menu_items = array();

        $stmt = "SELECT * FROM menu_item";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($menu_items, $row);
                }
                return $menu_items;
            } else {
                return false;
            }
        }
    }

    public function getMenuItem($menu_item_id)
    {
        $result = array();
        $menu_item = array();

        $stmt = "SELECT * FROM menu_item WHERE id = $menu_item_id";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($menu_item, $row);
                }
                return $menu_item;
            } else {
                return false;
            }
        }
    }

    public function getMenuItemCategories() {
        $result = array();
        $menu_item_categories = array();

        $stmt = "SELECT * FROM menu_item_categories";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($menu_item_categories, $row);
                }
                return $menu_item_categories;
            } else {
                return false;
            }
        }
    }
}

?>