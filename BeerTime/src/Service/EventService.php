<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 14:54
 */

namespace App\Service;



use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;


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
        $this->repository = $entityManager->getRepository(Event::class);
    }

    /**
     * @Route("/events", name="event_list")
     * @param string $sort
     * @return Event[]|array
     */
    public function getAll($sort = 'id') {
        return $this->repository->findby(array(), [$sort => 'ASC']);
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     * @param $id
     * @return Event|null|object
     */
    public function get($id) {
        return $this->repository->find($id);
    }
    public function getRandom() {
        return $this->repository->getRandom();
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