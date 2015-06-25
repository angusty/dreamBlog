<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function indexAction()
    {

    }

    public function loginAction(Request $request)
    {
//        echo $this->getParameter('locale');
//        echo $this->get('translator')->trans('Invalid credentials.', array(), 'security');
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $last_username = $authenticationUtils->getLastUsername();
        $author = $request->request->all();
        $errors = $this->get('validator')->validate($author);
        dump($author);
//        dump($error->getMessageKey());
//        dump($error->getMessageData());
        return $this->render(
            'YangBoDreamBlogBundle:Admin:login.html.twig',
            array(
                'last_username' => $last_username,
                'error' => $error
            )
        );
    }

    public function testAction()
    {
        return new Response('Admin page');
    }
}








