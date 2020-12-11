<?php

namespace App\Http\Controllers;

use App\Jobs\PersonCreditCardJsonToDatabase;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    /**
     *
     * File upload which contains records of people.
     * Accepted types are: JSON, CSV, XML
     *
     * @param Request $request
     * @return Response
     * @throws FileNotFoundException
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('data_file_upload')) {

            $file = $request->file('data_file_upload');

            //TODO add support for CSV and XML
            switch ($file->getClientOriginalExtension()) {
                case 'json':
                    PersonCreditCardJsonToDatabase::dispatch($file);
                    return response("File accepted", 200);
                default:
                    return response("File extension is not supported.", 400);
            }
        }
        return response("Bad request", 400);
    }
}
