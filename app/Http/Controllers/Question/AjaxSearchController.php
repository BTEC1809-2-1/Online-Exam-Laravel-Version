<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AjaxSearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('users')
                    ->where('id','like', "%{$query}%")
                    ->orWhere('question', 'LIKE', "%{$query}%")
                    ->get();
            $output = '<ul style="display:block; position:relative">';
            $i = 0;
            foreach ($data as $row) {
                $question = substr($row->question, 0, 150);
                $output .= '
                <li class="student-id">

                <input style="color: black;" type="hidden" class="extra-id" value="' . $row->id . '"></input>
                <input style="color: black;" type="hidden" class="extra-name" value="' . $question . '"></input>'
                . 'ID: ' . $question . ' | ID: ' . $question . '</li>';
                $i++;
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
