<?php

namespace App\Http\Controllers\Qurban;

use App\Http\Controllers\Controller;
use App\Models\Qurban\QurbanPenerimaan;
use Illuminate\Http\Request;

class QurbanController extends Controller
{

    public function print($id){
        $data = QurbanPenerimaan::with('nama_amil')->findOrFail($id);

        return view('print.print-qurban-detail', compact('data'));
    }

}
