<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use App\Services\AmoService;
use Exception;
use Illuminate\Http\Request;

class AmoController extends Controller
{
    public function __construct(AmoService $amoService)
    {
        $this->amoService = $amoService;
    }

    public function getForm()
    {
        return view('amo.form');
    }

    public function sendForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|String',
            'email' => 'required|Email',
            'phone' => 'required|digits:10',
            'price' => 'required|numeric',
        ]);

        $response = $this->amoService->createLead($validatedData);

        return view('amo.success', ['message' => $response]);
    }
}
