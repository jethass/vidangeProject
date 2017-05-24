<?php
namespace main\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use main\AppBundle\Entity\Article;
use main\AppBundle\Form\Type\ArticleType;
use Symfony\Component\HttpFoundation\Request;


class CataController extends Controller
{
    /**
     * @Route("/cata")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash(
                'notice',
                'Article  enregistrée.'
            );
        }
        return $this->render('mainAppBundle:Cata:index.html.twig', array('form'=> $form->createView()));
    }


}
