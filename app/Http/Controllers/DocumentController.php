<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TeamDocuments;

use Auth;

use Illuminate\Support\Facades\DB;

use App\Transformers\TeamDocumentTransformer;

class DocumentController extends Controller
{
    public function paymentProof(Request $request, TeamDocuments $teamDocuments)
    {
        $this->validate($request, [
        	'payment_proof' => 'required|image|max:1024', 
        ]);

        $payment_proof_file_name = bcrypt($request->payment_proof) . '.' . $request->payment_proof->getClientOriginalExtension();
        $payment_proof_file_name = str_replace('/', '', $payment_proof_file_name);

        $request->payment_proof->storeAs('public/payment-proofs', $payment_proof_file_name);

        $teamDocuments->payment_proof = $payment_proof_file_name;
        $teamDocuments->save();

        $response = fractal()
        	->item($teamDocuments)
        	->transformWith(new TeamDocumentTransformer)
        	->toArray();

        return response()->json($response, 201);
    }

    public function proposal(Request $request, TeamDocuments $teamDocuments)
    {
        $this->validate($request, [
        	'proposal' => 'required|file|mimes:pdf', 
        ]);

        $proposal_file_name = bcrypt($request->proposal) . '.' . $request->proposal->getClientOriginalExtension();
        $proposal_file_name = str_replace('/', '', $proposal_file_name);

        $request->proposal->storeAs('public/proposals', $proposal_file_name);

        $teamDocuments->proposal = $proposal_file_name;
        $teamDocuments->save();

        $response = fractal()
        	->item($teamDocuments)
        	->transformWith(new TeamDocumentTransformer)
        	->toArray();

        return response()->json($response, 201);
    }

    public function documents(TeamDocuments $teamDocuments)
    {
    	$teamDocumentsCollection = $teamDocuments->all();

    	return fractal()
    		->collection($teamDocumentsCollection)
    		->transformWith(new TeamDocumentTransformer)
    		->toArray();
    }
}
