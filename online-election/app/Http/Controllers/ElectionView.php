<?php

namespace App\Http\Controllers;
use App\Models\Election;


use Illuminate\Http\Request;

class ElectionView extends Controller
{
    public function index(){
       // $elections=Election::whereIn('election_name',['bod','policy'])->get();
       $elections = Election::all();
        return view('/ui/production/adminelection',compact('elections'));
    }
}