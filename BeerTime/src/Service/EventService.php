<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 14:54
 */

namespace App\Service;



use App\Entity\TableEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class EventService
{
    private $entityManager;
    private $repository;

    /**
     * EventService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager )
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(TableEvent::class);
    }

    /**
     * @Route("/events", name="event_list")
     */
    public function getAll($sort = 'id') {
        return $this->repository->findby(array(), [$sort => 'ASC']);
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     * @param $id
     * @return TableEvent|null|object
     */
    public function get($id) {
        return $this->repository->find($id);
    }
    public function getRandom() {
        $events = $this->getAll();
        shuffle( $events );
        $now = new \DateTime();

        foreach ( $events as $event ) {
            if ( $event->getStartAt() <= $now AND $event->getEndAt() > $now ) {
                return $event;
            }
        }
        return false;
    }

    public function getByName($name)
    {
        return $this->repository->findByName($name);
    }

    public function futurEvents()
    {
        return $this->repository->futureEvents();
    }
}