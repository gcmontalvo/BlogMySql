<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
    
    public function indexOldAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAuxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entry_repo = $em->getRepository("AppBundle:Entry");
        $entries = $entry_repo->findAll();
        foreach($entries as $entry)
        {
            echo $entry->getTitle()."<br>";
            echo $entry->getCategory()->getName()."<br>";
            echo $entry->getUser()->getName()."<br>";
            
            $tags = $entry->getEntryTag();
            foreach($tags as $tag)
            {
                echo $tag->getTag()->getName().", ";
            }
            echo "<hr>";
        }
        die();
    }
    /**
     * @Route("/blog_2", name="blog_2")
     */
    public function indexAux2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category_repo = $em->getRepository("AppBundle:Category");
        $categories = $category_repo->findAll();
        foreach($categories as $category)
        {
            echo "**".$category->getName()."<br>";
            $entries = $category->getEntries();
            foreach($entries as $entry)
            {
                echo $entry->getTitle()."<br>";
            }
            echo "<hr>";
        }
        die();
    }
    /**
     * @Route("/blog_3", name="blog_3")
     */
    public function indexAux3Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tag_repo = $em->getRepository("AppBundle:Tag");
        $tags = $tag_repo->findAll();
        foreach($tags as $tag)
        {
            echo "**".$tag->getName()."<br>";
            $entryTag = $tag->getEntryTag();
            foreach($entryTag as $entry)
            {
                echo $entry->getEntry()->getTitle()."<br>";
            }
            echo "<hr>";
        }
        die();
    }
    /**
     * @Route("/prueba", name="prueba")
     */
    public function pruebaAction(Request $request)
    {
        echo "HOLA";
        print_r($_SESSION);
        die();
    }
}
