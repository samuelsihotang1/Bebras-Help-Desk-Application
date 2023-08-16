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
    $dayLabels = [];
    $data = [];

    for ($i = 6; $i >= 0; $i--) {
      $dayDate = date('Y-m-d', strtotime('-' . $i . ' days'));

      $dayName = date('l', strtotime($dayDate));
      $dayLabels[] = $dayName;
      if ($i == 0) {
        $total = Comment::count();
      } else {
        $currentDate = date('Y-m-d', strtotime('-' . ($i - 1) . ' days'));
        $total = Comment::where('created_at', '<', $currentDate)->count();
      }
      $data[] = $total;
    }

    $dayLabels = array_map(function ($day) {
      $daysInIndonesian = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
      ];

      return $daysInIndonesian[$day];
    }, $dayLabels);

    return $this->chart->lineChart()
      ->addData('Total Comments', $data)
      ->setHeight(250)
      ->setFontFamily('Nunito')
      ->setXAxis($dayLabels)
      ->setColors(['#FFC107', '#303F9F'])
      ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
  }
}
