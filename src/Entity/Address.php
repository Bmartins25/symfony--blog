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
    private string $Address;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
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

    public function getAddress(): string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): void
    {
        $this->updatedAt = new \DateTime();
        $this->Address = $Address;
    }

   
}