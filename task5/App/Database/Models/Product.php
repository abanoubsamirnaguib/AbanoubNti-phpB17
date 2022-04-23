<?php

namespace App\Database\Models;

use App\Database\Config\Connection;
use App\Database\interfaces\Crud;

class Product extends Connection implements Crud
{
    private $id,
        $name,
        $code,
        $price,
        $quantity,
        $desc_en,
        $desc_ar,
        $image,
        $status,
        $brand_id,
        $subcategory_id,
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

    public function getCode()
    {
        return $this->code;
    }


    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }


    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDesc_en()
    {
        return $this->desc_en;
    }


    public function setDesc_en($desc_en)
    {
        $this->desc_en = $desc_en;

        return $this;
    }

    public function getDesc_ar()
    {
        return $this->desc_ar;
    }


    public function setDesc_ar($desc_ar)
    {
        $this->desc_ar = $desc_ar;

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

    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }


    public function getBrand_id()
    {
        return $this->brand_id;
    }


    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    public function getSubcategory_id()
    {
        return $this->subcategory_id;
    }


    public function setSubcategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

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

    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }






    public function create()
    {
    }

    public function read()
    {
        $query = "SELECT `id`,`name`,`price`,`desc_en`,`image` FROM `products` WHERE `status` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('i', $this->status);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function readLast($numb)
    {
        $query = "SELECT `id`,`name`,`price`,`desc_en`,`image` FROM `products` WHERE `status` = ? Order BY created_at DESC LIMIT ?;";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ii', $this->status , $numb );
        $stmt->execute();
        return $stmt->get_result();
    }
    public function update()
    {
    }
    public function delete()
    {
    }

    public function find()
    {
        $query = "SELECT * FROM `products` WHERE `id` = ? AND `status` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ii', $this->id, $this->status);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function findAll()
    {
        $query = "SELECT 
        `products`.* ,
        COUNT(`review`.`id`) as `count_reviews` , 
        ROUND(AVG(`review`.`rate`), 0) as `avg_reviews` ,
        `categories`.`name_en` as `category_name_en` ,
        `categories`.`id` as `category_id` , 
        `sub_categories`.`name_en` as `subcategory_name_en` , 
        `brands`.`name_en` as `brand_name_en`
        FROM `products`
        left JOIN `review` ON `products`.`id` = `review`.`product_id`
        left JOIN `brands` ON  `brands`.`id` = `products`.`Brand_id` 
        left JOIN `sub_categories` ON `sub_categories`.`id` = `products`.`sub_category_id`
        left JOIN `categories` ON `categories`.`id` = `sub_categories`.`category_id` 
        WHERE `products`.`status` = ? And `products`.`id` = ? 
        GROUP BY `review`.`product_id`";

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ii', $this->status , $this->id );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function readBy($key , $val)
    {
        $query = "SELECT 
        `products`.* ,
        `categories`.`name_en` as `category_name_en` ,
        `categories`.`id` as `category_id` , 
        `sub_categories`.`name_en` as `subcategory_name_en` , 
        `brands`.`name_en` as `brand_name_en`
        FROM `products`
        left JOIN `brands` ON  `brands`.`id` = `products`.`Brand_id` 
        left JOIN `sub_categories` ON `sub_categories`.`id` = `products`.`sub_category_id`
        left JOIN `categories` ON `categories`.`id` = `sub_categories`.`category_id` 
        WHERE `products`.`status` = ? And $key = ? " ;

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ii', $this->status , $val );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function specs()
    {
        $query = "SELECT
                        `product_spec`.*,
                        `specs`.`name`
                    FROM
                        `product_spec`
                    JOIN `specs` ON `specs`.`id` = `product_spec`.`spec_id`
                    WHERE
                        `product_id` = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function reviews()
    {
        $query = "SELECT
                    `review`.*,
                    CONCAT(
                        `users`.`first_name`,
                        ' ',
                        `users`.`last_name`
                    ) AS `full_name`
                FROM
                    `review`
                JOIN `users`
                ON `users`.`id` = `review`.`user_id`
                WHERE `product_id` = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
