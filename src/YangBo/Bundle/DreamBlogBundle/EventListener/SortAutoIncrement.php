<?php
namespace YangBo\Bundle\DreamBlogBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\NoResultException;
use YangBo\Bundle\DreamBlogBundle\Entity\Category;

class SortAutoIncrement
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Category) {
            $query = $em
                ->getRepository('YangBoDreamBlogBundle:Category')
                ->createQueryBuilder('category')
                ->select('MAX(category.sort)')
                ->setMaxResults(1)
                ->getQuery();
            try {
                $max_number = $query->getSingleScalarResult();
                if (null === $entity->getSort()) {
                    $entity->setSort($max_number+1);
                }
            } catch (NoResultException $e) {
                $max_number = 0;
            }

        }
    }
}