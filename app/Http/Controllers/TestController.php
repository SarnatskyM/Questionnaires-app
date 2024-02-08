<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Answer;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('tests.index', compact('tests'));
    }

    public function show(Test $test)
    {
        return view('tests.show', compact('test'));
    }

    public function submit(Request $request, Test $test)
    {
        foreach ($request->input('answers') as $question_id => $answer_text) {
            $answer = new Answer();
            $answer->respondent_id = auth()->id(); 
            $answer->question_id = $question_id;
            $answer->answer_text = $answer_text;
            $answer->save();
        }


        return redirect('/success');
    }

    public function success()
    {
        return view('tests.success');
    }
}
