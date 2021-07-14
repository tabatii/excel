<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenceRequest;
use Illuminate\Support\Facades\Http;
use App\Exports\LicencesExport;
use App\Models\Licence;


class MainController extends Controller
{

    private $url = 'https://uaqftz.com/uaq_admin/Api/check_licence';

    public function form()
    {
        return view('home');
    }

    public function export()
    {
        return (new LicencesExport)->download('licences.xlsx');
    }

    public function import(LicenceRequest $request)
    {
        for ($i = $request->from; $i <= $request->to; $i++):
            $response = Http::asForm()->post($this->url, [
                'licence_no' => $i
            ])->json();
            $notFound = count($response['licence_info']) === 0;
            $response['licence_info']['licence_number'] = $notFound ? $i : $response['licence_info']['licence_number'];
            $this->create($response);
        endfor;
        return back();
    }

    public function create($response)
    {
        $collection = collect($response);
        $collection = $collection->merge($response['licence_info']);
        $collection = $collection->forget('licence_info');

        $record = Licence::where('licence_number', $collection->get('licence_number'))->first();
        $licence = $record === null ? new Licence : $record;

        $licence->licence_number = $collection->get('licence_number');
        $licence->licence_id = $collection->get('id');
        $licence->licence_name = $collection->get('licence_name');
        $licence->start_date = $collection->get('start_date');
        $licence->end_date = $collection->get('end_date');
        $licence->created_at = $collection->get('created_at');
        $licence->updated_at = $collection->get('updated_at');
        $licence->is_expired = $collection->get('is_expired');
        $licence->message = $collection->get('message');

        return $licence->save();
    }
}
