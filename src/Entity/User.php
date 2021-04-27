<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O título do post é obrigatório")
     * @Assert\Length(
     *     min=3,
     *     max=100,
     *     minMessage="O título do post deve ter pelo menos 3 caracteres"
     * )
     */
    private string $Firstname;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private string $Lastname;  
    
    /**
    * @ORM\Column(type="text")
    * @Assert\NotBlank()
    */
   private string $Email;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): void
    {
        $this->updatedAt = new \DateTime();
        $this->Firstname = $Firstname;
    }

    public function getLastname(): string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): void
    {
        $this->updatedAt = new \DateTime();
        $this->Lastname = $Lastname;
    }
    public function getEmail(): string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): void
    {
        $this->updatedAt = new \DateTime();
        $this->Email = $Email;
    }

    
}
