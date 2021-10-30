<?php


namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\AbstractFormClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NoteApiController extends AbstractApiController
{
  public function indexAction(NoteRepository $noteRepository): Response
  {

    $repo = $this->getDoctrine()->getRepository(Note::class);

    $notes = $repo->findBy(array(), array('created_time'=>'asc'));

//    print_r($notes);
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

  public function findByIdAction(Request $request):Response
  {
    $id = $request->get('id');

    $note = $this->getDoctrine()->getRepository(Note::class)->findOneBy([
        'id' => $id
    ]);

    if (!$note)
    {
      throw new NotFoundHttpException('Note with id '.$id. ' not found!');
    }

    return $this->json($note);
  }

  public function updateByIdAction(Request $request):Response
  {
    $id = $request->get('id');

    $data = json_decode($request->getContent(), true);

    $note = $this->getDoctrine()->getRepository(Note::class)->findOneBy([
        'id' => $id
    ]);

    if (!$note)
    {
      throw new NotFoundHttpException('Note with id '.$id. ' not found!');
    }

    $form = $this->createForm(NoteType::class, $note, [

    ]);

    $form->submit($data);

    if (!$form->isSubmitted() || !$form->isValid())
    {
      return $this->respond($form,Response::HTTP_BAD_REQUEST);
    }

    $em = $this->getDoctrine()->getManager();
    $em->persist($note);
    $em->flush();

    $response =  new Response($this->json($note));
    $response->setStatusCode(Response::HTTP_OK);

    return $response;

  }

  public function deleteByIdAction(Request $request):Response
  {
    $id = $request->get('id');

    $note = $this->getDoctrine()->getRepository(Note::class)->findOneBy([
        'id' => $id
    ]);

    if (!$note)
    {
      throw new NotFoundHttpException('Note with id '.$id. ' not found!');
    }

    $em = $this->getDoctrine()->getManager();
    $em->remove($note);
    $em->flush();

    $response = new Response();
    $response->setStatusCode(Response::HTTP_OK);
    $message = 'Deleted Successfully!';

    return $response->setContent($this->json($message));

  }

}