<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function indexAction()
    {

    }

    public function loginAction()
    {
        return $this->render('YangBoDreamBlogBundle:Admin:login.html.twig');
    }

    public function testAction()
    {
        return new Response('Admin page');
    }
}