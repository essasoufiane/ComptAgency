<?php

namespace App\Controller;

use DateTime;
use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/messages')]
class MessagesController extends AbstractController
{
    #[Route('/recevied', name: 'app_messages_recevied', methods: ['GET'])]
    public function recevied(MessagesRepository $messagesRepository): Response
    {
        return $this->render('messages/recevied.html.twig', [
            'messages' => $messagesRepository->findAll(),
        ]);
    }

    #[Route('/sent', name: 'app_messages_sent', methods: ['GET'])]
    public function sent(MessagesRepository $messagesRepository): Response
    {
        return $this->render('messages/sent.html.twig', [
            'messages' => $messagesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessagesRepository $messagesRepository): Response
    {
        $message = new Messages();
        $message->setCreatedAt(new \DateTimeImmutable());//enregistre la date de création
        $message->setIsRead(false);
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setSender($this->getUser());//enregistre l'expediteur
            $messagesRepository->add($message, true);

            return $this->redirectToRoute('app_messages_sent', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messages/new.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}sent', name: 'app_messages_showSent', methods: ['GET'])]
    public function showSent(Messages $message): Response
    {
        return $this->render('messages/showSent.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_show', methods: ['GET'])]
    public function show(Messages $message, MessagesRepository $messagesRepository): Response
    {
        $message->setIsRead(true); //message lu
        $messagesRepository->add($message, true);
        return $this->render('messages/show.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Messages $message, MessagesRepository $messagesRepository): Response
    {
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messagesRepository->add($message, true);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messages/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_delete', methods: ['POST'])]
    public function delete(Request $request, Messages $message, MessagesRepository $messagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $messagesRepository->remove($message, true);
        }

        return $this->redirectToRoute('app_messages_recevied', [], Response::HTTP_SEE_OTHER);
    }
}
