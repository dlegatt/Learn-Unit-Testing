<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GuestBook;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class GuestBookController extends Controller
{
    /**
     * @return JsonResponse
     * @Route("/guestbook", name="guestbook_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entries = $this->getDoctrine()->getRepository('AppBundle:GuestBook')->findAll();
        return new JsonResponse($entries);
    }

    /**
     * @param Request $request
     * @Route("/guestbook/new", name="guestbook_new")
     * @Method("POST")
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        $gb = new GuestBook();
        $gb
            ->setName($data['name'])
            ->setComment($data['comment']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($gb);
        $em->flush();
        return new JsonResponse(
            [
                'entry' => $gb
            ],
            201
        );
    }

    /**
     * @param GuestBook $guest
     * @return JsonResponse
     * @Route("/guestbook/{id}",name="guestbook_view")
     * @Method("GET")
     */
    public function viewAction(GuestBook $guest)
    {
        return new JsonResponse([
            'entry' => $guest
        ]);
    }
}
