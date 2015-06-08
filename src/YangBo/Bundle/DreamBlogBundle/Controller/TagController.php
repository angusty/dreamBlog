<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    public function indexAction(Request $request, $tag, $page)
    {
        $max_tags_on_index = $this->getParameter('max_tags_on_index');
        $em = $this->getDoctrine()->getManager();
        $count = $em
            ->getRepository('YangBoDreamBlogBundle:Tag')
            ->countArticleWithTag($tag)
        ;
        // 总页数
        $last_page_number = ceil($count/$max_tags_on_index);
        // 上一页
        $previous_page = $page-1 > 0 ? $page-1 : 1;
        // 下一页
        $next_page = $page < $last_page_number ? $page+1 : $last_page_number;
        $qb = $em
            ->getRepository('YangBoDreamBlogBundle:Tag')
            ->createQueryBuilder('tag')
            ->select('tag, articles')
            ->leftjoin('tag.articles', 'articles')
//            ->where($qb->expr()->like('tag.tag_name', ':tag_name'))
//            ->where('tag.tag_name LIKE :tag_name')
//            ->setParameter('tag_name', '%' . $tag . '%')
            ->orderBy('articles.created_at', 'DESC')
        ;
        if (!empty($tag)) {
            $qb
                ->andWhere('tag.tag_name LIKE :tag_name')
                ->setParameter('tag_name', '%' . $tag . '%');
        }
        $offset = $page - 1;
        $limit = $max_tags_on_index;
        if (!empty($offset)) {
            $qb->setFirstResult($offset);
        }
        if (!empty($limit)) {
            $qb->setMaxResults($limit);
        }
        $query = $qb
//            ->select('tag')
            ->getQuery()
           ;

        $tag = '';
        try {
            $tag = $query->getSingleResult();
        } catch (NoResultException $e) {
            $tag = '';
        }
        $articles = $tag->getArticles();
        dump($tag->getArticles());
//        foreach ($articles as $key => $value) {
//            dump($value);
//        }
        return $this->render('YangBoDreamBlogBundle:Tag:index.html.twig');
    }
}