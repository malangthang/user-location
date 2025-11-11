<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function index(Request $request)
    {
        // If using server-side DataTables AJAX, the view will request apiList via JS.
        return view('forms.index');
    }
}
