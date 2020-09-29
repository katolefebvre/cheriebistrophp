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

    public function createCategory($name)
    {
        $stmt = $this->conn->prepare("INSERT INTO category (name) VALUES (?)");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            return array(CATEGORY_CREATED, $this->conn->insert_id);
        } else {
            return array(CATEGORY_NOT_CREATED, $stmt->error);
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

    public function changeRole($employeeID, $roleID)
    {
        $stmt = $this->conn->prepare("UPDATE users SET roleID = ? WHERE employeeID = ?");
        $stmt->bind_param("ii", $roleID, $employeeID);

        if ($stmt->execute()) {
            return ROLE_CHANGED;
        } else {
            return ROLE_NOT_CHANGED;
        }
    }

    public function getEmployees() 
    {
        $result = array();
        $employees = array();

        $stmt = "SELECT users.*, roles.name FROM users INNER JOIN roles ON roles.id = users.roleID";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($employees, $row);
                }
                return $employees;
            } else {
                return false;
            }
        }
    }

    public function getRoles() 
    {
        $result = array();
        $roles = array();

        $stmt = "SELECT * FROM roles";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($roles, $row);
                }
                return $roles;
            } else {
                return false;
            }
        }
    }

    public function getTimeSlots()
    {
        $result = array();
        $employees = array();

        $stmt = "SELECT * FROM time_slot";

        if (!$result = $this->conn->query($stmt)) {
            return false;
        } else {
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    array_push($employees, $row);
                }
                return $employees;
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

    public function getUserDetailsWithPassword($employeeID)
    {
        $response = array();
        $sql = "SELECT users.employeeID, users.employeeName, users.roleID, roles.name from users inner join roles on roles.id = users.roleID where users.employeeID = $employeeID";

        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1))
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row)) {
                $response = $row;
            }
        }
        return $response;
    }

    public function getTableDetails($tableID)
    {
        $response = array();
        $sql = "SELECT tableID, tableName from tables where tableID = $tableID";

        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1))
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!empty($row))
            {
                $response = $row;
            }
        }
        return $response;
    }

    public function getMenuItemsForCategory($categoryID)
    {
        $response = array();
        $sql = "SELECT * FROM menu_item m INNER JOIN menu_item_categories mc ON m.id = mc.menu_item_id where mc.category_id = $categoryID";

        $result = $this->conn->query($sql);
        if ($result != null && (mysqli_num_rows($result) >= 1))
        {
            $row = $result->fetch_query(MYSQLI_ASSOC);
            if (!empty($row))
            {
                $response = $row;
            }
        }

        return $response;
    }

}

?>