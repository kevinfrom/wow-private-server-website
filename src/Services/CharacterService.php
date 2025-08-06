<?php

declare(strict_types=1);

namespace App\Services;

use App\Database\CharactersDatabase;
use Nette\Database\Row;

final readonly class CharacterService
{
    public function __construct(protected CharactersDatabase $db)
    {
    }

    public function getCharacters(): array
    {
        return array_map(function (Row $character): array {
            return [
                'name'   => $character->name,
                'race'   => $this->parseRace($character->race),
                'class'  => $this->parseClass($character->class),
                'level'  => $character->level,
                'online' => (bool)$character->online,
            ];
        }, $this->db->getCharacters());
    }

    protected function parseRace(int $race): string
    {
        return match ($race) {
            1 => 'Human',
            2 => 'Orc',
            3 => 'Dwarf',
            4 => 'Night Elf',
            5 => 'Undead',
            6 => 'Tauren',
            7 => 'Gnome',
            8 => 'Troll',
        };
    }

    protected function parseClass(int $class): string
    {
        return match ($class) {
            1 => 'Warrior',
            2 => 'Paladin',
            3 => 'Hunter',
            4 => 'Rogue',
            5 => 'Priest',
            7 => 'Shaman',
            8 => 'Mage',
            9 => 'Warlock',
            11 => 'Druid',
        };
    }
}
