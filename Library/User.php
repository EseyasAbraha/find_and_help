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
                'name' => 'First Name'
            ],
            'last_name' => [
                'name' => 'Last Name'
            ],
            'birthday' => [
                'name' => 'Birthday'
            ],
            'gender' => [
                'name' => 'Gender',
                'select' => ['female', 'male'],
            ],
            'nationality' => [
                'name' => 'Nationality',
                'required' => false
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
                'name' => 'Address'
            ],
            'house_number' => [
                'name' => 'House Number'
            ],
            'post_code' => [
                'name' => 'Post Code'
            ],
            'province' => [
                'name' => 'Province'
            ],
            'city' => [
                'name' => 'City'
            ],
            'phone' => [
                'name' => 'Telephone'
            ],
            'email' => [
                'name' => 'E-mail address'
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

    public static function register(Database $db)
    {
        if (!isset($_POST)) {
            return;
        }

        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `birthday`, `gender`, `dutch_level`, `nationality`, `address`, `house_number`, `post_code`, `province`, `city`, `phone`, `email`, `type`) 
VALUES (:first_name, :last_name, :birthday, :gender, :dutch_level, :nationality, :address, :house_number, :post_code, :province, :city, :phone, :email, :type);";
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
        $statment->execute();

        header("location: /");
    }
}
