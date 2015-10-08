<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="test")
 * @package Application\Entity
 */

class Test
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    public $id;

    /**
     *
     * @ORM\Column(type="datetime")
     * @var datetime
     */
    public $created_at;

    /**
     *
     * @ORM\Column(type="datetime")
     * @var datetime
     */
    public $updated_at;

    /**
     *
     * @ORM\Column(type="string")
     * @var integer
     */
    public $name;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

}
