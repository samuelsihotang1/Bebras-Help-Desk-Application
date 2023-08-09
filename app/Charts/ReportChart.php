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
    for ($i = 1; $i <= 4; $i++) {
      $startDate = date('Y-m-d', strtotime('-' . $i . ' weeks'));
      $endDate = date('Y-m-d', strtotime('-' . ($i - 1) . ' weeks'));

      $totalAnswer = ReportAnswer::where('created_at', '>=', $startDate)
        ->where('created_at', '<', $endDate)
        ->count();

      $totalQuestion = ReportQuestion::where('created_at', '>=', $startDate)
        ->where('created_at', '<', $endDate)
        ->count();

      $totalComment = ReportComment::where('created_at', '>=', $startDate)
        ->where('created_at', '<', $endDate)
        ->count();

      $dataAnswer[] = $totalAnswer;
      $dataQuestion[] = $totalQuestion;
      $dataComment[] = $totalComment;
    }

    return $this->chart->lineChart()
      ->addData('Report Answer', $dataAnswer)
      ->addData('Report Question', $dataQuestion)
      ->addData('Report Comment', $dataComment)
      ->setHeight(250)
      ->setFontFamily('Nunito')
      ->setXAxis(['1 Week ago', '2 Weeks ago', '3 Weeks ago', '4 Weeks ago'])
      ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
  }
}
