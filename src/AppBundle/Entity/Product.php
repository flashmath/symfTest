<?php
/**
 * Created by PhpStorm.
 * User: Fabrice
 * Date: 06/07/2017
 * Time: 23:21
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Product
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{

    /**
     * @var
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a JPG file.")
     * @Assert\File(mimeTypes={"image/jpg","image/jpeg"})
     */
    private $brochure;

    public function getBrochure(){
        return $this->brochure;
    }

    public function setBrochure($brochure){
        $this->brochure = $brochure;

        return $this;
    }

}