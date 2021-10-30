<?php


namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\AbstractFormClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NoteApiController extends AbstractApiController
{
  public function indexAction(NoteRepository $noteRepository): Response
  {
    $notes = $this->getDoctrine()->getRepository(Note::class)->findAll();
    return $this->json($notes);
  }

  public function createAction(Request $request): Response
  {
    $note = new Note();
    $data = json_decode($request->getContent(), true);

    $form = $this->createForm(NoteType::class, $note);
    $form->submit($data);

    if (!$form->isValid()) {
      return $this->respond($form, Response::HTTP_BAD_REQUEST);

      exit;
    }

    $em = $this->getDoctrine()->getManager();
    $em->persist($note);
    $em->flush();

    $response = new Response($this->json($note));
    $response->setStatusCode(Response::HTTP_OK);

    return $response;
  }
}