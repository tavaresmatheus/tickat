<?php

namespace App\Businesses;

use App\Businesses\Contracts\EventBusinessInterface;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class EventBusiness implements EventBusinessInterface
{
    protected EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function listAllEvents(): object
    {
        return $this->eventRepository->listAll();
    }

    public function createEvent(array $eventInformation): object
    {
        $eventInformation['opening'] ?? '';
        $eventInformation['closing'] ?? '';
        $eventInformation['status'] ?? 'Active';
        $eventInformation['capacity'] ?? 0;

        $validator = Validator::make(
            $eventInformation,
            [
                'eventName' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'capacity' => 'numeric',
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $this->eventRepository->create($eventInformation);
    }
}