<?php

namespace main\AppBundle\Controller;

use main\AppBundle\Entity\Marque;
use main\AppBundle\Entity\Model;
use main\AppBundle\Entity\Tag;
use main\AppBundle\Form\Type\MarqueType;
use main\AppBundle\Form\Type\ModelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use main\AppBundle\Entity\Car;
use main\AppBundle\Form\Type\CarType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function listCarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cars=$em->getRepository('mainAppBundle:Car')->findAll();
        return $this->render('mainAppBundle:Default:listcar.html.twig', array('cars'=> $cars));
    }


    /**
     * @Route("/car")
     */
    public function createCarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        if ($form->handleRequest($request)->isValid()) {
            $image_principal=$car->getImagePrincipale();
            $file_principal = $image_principal->getFile();
            $filename_principal = md5(uniqid()) . '.' .$file_principal->guessExtension();
            $file_principal->move($this->getParameter('upload_path'), $filename_principal);
            $image_principal->setFile($filename_principal);
            $image_principal->setCar($car);

            $images = $car->getImages();
            if ($images) {
                foreach($images as $image)
                {
                    $file = $image->getFile();
                    $filename = md5(uniqid()) . '.' .$file->guessExtension();
                    $file->move($this->getParameter('upload_path'), $filename);
                    $image->setFile($filename);
                    $image->setCar($car);
                }
            }
            $em->persist($car);
            $em->flush();
            $this->addFlash(
                'notice',
                'car  enregistrée.'
            );
        }
        return $this->render('mainAppBundle:Default:createcar.html.twig', array('form'=> $form->createView()));
    }

    /**
     * @Route("/getmodelsmarque/{id_marque}", options={"expose"=true}, name="models_for_marque")
     */
    public function getModelsMarqueAction(Request $request,$id_marque)
    {
      if($request->isXmlHttpRequest()){
          $em=$this->getDoctrine()->getManager();
          $models_list=$em->getRepository('mainAppBundle:Model')->findBy(array('marque' => $id_marque));
           if ($models_list){
               $models=array();
               foreach ($models_list as $model){
                   $models[$model->getId()]=$model->getName();
               }
           }  else{
               $models=null;
           }

          $tags_list=$em->getRepository('mainAppBundle:Tag')->findBy(array('marque' => $id_marque));
          if ($tags_list){
              $tags=array();
              foreach ($tags_list as $tag){
                  $tags[$tag->getId()]=$tag->getName();
              }
          }  else{
              $tags=null;
          }
          
           $response=new JsonResponse();
           return $response->setData(array('models'=>$models,'tags'=>$tags));
      }else{
          throw new \Exception('erreur');
      }
    }

    /**
     * @Route("/marque")
     */
    public function CreateMarqueAction(Request $request)
    {

        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();

            $this->addFlash(
                'notice',
                'Marque  enregistrée.'
            );

        }

        return $this->render('mainAppBundle:Default:createmarque.html.twig', array('form'=> $form->createView()));

    }
   
    /**
     * @Route("/model")
     */
    public function CreateModelAction(Request $request)
    {

        $model = new Model();
        $form = $this->createForm(ModelType::class, $model);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();

            $this->addFlash(
                'notice',
                'Model  enregistrée.'
            );
        }

        return $this->render('mainAppBundle:Default:createmodel.html.twig', array('form'=> $form->createView()));
    }


    /**
     * @Route("/loadtags")
     */
    public function loaFisxturesTagsdAction()
    {
        $em = $this->getDoctrine()->getManager();
        $marque=$em->getRepository('mainAppBundle:Marque')->findOneBy(array('name'=>'Fiat'));
        $tags = array(
            'DCT',
            'MULTIJET',
        );
        foreach ($tags as $tag) {
            $t = new Tag();
            $t->setName($tag);
            $t->setMarque($marque);
            $em->persist($t);
        }
        $em->flush();
        die;
    }
}
