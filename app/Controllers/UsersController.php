<?php
class UsersController
{
    private $conn;
    private $myDB;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
        $myDB = $db;
    }

    public function index()
    {
        include_once 'app/Models/UserModel.php';

        $users = (new User())::all($this->conn);
        $user = new User();
        $roles = $user->getRoles($this->conn);

        include_once 'views/users.php';
    }


    public function addForm(){
        include_once 'app/Models/UserModel.php';
        $user = new User();
        $roles = $user->getRoles($this->conn);
        include_once 'views/addUser.php';
    }

    public function add()
    {
        include_once 'app/Models/UserModel.php';

        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $roleID = filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = password_hash($password, PASSWORD_DEFAULT);

        echo "roleID: " . $roleID . "<br>";

        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "" && trim($roleID) !== "") {
            $user = new User($name, $email, $gender, $password, $surname, $roleID);
            $user->add($this->conn);
            echo $name . $email . $password . $gender . "<br>";
        }
        header('Location: ?controller');
    }

    public function delete() {
        include_once 'app/Models/UserModel.php';
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new User())::delete($this->conn, $id);
        }
        header('Location: ?controller=users');
    }

    public function show() {
        include_once 'app/Models/UserModel.php';

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            $user = (new User())::byId($this->conn, $id);
        }
        include_once 'views/showUser.php';
    }

    public function edit() {
        include_once 'app/Models/UserModel.php';

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $roleID = filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (trim($password) == "")
            $password = "old";

        echo "<br>RoleID: " . $password . "<br>";

        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($id) !== "" && trim($password) !== "" && trim($surname) !== "" && trim($roleID) !== "") {
            $user = new User($name, $email, $gender, $password);
            $user = new User($name, $email, $gender, $password, $surname, $roleID);
            $user->update($this->conn, $id, $user);
        }

        header('Location: ?controller=users');
    }

}
