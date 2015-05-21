<?php

namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $name = $request->query->get('name');
        return $this->render('YangBoDreamBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
