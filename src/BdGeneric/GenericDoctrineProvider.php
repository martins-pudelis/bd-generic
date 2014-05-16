<?php

namespace BdGeneric;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use BdGeneric\Exception;

/**
 *
 */
class GenericDoctrineProvider
{
    /**
     *
     */
    const FLUSH_AUTO = 'auto';

    /**
     *
     */
    const FLUSH_EXPLICIT = 'explicit';

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $entityClassName;

    /**
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * @var string
     */
    protected static $flushMode = self::FLUSH_AUTO;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param $entityClassName
     */
    public function __construct(EntityManager $entityManager, $entityClassName)
    {
        $this->entityManager = $entityManager;
        $this->entityClassName = $entityClassName;

        $this->entityRepository = $entityManager->getRepository($entityClassName);
    }

    /**
     * @return mixed
     */
    public function getNew()
    {
        return new $this->entityClassName();
    }

    /**
     * @param string $flushMode
     */
    public static function setFlushMode($flushMode)
    {
        self::$flushMode = $flushMode;
    }

    /**
     * @param $force
     */
    protected function flushEntityManager($force = false)
    {
        if ($force || self::$flushMode == self::FLUSH_AUTO) {
            $this->entityManager->flush();
        }
    }

    /**
     * @param $entity
     */
    public function store($entity)
    {
        $this->entityManager->persist($entity);
        $this->flushEntityManager();
    }

    /**
     * @param $criteria
     * @return array
     */
    public function findBy($criteria)
    {
        return $this->entityRepository->findBy($criteria);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->entityRepository->findAll();
    }

    /**
     * @param array $criteria
     * @return null|object
     */
    public function findOneBy(array $criteria)
    {
        return $this->entityRepository->findOneBy($criteria);
    }

    /**
     * @param $id
     * @return null|object
     */
    public function find($id)
    {
        return $this->entityRepository->find($id);
    }

    /**
     * @param $entity
     */
    public function remove($entity)
    {
        $this->entityManager->remove($entity);
        $this->flushEntityManager();
    }

    /**
     * @param $entity
     * @return bool
     */
    public function isRecognized($entity)
    {
        return $entity instanceof $this->entityClassName;
    }

    /**
     * @param $entity
     * @throws \BdGeneric\Exception\RuntimeException
     */
    public function assertIsRecognzied($entity)
    {
        if (!$this->isRecognized($entity)) {
            throw new Exception\RuntimeException('Entity not recognized by Doctrine provider.');
        }
    }

    /**
     * @return string
     */
    public function getEntityClassName()
    {
        return $this->entityClassName;
    }
}
