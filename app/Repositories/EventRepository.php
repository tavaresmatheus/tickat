<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    protected Event $event;

    public function __construct(Event $event)
    {
        parent::__construct($event);
        $this->event = $event;
    }
}