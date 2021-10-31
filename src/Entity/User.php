<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(
 * fields= {"email"},
 * message="email déja utilisé"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email() 
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
    */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 8, minMessage = "votre  mote de passe doit faire minimun 8 caractéres")
     */
    private $password;
    /**
     * @Assert\EqualTo(propertyPath="password", message=" incorrete")
     */
    public $confirm_password; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getusername(): ?string
    {
        return $this->username;
    }

    public function setusername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
     /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */

   public function eraseCredentials() {} 
   public function getSalt(){}
   public function getRoles(){
       return ['ROLE_USER'];
   }
}
 