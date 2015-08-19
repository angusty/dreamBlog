<?php
namespace YangBo\Bundle\DreamBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * jsonp
     * @param Request $request
     * @return jsonp
     */
    public function testAction(Request $request)
    {
        $callback = $request->query->get('callback');
        $code = $request->query->get('code') ? $request->query->get('code') : 'hello';
        $return = ['status' => 0];
        switch ($callback) {
            case 'getAll':
                $return['status'] = 1;
                $return['data'] = ['code' => $code, 'callback' => $callback];
                break;
            default:
                $return['data'] = 'no result';
                break;
        }
        $response = new JsonResponse($return);
        $response->setCallback($callback);
        return $response;
    }
}
