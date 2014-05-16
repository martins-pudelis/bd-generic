<?php

namespace BdGeneric\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Util\ClassUtils;

class Entity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    // @codingStandardsIgnoreStart
    public static function CN()
    {
        return ClassUtils::getRealClass(get_called_class());
    }
    // @codingStandardsIgnoreEnd
}
