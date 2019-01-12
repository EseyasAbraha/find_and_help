<?php

namespace App\Library;

if (!defined('ACCESS')) {
    die;
}

class User
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var Database
     */
    private $db;

    public function __construct(string $type, Database $db)
    {
        $this->type = $type;
        $this->db = $db;
    }

    public function personalInfo()
    {
        $info = [
            'first_name' => [
                'name' => 'First Name',
            ],
            'last_name' => [
                'name' => 'Last Name',
            ],
            'birthday' => [
                'name' => 'Birthday',
                'id' => 'datepicker',
            ],
            'gender' => [
                'name' => 'Gender',
                'select' => ['female', 'male'],
            ],
            'nationality' => [
                'name' => 'Nationality',
                'required' => false,
            ],
        ];

        if ($this->type === 'student') {
            $info['dutch_level'] = [
                'name' => 'Dutch Level',
                'select' => ['A1', 'A2', 'B1', 'B2'],
            ];
        }

        return $info;
    }

    public function contactInfo()
    {
        $info = [
            'address' => [
                'name' => 'Address',
            ],
            'house_number' => [
                'name' => 'House Number',
                'inputType' => 'number',
            ],
            'post_code' => [
                'name' => 'Post Code',
            ],
            'province' => [
                'name' => 'Province',
            ],
            'city' => [
                'name' => 'City',
            ],
            'phone' => [
                'name' => 'Telephone',
            ],
            'email' => [
                'name' => 'E-mail address',
                'inputType' => 'email',
            ],
        ];

        return $info;
    }

    public function getUserById(int $id): array
    {
        $statment = $this->db->select("SELECT * FROM users WHERE id = :id");
        $statment->bindParam(':id', $id);
        $statment->execute();

        $result = $statment->fetchAll();

        return isset($result[0]) ? $result[0] : [];
    }

    public static function isLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return false;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        header("location: /");
    }

    public static function login(Database $db)
    {
        if (!isset($_POST)) {
            return;
        }

        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Email is not valid.');
        }

        $sql = "SELECT * FROM users WHERE `email`=:email and `password`=:password";
        $statment = $db->select($sql);
        $statment->bindParam(':email', $email);
        $statment->bindParam(':password', $_POST['password']);
        $statment->execute();

        $user = $statment->fetch();
        if (!$user) {
            die('This credentials does not exist, please try again.');
        }

        $_SESSION['user'] = $user;

        header("location: /profile");
    }

    public static function register(Database $db)
    {
        if (!isset($_POST)) {
            return;
        }

        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Email is not valid.');
        }

        if (!isset($_FILES["fileToUpload"])) {
            die('Please select a profile picture.');
        }

        $sql = "SELECT * FROM users WHERE `email`=:email";
        $statment = $db->select($sql);
        $statment->bindParam(':email', $email);
        $statment->execute();

        if ($statment->fetch()) {
            die('This email Already registered, please try again.');
        }

        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `birthday`, `gender`, `dutch_level`, `nationality`, `address`, `house_number`, `post_code`, `province`, `city`, `phone`, `email`, `type`, `password`)
VALUES (:first_name, :last_name, :birthday, :gender, :dutch_level, :nationality, :address, :house_number, :post_code, :province, :city, :phone, :email, :type, :password);";
        $statment = $db->select($sql);
        $statment->bindParam(':first_name', $_POST['first_name']);
        $statment->bindParam(':last_name', $_POST['last_name']);
        $statment->bindParam(':birthday', $_POST['birthday']);
        $statment->bindParam(':gender', $_POST['gender']);
        $statment->bindParam(':dutch_level', $_POST['dutch_level']);
        $statment->bindParam(':nationality', $_POST['nationality']);
        $statment->bindParam(':address', $_POST['address']);
        $statment->bindParam(':house_number', $_POST['house_number']);
        $statment->bindParam(':post_code', $_POST['post_code']);
        $statment->bindParam(':province', $_POST['province']);
        $statment->bindParam(':city', $_POST['city']);
        $statment->bindParam(':phone', $_POST['phone']);
        $statment->bindParam(':email', $_POST['email']);
        $statment->bindParam(':type', $_POST['type']);
        $statment->bindParam(':password', $_POST['password']);
        $statment->execute();

        $lastId = $db->getConnection()->lastInsertId();

        self::uploadImage($lastId);
        Messages::setFlashMessage(Messages::SUCCEED, 'register', 'Registration has done successfully');

        header("location: /");
    }

    private static function uploadImage($id)
    {
        $target_dir = __DIR__ . "/../assets/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        // Check if file already exists
        if (file_exists($target_dir.$id.'.'.$imageFileType)) {
            die("Sorry, file already exists.");
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            die("Sorry, your file is too large.");
        }
        // Allow certain file formats
        if ($imageFileType != "jpg"
            && $imageFileType != "png"
            && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$id.'.'.$imageFileType)) {
            echo "The file ".basename($_FILES["fileToUpload"]["name"])." has been uploaded.";
        } else {
            die("Sorry, there was an error uploading your file.");
        }

        return $uploadOk;
    }
}
