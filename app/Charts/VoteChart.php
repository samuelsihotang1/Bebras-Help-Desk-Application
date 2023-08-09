<?php

namespace App\Charts;

use App\Models\Answer;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use samuelsihotang1\LaravelVote\Vote;

class VoteChart
{
  protected $chart;

  public function __construct(LarapexChart $chart)
  {
    $this->chart = $chart;
  }

  public function build(): \ArielMejiaDev\LarapexCharts\LineChart
  {
    for ($i = 1; $i <= 4; $i++) {
      $startDate = date('Y-m-d', strtotime('-' . $i . ' weeks'));
      $endDate = date('Y-m-d', strtotime('-' . ($i - 1) . ' weeks'));

      $totalUpVote = Vote::where('created_at', '>=', $startDate)
        ->where('created_at', '<', $endDate)
        ->where('vote_type', 'up_vote')
        ->count();

      $totalDownVote = Vote::where('created_at', '>=', $startDate)
        ->where('created_at', '<', $endDate)
        ->where('vote_type', 'down_vote')
        ->count();

      $dataUpVote[] = $totalUpVote;
      $dataDownVote[] = $totalDownVote;
    }

    return $this->chart->lineChart()
      ->addData('Up Vote', $dataUpVote)
      ->addData('Down Vote', $dataDownVote)
      ->setHeight(250)
      ->setFontFamily('Nunito')
      ->setXAxis(['1 Week ago', '2 Weeks ago', '3 Weeks ago', '4 Weeks ago'])
      ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
  }
}
