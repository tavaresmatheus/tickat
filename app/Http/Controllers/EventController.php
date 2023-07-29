<?php

namespace App\Http\Controllers;

use App\Businesses\Contracts\EventBusinessInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected EventBusinessInterface $eventBusiness;

    public function __construct(EventBusinessInterface $eventBusiness)
    {
        $this->eventBusiness = $eventBusiness;
    }

    public function listAllEvents(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Success.',
                'listOfEvents' => $this->eventBusiness->listAllEvents(),
            ],
            200
        );
    }

    public function createEvent(Request $request): JsonResponse
    {
        $eventInformation = $request->only(
            'eventName',
            'location',
            'opening',
            'closing',
            'organizer',
            'status',
            'category',
            'capacity'
        );

        $eventBusinessResponse = $this->eventBusiness->createEvent($eventInformation);

        if (
            $eventBusinessResponse instanceof \Illuminate\Support\MessageBag &&
            $eventBusinessResponse->isNotEmpty()
        ) {
            return response()->json(
                [
                    'message' => 'Failed.',
                    'validationErrors' => $eventBusinessResponse,
                ],
                422
            );
        }

        return response()->json(
            [
                'message' => 'Success.',
                'listOfEvents' => $eventBusinessResponse,
            ],
            200
        );
    }

}
