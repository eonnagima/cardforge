<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class Banner{
    private $img;
    private $logo;
    private $franchise;
    private $image_alt;
    private $logo_alt;
    private $active;


    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        if (empty($img)) {
            throw new \Exception("Image can't be empty");
        } else {
            $this->img = $img;
            return $this;
        }
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        if (empty($logo)) {
            throw new \Exception("Logo can't be empty");
        } else {
            $this->logo = $logo;
            return $this;
        }
    }

    public function getFranchise()
    {
        return $this->franchise;
    }

    public function setFranchise($franchise)
    {
        if (empty($franchise)) {
            throw new \Exception("Franchise can't be empty");
        } else {
            $this->franchise = $franchise;
            return $this;
        }
    }

    public function getImageAlt()
    {
        return $this->image_alt;
    }

    public function setImageAlt($image_alt)
    {
        if (empty($image_alt)) {
            throw new \Exception("Image Alt can't be empty");
        } else {
            $this->image_alt = $image_alt;
            return $this;
        }
    }

    public function getLogoAlt()
    {
        return $this->logo_alt;
    }

    public function setLogoAlt($logo_alt)
    {
        if (empty($logo_alt)) {
            throw new \Exception("Logo Alt can't be empty");
        } else {
            $this->logo_alt = $logo_alt;
            return $this;
        }
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        if (empty($active)) {
            throw new \Exception("Active can't be empty");
        } else {
            $this->active = $active;
            return $this;
        }
    }

    public function save()
    {
        $conn = Db::getConnection();

        $query = 'INSERT INTO banners (img, logo, franchise_id, image_alt, logo_alt, active) VALUES (
            :img, 
            :logo, 
            (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise),
            :image_alt,
            :logo_alt,
            :active
        )';

        $stmt = $conn->prepare($query);

        $stmt->bindValue(':img', $this->img);
        $stmt->bindValue(':logo', $this->logo);
        $stmt->bindValue(':franchise', $this->franchise);
        $stmt->bindValue(':image_alt', $this->image_alt);
        $stmt->bindValue(':logo_alt', $this->logo_alt);
        $stmt->bindValue(':active', $this->active);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAll()
    {
        $conn = Db::getConnection();

        $query = 'SELECT * FROM banners';

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $banners = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $banners;
    }

    public static function getAllByFranchise($franchise)
    {
        $conn = Db::getConnection();

        $query = 'SELECT * FROM banners WHERE franchise_id = (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise)';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':franchise', $franchise);
        $stmt->execute();

        $banners = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $banners;
    }

    public static function getById($id)
    {
        $conn = Db::getConnection();

        $query = 'SELECT * FROM banners WHERE id = :id';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $banner = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $banner;
    }

    // get all active

    public static function getAllActive()
    {
        $conn = Db::getConnection();

        $query = 'SELECT * FROM banners WHERE active = 1';

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $banners = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $banners;
    }

    public static function delete($id){
        $conn = Db::getConnection();

        $query = 'DELETE FROM banners WHERE id = :id';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':id', $id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function update($id)
    {
        $conn = Db::getConnection();

        $query = 'UPDATE banners SET 
            img = :img, 
            logo = :logo, 
            franchise_id = (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise),
            image_alt = :image_alt,
            logo_alt = :logo_alt,
            active = :active
            WHERE id = :id';

        $stmt = $conn->prepare($query);

        $stmt->bindValue(':img', $this->img);
        $stmt->bindValue(':logo', $this->logo);
        $stmt->bindValue(':franchise', $this->franchise);
        $stmt->bindValue(':image_alt', $this->image_alt);
        $stmt->bindValue(':logo_alt', $this->logo_alt);
        $stmt->bindValue(':active', $this->active);
        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}