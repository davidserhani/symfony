<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 28/06/2018
 * Time: 09:36
 */

namespace App\Controller;


use App\Entity\TableEvent;
use App\Form\FormType;
use App\Service\EventService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{

    /**
     * @Route("/events", name="event_list")
     * @param EventService $eventService
     * @param Request $request
     * @return Response
     */
    public function list(EventService $eventService, Request $request) {
        $search = $request->query->get('search');
        if ( !empty($search) ) {
            return $this->render('event/events.html.twig', [
                'events' => $eventService->getByName($search),
                'future' => $eventService->futurEvents()
            ]);
        }
        $sort = !empty($request->query->get('sort')) ? $request->query->get('sort') : 'id';
        return $this->render('event/events.html.twig', [
            'events' => $eventService->getAll($sort),
            'future' => $eventService->futurEvents()
            ]);
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     * @param EventService $eventService
     * @param $id
     * @return Response
     */
    public function ShowEvent( EventService $eventService, $id) {
        $event = $eventService->get($id);
            if ( !empty($event) ) {
                return $this->render('event/single_event.html.twig', [
                    'event' => $event
                ]);
            }
        return $this->render('main/error.html.twig', [
            'status' => 404]);
    }

    /**
     * @Route("/event/create", name="event_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function create( Request $request ) {
        $event = new TableEvent();
        $form = $this->createForm(FormType::class, $event);
        $form->handleRequest($request);
        if ( $form->isSubmitted() AND $form->isValid() )
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('event/create.html.twig', [
            'formEvent'=> $form->createView()
        ]);
    }
    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join($id) {
        return new Response('Join event');
    }

    /**
     * @Route("/need-a-beer", name="event_random")
     * @param EventService $eventService
     * @return Response
     */
    public function random( EventService $eventService ) {
        $event = $eventService->getRandom();
        if ( $event ) {
            return $this->render('event/single_event.html.twig', [
                'event' => $event
            ]);
        }
        return $this->render('main/error.html.twig', [
            'status' => 404]);
    }

}