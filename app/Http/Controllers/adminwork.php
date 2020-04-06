<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\candidates;
use App\result;

class adminwork extends Controller
{
    public function login(Request $req)
    {
        $input = $req->only(['username'=>'username','password'=>'password']);
        if (Auth::guard('web')->attempt($input)) {
            $user = Auth::user();
            $req->session()->put(['username'=>$user['username']]);
            return redirect()->to('/add_candidate');
        } else {
            return back()->withErrors(['UserName Or Password Is Wrong.']);
        }
    }

    public function addcan(Request $req)
    {
    	//It checkes of maximum number of candidates.
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
        //it checkes username must be unique.
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
        $this->validate($req,[
             'c1'=>'required|not_in:0',
             'c2'=>'required|not_in:0',
             'c3'=>'required|not_in:0',
             'c4'=>'required|not_in:0',
        ]);

        $user = User::where('username',$req->input('voterun'))->first();
        $user->prefer_1 = $req->input('c1');
        $user->oprefer_1 = $req->input('c1');
        $user->prefer_2 = $req->input('c2');
        $user->oprefer_2 = $req->input('c2');
        $user->prefer_3 = $req->input('c3');
        $user->oprefer_3 = $req->input('c3');
        $user->prefer_4 = $req->input('c4');
        $user->oprefer_4 = $req->input('c4');
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

    public function winner()
    {
        $candidate = candidates::all('name');//candidate list
        $round_num = 1; //count of round.
        $min = 0; // minimum of count per round.
        $out_of_race = [ ]; // array of candidate list who are out of race.
        $cname = [ ]; // array of candidate name

        //convert object to array to print on screen.
        foreach ($candidate as $i) {
            array_push($cname, $i->name);
        }

        echo("Start : ");

        //while loop starts and it ends when one candidate is left in race. 
        while(count($cname) > 1 && $round_num <= 4)
        {
            // Voters vote list.
            $voter = User::where('type',0)->get()->toArray();
            echo("\n\n\t\t\t\t\t\t\t\t\tRound ".$round_num."\n\n");
            echo("\t\t\t\t\t\t");

            // prints candidate name.
            echo("Candidates"."\t");
            foreach ($voter as $key) {
                echo($key['name']."\t");
            }

            //print round number
            echo("Count Of ".$round_num);
            echo("\n");

            //foreach loop for counting the candidates votes.
            foreach ($cname as $val => $key) {
                echo("\n\t\t\t\t\t\t");
                //cnt variable for count the votes.
                $cnt=0;
                echo($key."\t\t");
                foreach ($voter as $vkey) {
                    if($key == $vkey['prefer_1']){
                        echo("1 \t");
                    }
                    else if($key == $vkey['prefer_2']){
                        echo("2 \t");
                    }
                    else if($key == $vkey['prefer_3']){
                        echo("3 \t");
                    }
                    else if($key == $vkey['prefer_4']){
                        echo("4 \t");
                    } else {
                        echo("0 \t");
                    }
                }
                $cnt = count(User::where('prefer_1',$key)->get());
                
                // if count of votes is smaller then minimum values then he/she is out of race.
                // else change value of minimum value.
                if($cnt < $min ) {
                    array_push($out_of_race, $key);
                } else {
                    $min = $cnt; 
                }
                echo("    ".$cnt);
                echo("  Min :  ".$min);
                //rearrange the array of candidate name.
                $cname = array_values($cname);
            }
            
            //foreach loop for that candidates who are out of race. 
            //remove that candidate data from db. 
            foreach ($out_of_race as $key) {
                $data = User::where('prefer_1',$key)->orwhere('prefer_2',$key)->orwhere('prefer_3',$key)->orwhere('prefer_4',$key)->get();
                foreach ($data as $skey) {
                    if($key == $skey['prefer_1']){
                        $skey->prefer_1 = $skey->prefer_2;
                        $skey->prefer_2 = $skey->prefer_3;
                        $skey->prefer_3 = $skey->prefer_4;
                    }
                    if($key == $skey['prefer_2']){
                        $skey->prefer_2 = $skey->prefer_3;
                        $skey->prefer_3 = $skey->prefer_4;
                    }
                    if($key == $skey['prefer_3']){
                        $skey->prefer_3 = $skey->prefer_4;
                    }
                    $skey->save();
                }
            }
            $round_num++;

            //at the end remove that candidate from candidate array.
            $cname = array_diff($cname,$out_of_race);
            echo("\nOut Of Race : \n");
            print_r($out_of_race);
        }
        $cname = array_values($cname);
        
        //at the end cname send to view who is winner.
        return view('Admin.winner',compact('cname'));
    }
    
    public function logout(Request $req)
    {
        $req->session()->flush();
        return redirect()->to('/');
    }
}
