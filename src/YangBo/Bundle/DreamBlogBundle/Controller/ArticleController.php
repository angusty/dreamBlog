<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (empty($id)) {
            throw new NotFoundHttpException('不存在的文章');
        } else {
            $article = $em
                ->getRepository('YangBoDreamBlogBundle:Article')
                ->find($id);
            if (null === $article) {
                throw $this->createNotFoundException('不存在的文章');
//                throw new NotFoundHttpException('不存在的文章');
            }
        }

        return $this->render(
            'YangBoDreamBlogBundle:Article:show.html.twig',
            array(
                'article' => $article
            )
        );
    }

    public function rightNewsSkeletonAction()
    {
        $em = $this->getDoctrine()->getManager();
        //最新 文章 显示 条数
        $newest_articles_show_count = $this->getParameter('newest_articles_show_count');
        $newest_articles = $em
            ->getRepository('YangBoDreamBlogBundle:Article')
            ->getNewestArticles($newest_articles_show_count);

        //点击排行 显示 条数
        $most_view_articles_show_count = $this->getParameter('most_view_articles_show_count');
        //点击排行
        $most_view_articles = $em
            ->getRepository('YangBoDreamBlogBundle:Article')
            ->getMostViewArticles($most_view_articles_show_count);
        return $this->render(
            'YangBoDreamBlogBundle:Public:right_news_skeleton.html.twig',
            array(
                'newest_articles' => $newest_articles,
                'most_view_articles' => $most_view_articles
            )
        );
    }
}