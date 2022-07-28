<?php

namespace App\Controller;

use App\Entity\Word;
use App\Form\WordType;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Repository\WordRepository;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
class WordController extends AbstractController
{
    #[Route('/liste', name: 'app_word_index', methods: ['GET'])]
    public function index(WordRepository $wordRepository): Response
    {
        return $this->render('word/index.html.twig', [
            'words' => $wordRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'app_word_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WordRepository $wordRepository): Response
    {
        $word = new Word();
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wordRepository->add($word, false); //true for save in DB

            $templateProcessor = new TemplateProcessor(__DIR__ ."/DREI_ECKEN_STATUTS.docx");
            
            $templateProcessor->setValue('firstname', $word->getPrenom());
            $templateProcessor->setValue('lastname', $word->getNom());
            $templateProcessor->setValue('cin', $word->getCin());
            $templateProcessor->setValue('adresse_associe', $word->getAdresseAssocie());
            $templateProcessor->setValue('date_naissance', $word->getDateDeNaissance());
            $templateProcessor->setValue('entreprise', $word->getEntreprise());
            $templateProcessor->setValue('adresse_societe', $word->getAdresseSociete());
            header("Content-Disposition: attachment; filename=DocTest_Zak.docx");
            $templateProcessor->saveAs('php://output');

        }
        
        return $this->renderForm('word/new.html.twig', [
            'word' => $word,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_word_show', methods: ['GET'])]
    public function show(Word $word): Response
    {
        return $this->render('word/show.html.twig', [
            'word' => $word,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_word_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Word $word, WordRepository $wordRepository): Response
    {
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wordRepository->add($word, true);

            return $this->redirectToRoute('app_word_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('word/edit.html.twig', [
            'word' => $word,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_word_delete', methods: ['POST'])]
    public function delete(Request $request, Word $word, WordRepository $wordRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$word->getId(), $request->request->get('_token'))) {
            $wordRepository->remove($word, true);
        }

        return $this->redirectToRoute('app_word_index', [], Response::HTTP_SEE_OTHER);
    }
}
