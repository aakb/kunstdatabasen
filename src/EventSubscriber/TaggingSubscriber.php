<?php

namespace App\EventSubscriber;

use App\Entity\Item;
use App\Service\TagService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TaggingSubscriber implements EventSubscriber
{
    private $tagService;

    /**
     * TaggingSubscriber constructor.
     *
     * @param \App\Service\TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->changeTags('persist', $args);
    }

    /**
     * {@inheritdoc}
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->changeTags('update', $args);
    }

    /**
     * Save the new tag.
     *
     * @param string $action
     * @param \Doctrine\Persistence\Event\LifecycleEventArgs $args
     */
    private function changeTags(string $action, LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Item) {
            $organization = $entity->getOrganization();
            $building = $entity->getBuilding();
            $type = $entity->getType();
            $address = $entity->getAddress();
            $city = $entity->getCity();
            $room = $entity->getRoom();
            $location = $entity->getLocation();

            $type !== null && $this->tagService->addTag($entity, 'type', $type);
            $organization !== null && $this->tagService->addTag($entity, 'organization', $organization);
            $building !== null && $this->tagService->addTag($entity, 'building', $building);
            $address !== null && $this->tagService->addTag($entity, 'address', $address);
            $city !== null && $this->tagService->addTag($entity, 'city', $city);
            $room !== null && $this->tagService->addTag($entity, 'room', $room);
            $location !== null && $this->tagService->addTag($entity, 'location', $location);
        }
    }
}