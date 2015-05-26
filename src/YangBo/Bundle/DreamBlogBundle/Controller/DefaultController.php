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
        $articles = $em
//                    ->createQuery('SELECT article FROM YangBo\Bundle\DreamBlogBundle\Entity\Article article WHERE article.is_recommend = :recommend')
                    ->createQuery('SELECT article FROM YangBoDreamBlogBundle:Article article WHERE article.is_recommend = :recommend ')
//                    ->createQuery('SELECT article,u FROM YangBoDreamBlogBundle:Article article LEFT JOIN article.user u WHERE article.is_recommend = :recommend ')
                    ->setParameter('recommend', true)
                    ->getResult();
//        dump($result);
//        $user = $result[0];
//        $user = $user->getUser();
//        dump($user->getNickName());
        return $this->render('YangBoDreamBlogBundle:Default:index.html.twig', array('articles' => $articles));
    }
}
