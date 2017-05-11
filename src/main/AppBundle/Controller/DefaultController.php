<?php

namespace main\AppBundle\Controller;

use main\AppBundle\Entity\Marque;
use main\AppBundle\Form\MarqueType;
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
    public function indexAction()
    {

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
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

            $request->getSession()->getFlashBag()->add('notice', 'Marque  enregistrée.');

        }

        return $this->render('mainAppBundle:Default:insertmarque.html.twig', array('form'=> $form->createView()));

    }
}
