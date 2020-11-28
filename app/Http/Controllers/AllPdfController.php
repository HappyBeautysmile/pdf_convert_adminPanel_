<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllPdfController extends Controller
{
    public function index()
    {
        $data["page_flg"]="allPdf";
        return view('all_pdf',$data);
    }
}
