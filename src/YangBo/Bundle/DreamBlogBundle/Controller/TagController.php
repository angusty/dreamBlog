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
        $tag_repository = $em->getRepository('YangBoDreamBlogBundle:Tag');
        $count = $tag_repository
            ->countArticleWithTag($tag)
        ;
        // 总页数
        $last_page_number = ceil($count/$max_tags_on_index);
        // 上一页
        $previous_page = $page-1 > 0 ? $page-1 : 1;
        // 下一页
        $next_page = $page < $last_page_number ? $page+1 : $last_page_number;

        $articles = $tag_repository
            ->getArticleWithTag($tag, $page-1, $max_tags_on_index);
        dump($count);
        dump($last_page_number);
        dump($articles);
//        foreach ($articles as $key => $value) {
//            dump($value);
//        }
        return $this->render('YangBoDreamBlogBundle:Tag:index.html.twig');
    }
}