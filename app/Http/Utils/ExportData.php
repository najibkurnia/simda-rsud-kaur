<?php

namespace App\Http\Utils;

use Barryvdh\DomPDF\Facade\Pdf;

class ExportData
{
    public static function PDF(array $attr)
    {
        $pdf = Pdf::loadView($attr['fileDir'], $attr);
        $fileName = $attr['heading'] . '.pdf';

        return $pdf->stream($fileName);
    }
}
