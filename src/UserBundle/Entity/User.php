<?php
/**
 * Created by PhpStorm.
 * User: Fabrice
 * Date: 10/07/2017
 * Time: 21:00
 */

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="expapp_users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var $firstname
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="user.firstname.not_blank",groups={"Registration"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="user.firstname.short",
     *     maxMessage="user.firstname.long",
     *     groups={"Registration"}
     * )
     */
    protected $firstname;

    /**
     * @var $name
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="user.name.not_blank",groups={"Registration"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="user.name.short",
     *     maxMessage="user.name.long",
     *     groups={"Registration"}
     * )
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}