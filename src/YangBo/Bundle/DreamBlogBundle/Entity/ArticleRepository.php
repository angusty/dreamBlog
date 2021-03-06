<?php

namespace YangBo\Bundle\DreamBlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    // 推荐文章
    public function getRecommendArticles($count = null)
    {
        //推荐 文章
        $dql_sql = 'SELECT article,u FROM YangBoDreamBlogBundle:Article article LEFT JOIN article.user u WHERE article.is_recommend = :recommend ';
        $recommend_articles = $this->getEntityManager($dql_sql)
//            ->createQuery('SELECT article FROM YangBo\Bundle\DreamBlogBundle\Entity\Article article WHERE article.is_recommend = :recommend')
//            ->createQuery('SELECT article FROM YangBoDreamBlogBundle:Article article WHERE article.is_recommend = :recommend ')
            ->createQuery($dql_sql)
            ->setParameter('recommend', true)
            ->setMaxResults($count)
            ->getResult();
        return $recommend_articles;
    }

    //最新文章
    public function getNewestArticles($count = null)
    {
        $dql_sql = 'SELECT article FROM YangBoDreamBlogBundle:Article article ORDER BY article.created_at DESC, article.page_view_count DESC';
        // 最新 文章
        $newest_articles = $this
            ->getEntityManager()
            ->createQuery($dql_sql)
            ->setMaxResults($count)
            ->getResult();
        return $newest_articles;
    }

    public function getMostViewArticles($count = null)
    {
        $most_view_articles = $this
            ->getEntityManager()
            ->createQuery('SELECT article FROM YangBoDreamBlogBundle:Article article ORDER BY article.page_view_count DESC')
            ->setMaxResults($count)
            ->getResult();
        return $most_view_articles;
    }

    public function countArticleWithTag($tag = '')
    {
        $qb = $this->createQueryBuilder('article')
            ->select('COUNT(DISTINCT article.id)')
            ->leftJoin('article.tags', 'tags')
            ;
        if (!empty($tag)) {
            $qb
                ->andWhere('tags.tag_name LIKE :tag_name')
                ->setParameter('tag_name', '%' . $tag . '%');
        }
        $query = $qb->getQuery();
        return $query->getSingleScalarResult();


        //native sql
//        $where = 'WHERE 1';
//        if (!empty($tag)) {
//            $where .= " AND t.tag_name LIKE :tag_name";
//        }
//
//        $sql = "SELECT COUNT(*) AS count, article.id AS id FROM article
//                LEFT JOIN article_tag at ON article.id = at.article_id
//                LEFT JOIN tag t ON t.id = at.tag_id {$where}
//                GROUP BY article.id";
//        $rsm = new ResultSetMapping();
//        $rsm->addScalarResult('id', 'id');
//        $rsm->addScalarResult('count', 'count');
//        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
//        if (!empty($tag)) {
//            $query->setParameter('tag_name', $tag);
//        }
//        return $query->getResult();
    }

    public function getArticleWithTag($tag = '', $offset = 0, $limit = '')
    {
        $where = '';
        if (!empty($tag)) {
            $where .= 'AND tags.tag_name LIKE :tag_name ';
        }
//        $where .= 'AND article.title = \'a\'';  # 单引号 注意$dql是双引号 这里只能是单引号 坑了
        if (!empty($where)) {
            $where = 'WHERE ' . ltrim($where, 'AND');
        }

//        $dql = "SELECT
//                  article,
//                  group_concat(tags.tag_name SEPARATOR ',') AS t  #加上这个条件 循环不出来数据
//                FROM
//                  YangBoDreamBlogBundle:Article article
//                LEFT JOIN
//                  article.tags tags
//                {$where}
//                GROUP BY
//                  article.id";
        $dql = "SELECT
                  article
                FROM
                  YangBoDreamBlogBundle:Article article
                LEFT JOIN
                  article.tags tags
                {$where}
                GROUP BY
                  article.id";

        $query = $this->getEntityManager()->createQuery($dql);

        if (!empty($tag)) {
            $query->setParameter('tag_name', '%' . $tag . '%');
        }

        if (!empty($offset)) {
            $query->setFirstResult($offset);
        }
        if (!empty($limit)) {
            $query->setMaxResults($limit);
        }
        $article_tags = '';
        try {
            $article_tags = $query->getResult();
        } catch (NoResultException $e) {
            $article_tags = '';
        }
        return $article_tags;
    }

}
