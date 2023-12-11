<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Pinjaman;
use PhpOffice\PhpWord\TemplateProcessor;



class PinjamanReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request){
		$data = pinjaman::select('id', 'rekening', 'jumlah_pinjaman', 'nama_diberi_pinjaman', 'catatan pinjaman', 'tanggal_pinjaman', 'jam_pinjaman', 'tanggal_jatuh_tempo', 'jam_jatuh_tempo', 'status')->get();

        // Create a new PhpWord object
        $phpWord = new PhpWord();

        // Add a section to the document
        $section = $phpWord->addSection();

        // Add a table to the section
        $table = $section->addTable();

        // Add table headers
        $table->addRow();
        $table->addCell(2000)->addText('ID');
        $table->addCell(2000)->addText('Rekening');
        // $table->addCell(2000)->addText('Nama Pengeluaran');

        // Add data to the table
        foreach ($data as $pinjaman) {
            $table->addRow();
            $table->addCell(2000)->addText($pinjaman->id);
            $table->addCell(2000)->addText($pinjaman->rekening);
            // $table->addCell(2000)->addText($pengeluaran->nama_pengeluaran);
        }

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

		$objWriter->save('reportEdited2.docx');
		

	}
		
}
