<?php
/**
 * Created by PhpStorm.
 * User: Fabrice
 * Date: 06/07/2017
 * Time: 23:35
 */

namespace AppBundle\Controller;

use AppBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * @Route("/product/new",name="app_product_new")
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
       /* if ($request->isMethod('POST')){
            $em = $this->get('doctrine')->getManager();
            $product = new Product();
            $form = $this->createForm(ProductType::class, $product);
            $form->handleRequest($request);



            $nameFile = $product->getBrochure();
            return $this->render("product/view.html.twig",array('nameFile'=>$nameFile));
        }*/

        $em = $this->get('doctrine')->getManager();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($request->isMethod('POST')){
            $old = umask(0777);
            $file = $product->getBrochure();
            $fileName = $fileUploader->upload($file);

            $product->setBrochure($fileName);
            $em->persist($product);
            $em->flush();

            umask($old);
            return $this->render("product/view.html.twig",array('nameFile'=>$fileName));
        }

       /* if ($form->isSubmitted() && $form->isValid()) {

            $old = umask(0777);
            $file = $product->getBrochure();
            $fileName = $fileUploader->upload($file);

            $product->setBrochure($fileName);
            $em->persist($product);
            $em->flush();

            umask($old);
            //echo $file->getPerms();
            //exit;
            //return $this->redirect($this->generateUrl('app_product_view',array(
            //    'name' => $fileName
            //)));

            //$content = array();
            //$content['html'] = $this->renderView("product/view.html.twig", array('nameFile'=>$fileName));
             //   return new Response(json_encode($content),200,array('Content-Type'=>'application/json'));

            return $this->render("product/view.html.twig",array('nameFile'=>$fileName));
        }*/

        return $this->render("product/new.html.twig", array('form' => $form->createView(),));
    }


    /**
     *
     * @Route("/product/image/{name}",name="app_product_view")
     */
    public function viewAction($name,Request $request)
    {
        //$fileName = $request->request->get('name','');

        $fileName ='';

        $nameFile = $name;

        return $this->render("product/view.html.twig",array('nameFile'=>$nameFile));

    }

    /**
     * @Route("/product/test",name="app_product_test")
     *
     */
    public function testAction(Request $request){
        $nameFile = 'test.jpg';
        return $this->render("product/view.html.twig",array('nameFile'=>$nameFile));
    }
}