<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em
            ->getRepository('YangBoDreamBlogBundle:Article')
            ->find($id);
        dump($article);
        return $this->render(
            'YangBoDreamBlogBundle:Article:show.html.twig',
            array(
                'article' => $article
            )
        );
    }
}