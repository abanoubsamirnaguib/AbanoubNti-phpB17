<?php

namespace App\Database\Models;

use App\Database\Config\Connection;
use App\Database\interfaces\Crud;

class User extends Connection implements Crud
{
    private $id,
        $first_name,
        $last_name,
        $email,
        $password,
        $phone,
        $gender,
        $image,
        $status,
        $verification_code,
        $RememberToken,
        $email_verified_at,
        $created_at,
        $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getFirst_name()
    {
        return $this->first_name;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }


    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getActivation_code()
    {
        return $this->activation_code;
    }


    public function setActivation_code($activation_code)
    {
        $this->activation_code = $activation_code;

        return $this;
    }

    public function getEmail_verified_at()
    {
        return $this->email_verified_at;
    }

    public function setEmail_verified_at($email_verified_at)
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }


    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    public function getVerification_code()
    {
        return $this->verification_code;
    }
    public function setVerification_code($verification_code)
    {
        $this->verification_code = $verification_code;

        return $this;
    }
    public function setRememberToken($RememberToken)
    {
        $this->RememberToken = $RememberToken;

        return $this;
    }









    public function create()
    {
        $query = "INSERT INTO `users` (`first_name`,`last_name`,`email`,`password`,`gender`,`phone`,`verification_code`)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param(
            "ssssssi",
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->password,
            $this->gender,
            $this->phone,
            $this->verification_code
        );
        return $stmt->execute();
    }
    public function read()
    {
    }
    public function update()
    {
        $query = "UPDATE `users` SET `first_name` = ? , `last_name` = ?, `gender` = ? 
        WHERE `email` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ssss", $this->first_name, $this->last_name, $this->gender, $this->email);
        return $stmt->execute();
    }
    public function delete()
    {
    }

    public function updateUserCode()
    {
        $query = "UPDATE `users` SET `verification_code` = ? WHERE `email` = ?";

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("is", $this->verification_code, $this->email);
        return $stmt->execute();
    }

    public function updateNewPassword()
    {
        $query = "UPDATE `users` SET `password` = ? WHERE `email` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ss", $this->password, $this->email);
        return $stmt->execute();
    }

    public function getUserWithEmail()
    {
        $query = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = $this->con->prepare($query);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("s", $this->email);
        $stmt->execute();

        return $stmt->get_result();
    }
    public function getUserByToken()
    {
        $query = "SELECT * FROM `users` WHERE `RememberToken` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("s", $this->RememberToken);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function safeData()
    {
        return (object)[
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'gender' => $this->gender,
            'image' => $this->image,
            'verification_code' => $this->verification_code,
            'status' => $this->status,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function checkCode()
    {
        $query = "SELECT * FROM `users` WHERE `email` = ? AND `verification_code` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("si", $this->email, $this->verification_code);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function makeUserVerified()
    {
        $query = "UPDATE `users` SET `email_verified_at` = ? WHERE `email` = ?";

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ss", $this->email_verified_at, $this->email);
        return $stmt->execute();
    }
    public function updateRememberToken()
    {
        $query = "UPDATE `users` SET `RememberToken` = ? WHERE `email` = ?";

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ss", $this->RememberToken, $this->email);
        return $stmt->execute();
    }
    public function RemoveRememberToken()
    {
        $query = "UPDATE `users` SET `RememberToken` = ? WHERE `email` = ?";

        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ss", $this->RememberToken, $this->email);
        if (!$stmt) {
            return false;
        }
        return $stmt->execute();
    }
    public function updateImage()
    {
        $query = "UPDATE `users` SET `image` = ? WHERE `email` = ?";

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ss", $this->image, $this->email);
        return $stmt->execute();
    }
    public function deleteImage()
    {
        $query = "UPDATE `users` SET `image` = DEFAULT WHERE `email` = ?";

        $stmt = $this->con->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s",$this->email);
        return $stmt->execute();
    }
    
}
