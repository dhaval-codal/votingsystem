<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\candidates;

class adminwork extends Controller
{
    public function login(Request $req)
    {
        //dd($req->input());
        $input = $req->only(['username'=>'username','password'=>'password']);
        //dd($input);
        if (Auth::guard('web')->attempt($input)) {
            $user = Auth::user();
            $req->session()->put(['username'=>$user['username']]);
            return redirect()->to('/add_candidate');
        } else {
            //dd('not Verified');
            return back();
        }
    }

    public function addcan(Request $req)
    {
    	//dd($req->input());
    	if (count(candidates::all()) == 10) {
    		return back()->withErrors(['10 Candidate is Already Completed']);
    	} else {
    		$user = candidates::withTrashed()->where('name',$req->input('name'))->first();
    		if($user) {
    			$user->forceDelete();
    		}	
    		$candidate = new candidates;
	    	$candidate->name = $req->input('name');
	    	$candidate->save();
	    	return redirect()->to('/add_candidate');
    	}
    }

    public function addvoter(Request $req)
    {
        //dd($req->input());
        $user = User::withTrashed()->where('name',$req->input('username'))->first();
        if($user) {
            if ($user->type == 1) {
                return back()->withErrors(['UserName Must Be Unique.']);    
            }
            $user->forceDelete();
        }   
        $voter = new User;
        $voter->name = $req->input('username');
        $uniqid = uniqid();
        $voter->username = $uniqid;
        $voter->voting_link = 'http://local.pvs.com/sendvote/'.$uniqid;
        $voter->password = Hash::make($uniqid);
        $voter->type = 0;
        $voter->save();
        return redirect()->to('/add_voter');
    }

    public function voteview($vlink)
    {
        $user = User::where('username',$vlink)->first();
        if ($user->prefer_1 != null) {
            return view('aftervote',compact('user'));
        } else {
            $candidates = candidates::all();
            $user = User::where('username',$vlink)->first();
            return view('voteview',compact('candidates','user'));
        }
    }

    public function savevote(Request $req)
    {
        //dd($req->input());
        $this->validate($req,[
             'c1'=>'required|not_in:0',
             'c2'=>'required|not_in:0',
             'c3'=>'required|not_in:0',
             'c4'=>'required|not_in:0'
        ]);

        $user = User::where('username',$req->input('voterun'))->first();
        $user->prefer_1 = $req->input('c1');
        $user->prefer_2 = $req->input('c2');
        $user->prefer_3 = $req->input('c3');
        $user->prefer_4 = $req->input('c4');
        $user->save();

        $candidate = candidates::where('name',$req->input('c1'))->first();
        $candidate->prefer_1 = $candidate->prefer_1 + 1;
        $candidate->save();

        $candidate = candidates::where('name',$req->input('c2'))->first();
        $candidate->prefer_2 = $candidate->prefer_2 + 1;
        $candidate->save();

        $candidate = candidates::where('name',$req->input('c3'))->first();
        $candidate->prefer_3 = $candidate->prefer_3 + 1;
        $candidate->save();

        $candidate = candidates::where('name',$req->input('c4'))->first();
        $candidate->prefer_4 = $candidate->prefer_4 + 1;
        $candidate->save();

        $user = User::where('username',$req->input('voterun'))->first();
        return view('aftervote',compact('user'));
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        return redirect()->to('/');
    }
}
