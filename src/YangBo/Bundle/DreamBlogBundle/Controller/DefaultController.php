<?php

namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //推荐 文章 显示 条数
        $recommend_articles_show_count = $this->getParameter('recommend_articles_show_count');
        $recommend_articles = $em
            ->getRepository('YangBoDreamBlogBundle:Article')
            ->getRecommendArticles($recommend_articles_show_count);

        //最新 文章 显示 条数
//        $newest_articles_show_count = $this->getParameter('newest_articles_show_count');
//        $newest_articles = $em
//            ->getRepository('YangBoDreamBlogBundle:Article')
//            ->getNewestArticles($newest_articles_show_count);

//        //点击排行 显示 条数
//        $most_view_articles_show_count = $this->getParameter('most_view_articles_show_count');
//        //点击排行
//        $most_view_articles = $em
//            ->getRepository('YangBoDreamBlogBundle:Article')
//            ->getMostViewArticles($most_view_articles_show_count);
        return $this->render(
            'YangBoDreamBlogBundle:Default:index.html.twig',
            array(
                'recommend_articles' => $recommend_articles
            )
        );
    }
}
