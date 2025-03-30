<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class AveMariaController extends Controller
{
    public function index(Request $request)
    {
        return view('aveMaria.index', [
            'patients' => Patient::paginate(4),
        ]);
    }

}

