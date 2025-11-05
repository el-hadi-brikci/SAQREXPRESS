<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Colis;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show($id)
    {
        $colis = Colis::findOrFail($id);
        return view('employe.colis.ticket', compact('colis'));
    }
}
