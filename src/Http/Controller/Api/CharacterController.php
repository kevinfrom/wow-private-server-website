<?php

declare(strict_types=1);

namespace App\Http\Controller\Api;

use App\Services\CharacterService;

final readonly class CharacterController
{
    public function __construct(protected CharacterService $characterService)
    {
    }

    public function index(): never
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'characters' => $this->characterService->getCharacters(),
        ]);

        exit;
    }
}
