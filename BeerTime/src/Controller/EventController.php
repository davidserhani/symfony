<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 28/06/2018
 * Time: 09:36
 */

namespace App\Controller;


use App\Service\EventService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{

    /**
     * @Route("/events", name="event_list")
     * @param EventService $eventService
     * @return Response
     */
    public function list( EventService $eventService ) {
        return $this->render('event/events.html.twig', [
            'events' => $eventService->getAll(),
            'title' => 'Events'
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
            if ( $event ) {
                return $this->render('event/single_event.html.twig', [
                    'event' => $event
                ]);
            }
        return $this->render('main/error.html.twig', [
            'status' => 404]);
    }
    /**
     * @Route("/event/create", name="event_create")
     */
    public function create() {
        return new Response('Create an event');
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