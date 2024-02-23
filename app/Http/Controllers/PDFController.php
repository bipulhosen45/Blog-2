<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index()
    {
        return view('pdf.invoice');
        $pdf = Pdf::loadView('pdf.invoice');
        return $pdf->download('invoice.pdf');

    }
    public function customData()
    {
        return view('custom.custom');
    }
}
