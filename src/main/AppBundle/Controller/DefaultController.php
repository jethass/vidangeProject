<?php

namespace main\AppBundle\Controller;

use main\AppBundle\Entity\Marque;
use main\AppBundle\Entity\Model;
use main\AppBundle\Form\MarqueType;
use main\AppBundle\Form\ModelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use main\AppBundle\Entity\Car;
use main\AppBundle\Form\CarType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/car")
     */
    public function indexAction(Request $request)
    {

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();
            $this->addFlash(
                'notice',
                'car  enregistrée.'
            );
        }
        return $this->render('mainAppBundle:Default:index.html.twig', array('form'=> $form->createView()));
    }

    /**
     * @Route("/marque")
     */
    public function insertMarqueAction(Request $request)
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

        return $this->render('mainAppBundle:Default:insertmarque.html.twig', array('form'=> $form->createView()));

    }
   
    /**
     * @Route("/model")
     */
    public function insertModelAction(Request $request)
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

        return $this->render('mainAppBundle:Default:insertmodel.html.twig', array('form'=> $form->createView()));

    }
}
