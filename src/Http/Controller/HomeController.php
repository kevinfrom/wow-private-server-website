<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Services\CharacterService;
use App\Services\FeatureService;
use App\View\Templater;

final readonly class HomeController
{
    public function __construct(
        protected Templater $templater,
        protected FeatureService $featureService,
        protected CharacterService $characterService
    ) {
    }

    public function index(): never
    {
        echo $this->templater->template('index', [
            'characters'            => $this->characterService->getCharacters(),
            'characterListEnabled'  => $this->featureService->characterListEnabled(),
            'signupEnabled'         => $this->featureService->signupEnabled(),
            'changePasswordEnabled' => $this->featureService->changePasswordEnabled(),
        ]);

        exit;
    }
}
