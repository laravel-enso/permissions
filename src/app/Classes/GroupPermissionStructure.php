<?php

namespace LaravelEnso\PermissionManager\app\Classes;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\Classes\Object;

class GroupPermissionStructure
{
    private $structure;

    public function __construct(Collection $groups)
    {
        $this->structure = $this->build($groups);
    }

    public function get()
    {
        return $this->structure;
    }

    private function build($groups)
    {
        $currentLevel = new Object();

        $this->getStartingLabels($groups)->each(function ($label) use ($currentLevel, $groups) {
            $childGroups = $this->getChildGroups($label, $groups);

            if ($childGroups->count() === 1) {
                return $currentLevel->$label = $childGroups->first()->permissions;
            }

            $currentLevel->$label = $this->build($this->getTrimmedNameGroups($childGroups));
        });

        return $currentLevel;
    }

    private function getStartingLabels($groups)
    {
        $labels = collect();

        $groups->each(function ($group) use ($labels) {
            $groupLabels = collect(explode('.', $group->name));
            $labels->push($groupLabels->first());
        });

        return $labels->unique()->values();
    }

    private function getChildGroups($label, $groups)
    {
        return $groups->filter(function ($group) use ($label) {
            return $label === current(explode('.', $group->name));
        })->values();
    }

    private function getTrimmedNameGroups($groups)
    {
        return $groups->map(function ($group) {
            return $this->trimGroupName($group);
        });
    }

    private function trimGroupName($group)
    {
        $labels = collect(explode('.', $group->name));
        $labels->shift();
        $group->name = $labels->implode('.');

        return $group;
    }
}
