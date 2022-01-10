<?php

include_once("php/order-status.php");
include_once("php/address.php");
include_once("php/payment-type.php");

class DataBaseHelper
{
    private $db;
    private $not_paid_status = OrderStatus::NOT_PAID;
    private $paid_status = OrderStatus::PAID;
    private $default_shipping_address = Address::FIRST_FLOOR;
    private $default_payment_type = PaymentType::CASH_ON_DELIVERY;


    public function __construct($server_name, $username, $password, $db_name, $port)
    {
        // DB connection
        $this->db = new mysqli($server_name, $username, $password, $db_name, $port);
        if ($this->db->connect_error) {
            die("DB connection failed!");
        }
    }

    public function get_products_from_category($category)
    {
        $query = "SELECT id_product, product_name, product_img, price, description, rating, kcal, category_name FROM product, category, product_has_category WHERE id_product=product AND id_category=category";

        if ($category !== "all") {
            $query .= " AND category_name=?";
        }
        $query .= " ORDER BY rating DESC";
        $stmt = $this->db->prepare($query);
        if ($category !== "all") {
            $stmt->bind_param("s", $category);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_user_by_email($email)
    {
        $query = "SELECT id_user, email, username, password FROM user WHERE email=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function add_user_to_db($username, $email, $password)
    {
        $query = "INSERT INTO `user` (`email`, `password`, `username`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email, $password, $username);
        $stmt->execute();
    }

    public function is_email_taken($email)
    {
        $query = "SELECT * FROM `user` WHERE email=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return !empty($result->fetch_all(MYSQLI_ASSOC));
    }

    public function get_order_confirmation()
    {
        $id_order = $_SESSION["id_order"];

        $query = "SELECT total_price, id_order, shipping_address FROM `order` WHERE id_order=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_order);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function add_product_to_cart($id_product)
    {
        if (!isset($_SESSION["id_order"])) {
            $_SESSION["id_order"] = $this->does_user_have_not_paid_order() ? $this->retrieve_user_last_order() : $this->get_last_order_id() + 1;
            $id_user = $_SESSION["id_user"];
            $default_total_price = "2.00";
            $order_date = date("Y-m-d H:i:s");

            $query = "INSERT INTO `order` (`id_order`, `id_user`, `total_price`, `order_date`, `shipping_address`, `status`, `payment_type`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iisssss", $_SESSION["id_order"], $id_user, $default_total_price, $order_date, $this->default_shipping_address, $this->not_paid_status, $this->default_payment_type);
            $stmt->execute();
        }

        $this->create_order_product($id_product);
        $product_price = $this->get_product_price($id_product);
        $this->update_total_price($product_price);
    }

    private function create_order_product($id_product)
    {
        $id_order = $_SESSION["id_order"];
        $initial_quantity = 1;

        $query = "INSERT INTO `order_product` (`product`, `order`, `quantity`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $id_product, $id_order, $initial_quantity);
        $stmt->execute();
    }

    private function does_user_have_not_paid_order()
    {
        $id_user = $_SESSION["id_user"];
        $query = "SELECT id_order FROM `order` WHERE id_user=? AND status=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id_user, $this->not_paid_status);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }

    private function retrieve_user_last_order()
    {
        $id_user = $_SESSION["id_user"];
        $query = "SELECT id_order FROM `order` WHERE id_user=? AND status=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id_user, $this->not_paid_status);
        $stmt->execute();

        return $stmt->get_result()->fetch_row()[0];
    }

    private function get_last_order_id()
    {
        $query = "SELECT id_order FROM `order` ORDER BY id_order DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_row()[0] : 0;
    }

    public function update_quantity_to($id_product, $new_quantity)
    {
        $id_order = $_SESSION["id_order"];
        $query = "UPDATE order_product SET quantity=? WHERE product=? AND `order`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $new_quantity, $id_product, $id_order);
        $stmt->execute();
    }

    public function remove_product_from_order($id_product)
    {
        $product_price = $this->get_product_price($id_product) * $this->get_product_quantity_in_order($id_product);
        $this->update_total_price(-$product_price);
        $id_order = $_SESSION["id_order"];

        $query = "DELETE FROM `order_product` WHERE product=? AND `order`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $id_product, $id_order);
        $stmt->execute();
    }

    private function get_product_quantity_in_order($id_product)
    {
        $id_order = $_SESSION["id_order"];

        $query = "SELECT quantity FROM order_product WHERE product=? AND `order`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $id_product, $id_order);
        $stmt->execute();

        return $stmt->get_result()->fetch_row()[0];
    }

    public function cancel_order()
    {
        $id_order = $_SESSION["id_order"];

        $query = "DELETE FROM `order` WHERE `id_order`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_order);
        $stmt->execute();
        unset($_SESSION["id_order"]);
        header("Location:cart.php");
    }

    public function get_cart_products()
    {
        if (!isset($_SESSION["id_order"])) {
            return array();
        }
        $id_order = $_SESSION["id_order"];

        $query = "SELECT id_product, category_name, product_name, product_img, price, order_product.quantity
        FROM product INNER JOIN order_product ON product.id_product=order_product.product INNER JOIN
        `order`ON `order`.id_order=order_product.order INNER JOIN `product_has_category`
        ON `product_has_category`.`product`=product.id_product INNER JOIN `category`
        ON `category`.`id_category`=`product_has_category`.`category` WHERE `order`=?
        AND status=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $id_order, $this->not_paid_status);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function is_product_in_cart($id_product)
    {
        $products = array();
        $products_in_cart = $this->get_cart_products();
        foreach ($products_in_cart as $array) {
            if ($array["id_product"] == $id_product) {
                array_push(
                    $products,
                    $array["id_product"]
                );
            }
        }
        return !empty($products);
    }

    public function update_payment_type($payment_type)
    {
        $id_order = $_SESSION["id_order"];
        $query = "UPDATE `order` SET payment_type=? WHERE id_order=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $payment_type, $id_order);
        $stmt->execute();
    }

    public function update_address($address)
    {
        $id_order = $_SESSION["id_order"];
        $query = "UPDATE `order` SET shipping_address=? WHERE id_order=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $address, $id_order);
        $stmt->execute();
    }

    public function update_status($status)
    {
        $id_order = $_SESSION["id_order"];
        $query = "UPDATE `order` SET status=? WHERE id_order=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $status, $id_order);
        $stmt->execute();
    }

    public function get_product_price($id_product)
    {
        $query = "SELECT price FROM product WHERE id_product=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_product);
        $stmt->execute();

        return $stmt->get_result()->fetch_row()[0];
    }

    public function get_total_price()
    {
        $id_order = $_SESSION["id_order"];

        $query = "SELECT total_price FROM `order` WHERE id_order=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_order);
        $stmt->execute();

        return $stmt->get_result()->fetch_row()[0];
    }

    public function update_total_price($price)
    {
        $id_order = $_SESSION["id_order"];
        $new_total_price = $this->get_total_price() + $price;
        $query = "UPDATE `order` SET total_price=? WHERE id_order=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $new_total_price, $id_order);
        $stmt->execute();
    }

    private function get_random_delivery_man()
    {
        $query = "SELECT id_delivery_man FROM delivery_man ORDER BY RAND() LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->get_result()->fetch_row()[0];
    }

    public function add_notification()
    {
        $id_order = $_SESSION["id_order"];
        $id_delivery_man = $this->get_random_delivery_man();

        $query = "INSERT INTO `notifications` (`id_order`, `id_delivery_man`) VALUES (?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $id_order, $id_delivery_man);
        $stmt->execute();
    }

    public function get_notifications()
    {
        $id_user = $_SESSION["id_user"];

        $query = "SELECT id_notification, `order`.`id_order`, `order`.`order_date`,
        delivery_man.delivery_man_name, delivery_man.delivery_man_img, seen FROM notifications
        INNER JOIN `order`ON `order`.id_order=notifications.id_order INNER JOIN `delivery_man`
        ON delivery_man.id_delivery_man=notifications.id_delivery_man INNER JOIN `user`
        ON `order`.`id_user`=user.id_user WHERE `user`.`id_user`=? ORDER BY `order`.`order_date` DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function is_admin()
    {
        if (!isset($_SESSION["id_user"])) {
            return false;
        } else {
            $id_user = $_SESSION["id_user"];
        }

        $query = "SELECT is_admin FROM user WHERE id_user=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_user);
        $stmt->execute();

        return $stmt->get_result()->fetch_row()[0] == "1";
    }

    public function get_today_orders()
    {
        $query = "SELECT id_order, username, total_price, shipping_address FROM `order`, `user`
        WHERE DATE(`order_date`) = CURDATE() AND `order`.`id_user`=`user`.`id_user` ORDER BY order_date DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function get_products_in_order($id_order)
    {
        $query = "SELECT product_name, quantity FROM `order_product`
        INNER JOIN `order` ON `order_product`.`order`=`order`.`id_order`
        INNER JOIN `product` ON `product`.`id_product`=`order_product`.`product` WHERE id_order=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_order);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function see_notification($id_notification)
    {
        $seen_notification = 1;

        $query = "UPDATE notifications SET seen=? WHERE id_notification=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $seen_notification, $id_notification);
        $stmt->execute();
    }

    public function get_user_orders()
    {
        $id_user = $_SESSION["id_user"];

        $query = "SELECT id_order, total_price, order_date FROM `order` WHERE id_user=? AND status=? ORDER BY order_date DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $id_user, $this->paid_status);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function search_input_product($product_name)
    {
        $product_name = "%{$product_name}%";
        $query = "SELECT id_product, product_name, product_img, price, description, rating, kcal, category_name FROM product, category, product_has_category WHERE id_product=product AND id_category=category AND (product_name LIKE ? OR description LIKE ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $product_name, $product_name);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
