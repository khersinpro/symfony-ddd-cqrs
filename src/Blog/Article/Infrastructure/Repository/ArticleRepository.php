<?php

namespace App\Blog\Article\Infrastructure\Repository;

use App\Blog\Article\Domain\Entity\Article;
use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    private EntityManagerInterface $entityManager;
   public function __construct(ManagerRegistry $registry)
   {
        parent::__construct($registry, Article::class);
        $this->entityManager = $registry->getManager();
   }

   public function save(Article $article): void
   {
       $this->getEntityManager()->persist($article);
   }

   public function delete(Article $article): void
   {
        $sql = "DELETE FROM article WHERE article.id = :articleId";
        $this->getEntityManager()->getConnection()
            ->executeStatement($sql, ['articleId' => $article->getId()->__toString()]);
   }
   public function deleteByAuthorId(Uuid $authorId): void
   {
       $sql = "DELETE FROM article WHERE article.author_id = :authorId;";
       $this->entityManager->getConnection()->executeStatement($sql, [
           'authorId' => $authorId->__toString(),
       ]);
   }

   
   public function findById(Uuid $id): ?Article
   {
       return $this->createQueryBuilder('a')
           ->where('a.id = :id')
           ->setParameter('id', $id)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }

   public function findAll(int $page = 1, int $limit = 6): array
   {
        $offset = ($page - 1) * $limit;

        $qb = $this->getEntityManager()->getConnection()->createQueryBuilder();

        $qb->select(
            'a.id', 
            'a.title', 
            'a.content', 
            'a.author_id', 
            'a.category_id', 
            'a.category_id',
            'u.username AS author_username',
            'c.id AS category_id',
            'c.name AS category_name'
        )
        ->from('article', 'a')
        ->innerJoin('a', 'user', 'u', 'u.id = a.author_id')
        ->leftJoin('a', 'category', 'c', 'c.id = a.category_id')
        ->setFirstResult($offset)
        ->setMaxResults($limit);

        $stmt = $qb->executeQuery();

        return $stmt->fetchAllAssociative();
   }

   public function findArticleDetailsById(Uuid $id): array
   {
       $sql = <<<SQL
           SELECT
               a.id,
               a.title,
               a.content,
               a.category_id,
               u.id as author_id,
               u.username as author_username
               c.id as category_id,
               c.name as category_name
           FROM article a
           INNER JOIN user u ON u.id = a.author_id
           LEFT JOIN category c ON c.id = a.category_id
           WHERE a.id = :id
       SQL;

       $em = $this->getEntityManager()->getConnection();
       
       return $em->executeQuery($sql, ['id' => $id])->fetchAllAssociative();
   }

   public function removeDeletedCategoryIds(Uuid $category_id): void
   {
       $sql = <<<SQL
           UPDATE article
           SET category_id = NULL
           WHERE category_id = :category_id
       SQL;

       $em = $this->getEntityManager()->getConnection();
       
       $em->executeStatement($sql, ['category_id' => $category_id]);
   }
}