<?php

namespace App\Businesses\Contracts;

interface EventBusinessInterface
{
    public function listAllEvents(): object;
    public function createEvent(array $eventInformation): object;
}