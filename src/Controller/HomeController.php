<?php

namespace App\Controller;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        return $this->renderForm('home/index.html.twig', [

        ]);
    }
    #[Route('/word1', name: 'app_word')]
    public function word()
    {
  // Create a new Word document
  $phpWord = new PhpWord();

  /* Note: any element you append to a document must reside inside of a Section. */

  // Adding an empty Section to the document...
  $section = $phpWord->addSection();
  // Adding Text element to the Section having font styled by default...
  $section->addText(
      '"Learn from yesterday, live for today, hope for tomorrow. '
      . 'The important thing is not to stop questioning." '
      . '(Albert Einstein)'
  );

  // Saving the document as OOXML file...
  $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

  // Create a temporal file in the system
  $fileName="hello_world_download_file.docx";
  $temp_file = tempnam(sys_get_temp_dir(), $fileName);

  // Write in the temporal filepath
  $objWriter->save($temp_file);

  // Send the temporal file as response (as an attachment)
  $response = new BinaryFileResponse($temp_file);
  $response->setContentDisposition(
      ResponseHeaderBag::DISPOSITION_ATTACHMENT,
      $fileName
  );

  return $response;
    }
}
