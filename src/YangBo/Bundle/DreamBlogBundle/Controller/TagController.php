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
        // 分页 偏移量 切记： 分页总是从第一页开始 而数据库的偏移量 默认从0开始
        $offset = $max_tags_on_index * ($page-1);
        $tag_articles = $tag_repository
            ->getArticleWithTag($tag, $offset, $max_tags_on_index)
        ;
        return $this->render('YangBoDreamBlogBundle:Tag:index.html.twig',
            array(
                'tag_articles' => $tag_articles,
                'last_page_number' => $last_page_number,
                'page' => $page,
                'previous_page' => $previous_page,
                'next_page' => $next_page,
                'last_page_number' => $last_page_number
            )
        );
    }
}