<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function add(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     *
     * @return mixed
     */
    public function findCarsByNameAsc()
    {
        $filterCarName = $this->createQueryBuilder('c') 
        ->orderBy('c.name', 'ASC') 
        ->getQuery()
        ->getResult();
        return $filterCarName;
    }
    /**
     *
     * @return mixed
     */
    public function findCarsByCategoryName()
    {
        $filterCarsByCategoryName = $this->createQueryBuilder('c') 
        ->orderBy('c.category', 'ASC')
        ->getQuery()
        ->getResult();
        return $filterCarsByCategoryName;
    }

    /**
     * @return Car[] Returns an array of Car objects
     */
   public function findByCategory($category): array
   {
       return $this->createQueryBuilder('c')
        ->andWhere('c.category = :cat')
           ->setParameter('cat', $category)
          ->orderBy('c.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
