<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Pengeluaran;
use PhpOffice\PhpWord\TemplateProcessor;



class PengeluaranReportController extends Controller
{

	public function index(Request $request){
		$data = Pengeluaran::select('id', 'nama_kategori', 'nama_pengeluaran', 'tujuan_transaksi', 'kuantitas', 'harga_peritem', 'tanggal')->get();

        // Create a new PhpWord object
        $phpWord = new PhpWord();

        // Add a section to the document
        $section = $phpWord->addSection();

        // Add a table to the section
        $table = $section->addTable();

        // Add table headers
        $table->addRow();
        $table->addCell(2000)->addText('ID');
        $table->addCell(2000)->addText('Nama Kategori');
        $table->addCell(2000)->addText('Nama Pengeluaran');

        // Add data to the table
        foreach ($data as $pengeluaran) {
            $table->addRow();
            $table->addCell(2000)->addText($pengeluaran->id);
            $table->addCell(2000)->addText($pengeluaran->nama_kategori);
            $table->addCell(2000)->addText($pengeluaran->nama_pengeluaran);
        }

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

		$objWriter->save('reportEdited2.docx');
		

	}
		
}
