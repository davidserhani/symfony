<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 14:54
 */

namespace App\Service;



use Doctrine\ORM\EntityManagerInterface;

class EventService
{
    private $events;


    /**
     * EventService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager )
    {
        $this->events = array(
            [ 'id' => 1, 'name' => 'OktoberTwist', 'description' => 'You love autumn, you love tourtel Twist... enjoy The OktoberTwist', 'address' => '3 albert street', 'city' => 'Lille', 'zip' => '5900', 'country' => 'fr', 'capacity' => 10, 'start_at' => new \DateTime('2018-06-20 19:00:00'), 'end_at' => new \DateTime( '2018-06-21 06:00:00'), 'poster' => 'https://www.sportsmarketing.fr/wp-content/uploads/2016/02/tourtel-twist-groupe-carlsberg.jpg', 'price' => 'free', 'owner' => 'Fabious'],
            [ 'id' => 2, 'name' => 'ElleFlex', 'description' => 'Work out while sippin beers and listening to Corona', 'address' => '666 WeissWurst Straat', 'city' => 'Munchen', 'zip' => '1897', 'country' => 'ge', 'capacity' => 50, 'start_at' => new \DateTime('2018-06-29 8:00:00'), 'end_at' => new \DateTime('2018-06-29 23:00:00'), 'poster' => 'http://www.rtvbn.com/assets/img/27-06-2017/8fe1440ec5a0b675949cca06329723c5.jpg', 'price' => 'free', 'owner' => 'Fabious' ]
        );
    }

    /**
     * @Route("/events", name="event_list")
     */
    public function getAll() {
        return $this->events;
    }
    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function get($id) {
        foreach ($this->events as $event) {
            if ($event['id'] == $id) {
                return $event;
            }
        }
        return false;
    }
    public function getRandom() {
        $events = $this->events;
        shuffle( $events );
        $now = new \DateTime();
        foreach ( $events as $event ) {
            if ( $event['start_at'] <= $now AND $event['end_at'] > $now ) {
                return $event;
            }
        }
        return false;
    }
}