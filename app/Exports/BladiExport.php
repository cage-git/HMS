<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BladiExport implements FromView
{	
	private $data = [];
	public function __construct($dataArr)
    {
    	$this->data = $dataArr;
        $this->days = $dataArr;
        $this->report_month = $dataArr;
        $this->report_year = $dataArr;
    }
    public function view(): View
    {
        
        return view($this->data['view'], [ 
            'datalist' => $this->data['data'],
            'days' => $this->data['days'],
            'report_month' => $this->data['report_month'],
            'report_year' => $this->data['report_year']
        ]);
    }
}