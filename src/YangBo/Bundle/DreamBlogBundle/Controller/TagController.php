<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('YangBoDreamBlogBundle:Tag')
            ->createQueryBuilder('tag');
        $qb
            ->select('tag')
//            ->where('')
        ;
        return $this->render('YangBoDreamBlogBundle:Tag:index.html.twig');
    }
}