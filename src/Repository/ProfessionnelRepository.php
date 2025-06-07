<?php

namespace App\Repository;

use App\Entity\Professionnel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Professionnel>
 *
 * @method Professionnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Professionnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Professionnel[]    findAll()
 * @method Professionnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionnelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Professionnel::class);
    }

    public function findByFilters(array $filters = [])
    {
        $qb = $this->createQueryBuilder('p');

        if (!empty($filters['categorie'])) {
            $qb->andWhere('p.categorie = :catId')
            ->setParameter('catId', $filters['categorie']);
        }

        if (!empty($filters['specialite'])) {
            $qb->andWhere('p.specialite = :specId')
            ->setParameter('specId', $filters['specialite']);
        }

        return $qb;
    }

//    /**
//     * @return Professionnel[] Returns an array of Professionnel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Professionnel
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
