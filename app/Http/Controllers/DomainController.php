<?php 

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DomainController extends BaseController
{

    public function getDomainsSQL()
    {
        $domains = DB::table('users')
                ->select(DB::raw("SUBSTR(email, INSTR(email, '@') + 1) as domain"),
                        DB::raw('count(id) as total'))
                ->groupBy('domain')
                ->get();
        return response()->json($domains, 200);
    }

    public function getDomainsPHP()
    {
        $users = User::all();
        $result = array();
        foreach($users as $user){
            $domain_name = substr(strrchr($user->email, "@"), 1);
            if(array_key_exists($domain_name, $result)){
                $result[$domain_name] += 1;
            } else {
                $result[$domain_name] = 1;
            }
        }
        
        return response()->json($result, 200);
    }
}