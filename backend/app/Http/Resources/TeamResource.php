<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $averagePaceInSeconds = array_sum($this->runners()->get()->map(function ($runner) {
            if(!isset($runner->pace)) {
                return 6 * 60;
            }
            @list($minutes, $seconds) = explode(':', $runner->pace);
            return (int) $minutes * 60 + (int) $seconds;
        })->toArray());

        $count = ($this->runners()->count() == 0 ) ? 1 : $this->runners()->count();
        $averagePaceInSeconds = $averagePaceInSeconds / $count ;

        $averagePaceMinutes = round(floor($averagePaceInSeconds / 60));
        $averagePace = $averagePaceMinutes . ':' . round($averagePaceInSeconds - $averagePaceMinutes*60);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contactEmail' => $this->contactEmail,
            'plannedStartingTime' => $this->plannedStartingTime,
            'startingTime' => isset($this->startingTime) ? (new \Carbon\Carbon($this->startingTime))->format('Y-m-d H:i') : null,
            'accessCode' => $this->accessCode,
            'averagePace' => $averagePace == '0:0' ? '6:00' : $averagePace,
            'runners' => $this->runners,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
