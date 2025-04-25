<?php

namespace App\Controller;

use App\Entity\Caissier;
use App\Form\CaissierType;
use App\Repository\CaissierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/caissier')]
final class CaissierController extends AbstractController{
    #[Route(name: 'app_caissier_index', methods: ['GET'])]
    public function index(CaissierRepository $caissierRepository): Response
    {
        return $this->render('caissier/index.html.twig', [
            'caissiers' => $caissierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_caissier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $caissier = new Caissier();
        $form = $this->createForm(CaissierType::class, $caissier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($caissier);
            $entityManager->flush();

            return $this->redirectToRoute('app_caissier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('caissier/new.html.twig', [
            'caissier' => $caissier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_caissier_show', methods: ['GET'])]
    public function show(Caissier $caissier): Response
    {
        return $this->render('caissier/show.html.twig', [
            'caissier' => $caissier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_caissier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Caissier $caissier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CaissierType::class, $caissier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_caissier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('caissier/edit.html.twig', [
            'caissier' => $caissier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_caissier_delete', methods: ['POST'])]
    public function delete(Request $request, Caissier $caissier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caissier->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($caissier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_caissier_index', [], Response::HTTP_SEE_OTHER);
    }
}
