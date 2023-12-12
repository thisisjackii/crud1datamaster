<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\TransferSaldo;
use PhpOffice\PhpWord\TemplateProcessor;



class TransferReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request){
		$data = TransferSaldo::select('id', 'sumber_rekening', 'tujuan_transfer', 'jumlah_transfer', 'tanggal', 'jam', 'biaya_admin')->get();

        // Create a new PhpWord object
        $phpWord = new PhpWord();

        // Add a section to the document
        $section = $phpWord->addSection();

        // Add a table to the section
        $table = $section->addTable();

        // Add table headers
        $table->addRow();
        $table->addCell(2000)->addText('ID');
        $table->addCell(2000)->addText('Sumber Rekening');

        // Add data to the table
        foreach ($data as $transfer) {
            $table->addRow();
            $table->addCell(2000)->addText($transfer->id);
            $table->addCell(2000)->addText($transfer->sumber_rekening);
        }

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

		$objWriter->save('reportEdited2.docx');
		

	}
		
}
