<?php

namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
//        $name = $request->query->get('name');
        $em = $this->getDoctrine()->getManager();
        //推荐 文章
        $recommend_articles = $em
//            ->createQuery('SELECT article FROM YangBo\Bundle\DreamBlogBundle\Entity\Article article WHERE article.is_recommend = :recommend')
//            ->createQuery('SELECT article FROM YangBoDreamBlogBundle:Article article WHERE article.is_recommend = :recommend ')
            ->createQuery('SELECT article,u FROM YangBoDreamBlogBundle:Article article LEFT JOIN article.user u WHERE article.is_recommend = :recommend ')
            ->setParameter('recommend', true)
            ->getResult();
//        dump($result);
//        $user = $result[0];
//        $user = $user->getUser();
//        dump($user->getNickName());
        $newest_articles_show_count = $this->getParameter('newest_articles_show_count');
        // 最新 文章
        $newest_articles = $em
            ->createQuery('SELECT article FROM YangBoDreamBlogBundle:Article article ORDER BY article.created_at DESC, article.page_view_count DESC')
            ->setMaxResults($newest_articles_show_count)
            ->getResult();

        $most_view_articles_show_count = $this->getParameter('most_view_articles_show_count');
        //点击排行
        $most_view_articles = $em
            ->createQuery('SELECT article FROM YangBoDreamBlogBundle:Article article ORDER BY article.page_view_count DESC')
            ->setMaxResults($most_view_articles_show_count)
            ->getResult();
        dump($most_view_articles);
        return $this->render(
            'YangBoDreamBlogBundle:Default:index.html.twig',
            array(
                'recommend_articles' => $recommend_articles,
                'newest_articles' => $newest_articles,
                'most_view_articles' => $most_view_articles
            )
        );
    }
}
