<?php

declare(strict_types=1);

namespace App\Http\Controller\Api;

use App\Services\CharacterService;
use App\Services\FeatureService;

final readonly class CharacterController
{
    public function __construct(
        protected CharacterService $characterService,
        protected FeatureService $featureService
    ) {
    }

    public function index(): never
    {
        if (!$this->featureService->characterListEnabled()) {
            http_response_code(404);
            exit;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'characters' => $this->characterService->getCharacters(),
        ]);

        exit;
    }
}
