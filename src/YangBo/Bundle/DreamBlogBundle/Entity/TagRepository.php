<?php

namespace YangBo\Bundle\DreamBlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
    /**
     * 统计某个标记的文章条数
     * @param $tag
     * @return mixed
     */
    public function countArticleWithTag($tag = '')
    {
        $qb = $this->createQueryBuilder('tag');
        $qb = $qb
            ->select('COUNT(articles)')
            ->leftjoin('tag.articles', 'articles')
//            ->where($qb->expr()->like('tag.tag_name', ':tag_name'))
//            ->setParameter('tag_name', '%' . $tag . '%')
        ;
        if (!empty($tag)) {
            $qb
                ->andWhere('tag.tag_name LIKE :tag_name')
                ->setParameter('tag_name', '%' . $tag . '%');
        }
        $query = $qb
            ->getQuery()
           ;
        $count = $query->getSingleScalarResult();
        return $count;
    }

    public function getArticleWithTag($tag = '', $offset = 0, $limit = '')
    {
        $qb = $this
            ->createQueryBuilder('tag')
            ->select('tag, articles, user, categories')
            ->leftJoin('tag.articles', 'articles')
            ->leftJoin('articles.user', 'user')
            ->leftJoin('articles.categories', 'categories')
            ->orderBy('articles.id', 'DESC')
        ;
        if (!empty($tag)) {
            $qb
                ->andWhere('tag.tag_name LIKE :tag_name')
                ->setParameter('tag_name', '%' . $tag . '%')
            ;
        }
        if (!empty($offset)) {
            $qb->setFirstResult($offset);
        }
        if (!empty($limit)) {
            $qb->setMaxResults($limit);
        }
        $query = $qb
            ->getQuery()
        ;
        $tag_result = '';
//        try {
//            $tag_result = $query->getSingleResult();
//        } catch (NoResultException $e) {
//            $tag_result = '';
//        } catch(NonUniqueResultException $e) {
//            $tag_result = $query->getResult();
//            return $tag_result;
//        }
//        $articles = '';
//        if (is_object($tag_result)) {
//            $articles = $tag_result->getArticles();
//        }
//        return $articles;
        try {
            $tag_result = $query->getResult();
        } catch (NoResultException $e) {
            $tag_result = '';
        }
        return $tag_result;
    }
}
