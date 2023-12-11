<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Pemasukan;
use PhpOffice\PhpWord\TemplateProcessor;



class PemasukanReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request){
		$data = Pemasukan::select('id', 'nama_kategori', 'rekening', 'jumlah_pemasukan', 'catatan_pemasukan', 'tanggal')->get();

        // Create a new PhpWord object
        $phpWord = new PhpWord();

        // Add a section to the document
        $section = $phpWord->addSection();

        // Add a table to the section
        $table = $section->addTable();

        // Add table headers
        $table->addRow();
        $table->addCell(2000)->addText('ID');
        $table->addCell(2000)->addText('Nama Pemasukan');
        // $table->addCell(2000)->addText('Nama Pengeluaran');

        // Add data to the table
        foreach ($data as $pemasukan) {
            $table->addRow();
            $table->addCell(2000)->addText($pemasukan->id);
            $table->addCell(2000)->addText($pemasukan->nama_kategori);
            // $table->addCell(2000)->addText($pengeluaran->nama_pengeluaran);
        }

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

		$objWriter->save('reportEdited2.docx');
		

	}
		
}
