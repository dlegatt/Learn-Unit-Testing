<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class GuestBook
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class GuestBook implements \JsonSerializable
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @param $name
     * @return GuestBook
     */
    public function setName($name): GuestBook
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $comment
     * @return GuestBook
     */
    public function setComment($comment): GuestBook
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'comment' => $this->comment,
        ];
    }
}