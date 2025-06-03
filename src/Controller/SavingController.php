<?php

namespace App\Controller;

use App\Entity\Saving;
use App\Form\SavingForm;
use App\Repository\SavingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/saving')]
final class SavingController extends AbstractController
{
    #[Route(name: 'app_saving_index', methods: ['GET'])]
    public function index(SavingRepository $savingRepository): Response
    {
        return $this->render('saving/index.html.twig', [
            'savings' => $savingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_saving_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $saving = new Saving();
        $form = $this->createForm(SavingForm::class, $saving);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($saving);
            $entityManager->flush();

            return $this->redirectToRoute('app_saving_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('saving/new.html.twig', [
            'saving' => $saving,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_saving_show', methods: ['GET'])]
    public function show(Saving $saving): Response
    {
        return $this->render('saving/show.html.twig', [
            'saving' => $saving,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_saving_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Saving $saving, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SavingForm::class, $saving);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_saving_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('saving/edit.html.twig', [
            'saving' => $saving,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_saving_delete', methods: ['POST'])]
    public function delete(Request $request, Saving $saving, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saving->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($saving);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_saving_index', [], Response::HTTP_SEE_OTHER);
    }
}
