<?php
namespace App\Http\Controllers\AdminRegion;

use App\Http\Controllers\Controller;
use App\Models\Colis;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show($id)
    {
        $colis = Colis::findOrFail($id);
        return view('adminRegion.colis.ticket', compact('colis'));
    }
}
