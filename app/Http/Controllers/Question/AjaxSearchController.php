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
            $data = DB::table('questions')
                    ->where('deleted_at', null)
                    ->where('id','like', "%{$query}%")
                    ->orWhere('question', 'LIKE', "%{$query}%")
                    ->get();
            $output = '<ul style="display:block; position:relative">';
            $i = 0;
            foreach ($data as $row) {
                $question = substr($row->question, 0, 200);
                $output .=
                '<a href="' . route("get.question.detail", ["id" => $row->id]) . '">
                    <li class="student-id">'
                    . 'ID: ' . $row->id . '<br>
                    Content: ' . $question . '...
                    </li>
                    <hr>
                </a>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
