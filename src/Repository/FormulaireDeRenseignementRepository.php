<?php

namespace App\Repository;

use App\Entity\FormulaireDeRenseignement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormulaireDeRenseignement>
 *
 * @method FormulaireDeRenseignement|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormulaireDeRenseignement|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormulaireDeRenseignement[]    findAll()
 * @method FormulaireDeRenseignement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulaireDeRenseignementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormulaireDeRenseignement::class);
    }

//    /**
//     * @return FormulaireDeRenseignement[] Returns an array of FormulaireDeRenseignement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormulaireDeRenseignement
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}