<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Sepa;
use Illuminate\Support\Facades\Auth;

class SepaController extends Controller
{
    public function downloadExistingSepa()
    {
        // Retrieve the SEPA data for the authenticated user
        $sepa = Sepa::where('user_id', Auth::id())->first();

        if (!$sepa) {
            return redirect()->back()->with('error', 'No SEPA data available.');
        }

        $data = [
            'full_name' => $sepa->full_name,
            'email' => $sepa->email,
            'iban' => $sepa->iban,
            'bic' => $sepa->bic,
        ];

        $pdf = PDF::loadView('user.sepa-pdf', $data);

        return $pdf->download('sepa_form.pdf');
    }
}
