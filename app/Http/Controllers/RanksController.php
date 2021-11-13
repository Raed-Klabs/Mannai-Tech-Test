<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RanksController extends Controller
{
    //
    public function getScores() {
    $scores = collect ([
    ['score' => 76, 'team' => 'A'],
    ['score' => 62, 'team' => 'B'],
    ['score' => 82, 'team' => 'C'],
    ['score' => 86, 'team' => 'D'],
    ['score' => 91, 'team' => 'E'],
    ['score' => 67, 'team' => 'F'],
    ['score' => 67, 'team' => 'G'],
    ['score' => 82, 'team' => 'H'],
]);


$orderedScores = collect($scores)
                ->sortByDesc('score')
                ->zip(range(1, $scores->count()))
                ->map(function ($scoreAndRank) {
                    list($score, $rank) = $scoreAndRank;
                    return array_merge($score, [
                    'rank' => $rank
                    ]);
                    })
                ->groupBy('score')
                ->map(function ($equalScores) {
                    $lowestRank = $equalScores->pluck('rank')->min();
                    return $equalScores->map(function ($rankedScore) use ($lowestRank) {
                    return array_merge($rankedScore, [
                    'rank' => $lowestRank
                    ]);
                    });
                })
                ->collapse()
                ->sortBy('rank');

    return $orderedScores;
    }
}
