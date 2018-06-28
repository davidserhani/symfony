<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 28/06/2018
 * Time: 09:36
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    private $events = array(
        [ 'id' => 0, 'name' => 'OktoberTwist', 'description' => 'You love autumn, you love tourtel Twist... enjoy The OktoberTwist', 'address' => '3 albert street', 'city' => 'Lille', 'zip' => '5900', 'country' => 'Fr', 'capacity' => 10, 'start_at' => '20-06-2018 19:00:00', 'end_at' => '21-06-2018 06:00:00', 'poster' => 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/701/beer-main-0-1496757601.jpg?resize=768:*', 'price' => 'free', 'owner' => 'Fabious'],
        [ 'id' => 1, 'name' => 'ElleFlex', 'description' => 'Come to watch girls stretching out while sippin beer and listening to Corona ', 'address' => '666 WeissWurst Straat', 'city' => 'Munchen', 'zip' => '1897', 'country' => 'GER', 'capacity' => 50, 'start_at' => '29-06-2018 18:00:00', 'end_at' => '29-06-2018 23:00:00', 'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0KFHKEPAFkDVLsoWw-fiQkk11lrA7AylVL2rZGJJYRnr2SeuHZw', 'price' => 'free', 'owner' => 'Fabious' ]
        );
    /**
     * @Route("/events", name="event_list")
     */
    public function list() {
        return $this->render('event/events.html.twig', [
            'events' => $this->events,
            'title' => 'Events'
            ]);
    }
    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function ShowEvent($id) {
        return $this->render('event/single_event.html.twig', [
            'event' => $this->events[$id]
        ]);
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
}