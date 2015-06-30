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

    public function mainAction()
    {
        return $this->render('YangBoDreamBlogBundle:Admin:main.html.twig');
    }

    /**
     * 系统概览
     * @return Response
     */
    public function systemAction()
    {
        $system_infos = [
            '操作系统' => PHP_OS,
//            '运行环境' => $_SERVER['SERVER_SFOTWARE'],
//            'CPU数量' => $_SERVER['PROCESSOR_IDENTIFIER'],
            '服务器WEB端口' => $_SERVER['SERVER_PORT'],
            'PHP运行方式' => php_sapi_name(),
            'PHP版本' => PHP_VERSION . '[ <a href="http://php.net" target="_blank">查看最新版本</a> ]',
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time'),
            '服务器时间' => date('Y-m-d H:s:i'),
            '北京时间' => gmdate('Y-m-d H:s:i', time()+8*3600),
            '服务器域名' => $_SERVER['SERVER_NAME'],
            '服务器ip' => gethostbyname($_SERVER['SERVER_NAME']),
            '剩余空间' => round((@disk_free_space(".")/(1024*1024)), 2).'M',
        ];
        return $this->render(
            'YangBoDreamBlogBundle:Admin:system.html.twig',
            array(
                'system_infos' => $system_infos
            )
        );
    }

    public function categoryTreeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorys =
            $em->getRepository('YangBoDreamBlogBundle:Category')
                ->createQueryBuilder('category')
                ->getQuery()
                ->getArrayResult();
//        $category_tree = $this->toTree($categorys, 'id', 'parent_id', 'children');
        print_r($categorys);
        return $this->render('YangBoDreamBlogBundle:Admin:category_tree.html.twig');
    }

    protected function toTree($list = null, $pk = 'id', $pid = 'pid', $child = '_child')
    {
        // 创建Tree
        $tree = array();

        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();

            foreach ($list as $key => $data) {
                $_key = is_object($data)?$data->$pk:$data[$pk];
                $refer[$_key] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = is_object($data)?$data->$pid:$data[$pid];
                $is_exist_pid = false;
                foreach ($refer as $k => $v) {
                    if ($parentId==$k) {
                        $is_exist_pid = true;
                        break;
                    }
                }
                if ($is_exist_pid) {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                } else {
                    $tree[] =& $list[$key];
                }
            }
        }
        return $tree;
    }

    public function categoryAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('YangBoDreamBlogBundle:Category')
                ->createQueryBuilder('category')
                ->getQuery()
                ->getArrayResult();

            $results = $em
                ->getRepository('YangBoDreamBlogBundle:Category')
                ->createQueryBuilder('category')
                ->select('COUNT(category.id)')
                ->getQuery()
                ->getSingleScalarResult();

            $return = [ 'rows' => $data, 'results' => $results, 'hasError' => false ];
            $response = new Response(json_encode($return));
            $response->headers->set('Content-Type', 'aplication/json');
            return $response;
        }
        return $this->render('YangBoDreamBlogBundle:Admin:category.html.twig');
    }

    public function categoryDetailAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em
            ->getRepository('YangBoDreamBlogBundle:Category')
            ->find($id);
//        var_dump($category);
        return $this->render(
            'YangBoDreamBlogBundle:Admin:category_detail.html.twig',
            array(
                'category' => $category
            )
        );
    }

    public function categoryDeleteAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $ids = $request->query->get('id');
            $return = [];
            if (!empty($ids)) {
                $em = $this->getDoctrine()->getManager();
                if (is_array($ids)) {
                    foreach ($ids as $key => $id) {
                        $category = $em
                            ->getRepository('YangBoDreamBlogBundle:Category')
                            ->find($id);
                        $em->remove($category);
                    }
                } else {
                    $category = $em
                        ->getRepository('YangBoDreamBlogBundle:Category')
                        ->find($ids);
                    $em->remove($category);
                }
                $em->flush();
                $return['status'] = 'success';
            } else {
                $return['status'] = 'fail';
            }

            $response = new Response(json_encode($return));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }

    }

    public function testAction()
    {
        return new Response('Admin page');
    }
}








