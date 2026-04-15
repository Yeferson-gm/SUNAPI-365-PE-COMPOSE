<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

use SunApi365\Sdk\Resources\Tickets\HandlesTicketCrud;
use SunApi365\Sdk\Resources\Tickets\HandlesTicketDelivery;

final class TicketsResource extends AbstractResource
{
    use HandlesTicketCrud;
    use HandlesTicketDelivery;

    /**
     * @return array{created: array, whatsapp: array|null}
     */
    public function createAndSendWhatsapp(array $payload, array $whatsapp = []): array
    {
        $created = $this->create($payload);
        $id = $this->readCreatedId($created);

        return [
            'created' => $created,
            'whatsapp' => $id !== null ? $this->sendByWhatsapp($id, $whatsapp) : null,
        ];
    }

    /**
     * @return array{created: array, formalized: array|null, whatsapp: array|null}
     */
    public function createFormalizeAndSendWhatsapp(
        array $payload,
        array $formalize = [],
        array $whatsapp = []
    ): array {
        $created = $this->create($payload);
        $id = $this->readCreatedId($created);

        return [
            'created' => $created,
            'formalized' => $id !== null ? $this->formalize($id, $formalize) : null,
            'whatsapp' => $id !== null ? $this->sendByWhatsapp($id, $whatsapp) : null,
        ];
    }
}
