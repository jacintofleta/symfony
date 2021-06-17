<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Link;
use App\Repository\LinkRepository;
use App\Form\LinkType;

#[Route('/link', name: 'link.')]
class LinkController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(LinkRepository $linkRepository): Response
    {
        $links = $linkRepository->findAll();
        return $this->render('link/index.html.twig', [
            'links' => $links
        ]);

    }

    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $link = new Link();

        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();

            return $this->redirect($this->generateUrl(route: 'link.index'));
        }

        // entity manager
        /* $em = $this->getDoctrine()->getManager();
        $em->persist($link);
        $em->flush(); */

        return $this->render('link/create.html.twig',[
            'form' => $form->createView()
        ]);

    }
}
