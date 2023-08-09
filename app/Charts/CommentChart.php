<?php

namespace App\Charts;

use App\Models\Comment;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CommentChart
{
  protected $chart;

  public function __construct(LarapexChart $chart)
  {
    $this->chart = $chart;
  }

  public function build(): \ArielMejiaDev\LarapexCharts\LineChart
  {
    $data = [];
    for ($i = 1; $i <= 4; $i++) {
      $startDate = date('Y-m-d', strtotime('-' . $i . ' weeks'));
      $endDate = date('Y-m-d', strtotime('-' . ($i - 1) . ' weeks'));

      $total = Comment::where('created_at', '>=', $startDate)
        ->where('created_at', '<', $endDate)
        ->count();

      $data[] = $total;
    }

    return $this->chart->lineChart()
      ->addData('Total Comments', $data)
      ->setHeight(250)
      ->setFontFamily('Nunito')
      ->setXAxis(['1 Week ago', '2 Weeks ago', '3 Weeks ago', '4 Weeks ago'])
      ->setColors(['#FFC107', '#303F9F'])
      ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
  }
}
