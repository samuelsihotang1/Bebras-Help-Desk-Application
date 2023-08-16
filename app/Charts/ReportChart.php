<?php

namespace App\Charts;

use App\Models\ReportAnswer;
use App\Models\ReportComment;
use App\Models\ReportQuestion;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ReportChart
{
  protected $chart;

  public function __construct(LarapexChart $chart)
  {
    $this->chart = $chart;
  }

  public function build(): \ArielMejiaDev\LarapexCharts\LineChart
  {
    $dayLabels = [];

    for ($i = 6; $i >= 0; $i--) {
      $dayDate = date('Y-m-d', strtotime('-' . $i . ' days'));

      $dayName = date('l', strtotime($dayDate));
      $dayLabels[] = $dayName;
      if ($i == 0) {
        $totalAnswer = ReportAnswer::count();
        $totalQuestion = ReportQuestion::count();
        $totalComment = ReportComment::count();
      } else {
        $currentDate = date('Y-m-d', strtotime('-' . ($i - 1) . ' days'));
        $totalAnswer = ReportAnswer::where('created_at', '<', $currentDate)->count();
        $totalQuestion = ReportQuestion::where('created_at', '<', $currentDate)->count();
        $totalComment = ReportComment::where('created_at', '<', $currentDate)->count();
      }

      $dataAnswer[] = $totalAnswer;
      $dataQuestion[] = $totalQuestion;
      $dataComment[] = $totalComment;
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
      ->addData('Report Answer', $dataAnswer)
      ->addData('Report Question', $dataQuestion)
      ->addData('Report Comment', $dataComment)
      ->setHeight(250)
      ->setFontFamily('Nunito')
      ->setXAxis($dayLabels)
      ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
  }
}
