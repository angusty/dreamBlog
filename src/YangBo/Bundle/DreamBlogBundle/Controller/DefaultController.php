<?php

namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('YangBoDreamBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
