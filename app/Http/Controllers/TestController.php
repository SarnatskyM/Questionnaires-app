<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Answer;
use App\Models\Option;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('tests.index', compact('tests'));
    }

    public function show($slug)
    {
        $test = Test::where('slug', $slug)->firstOrFail();
        if ($test->is_active == 0) {
            abort(404);
        }
        return view('tests.show', compact('test'));
    }

    public function submit(Request $request, Test $test)
    {
        foreach ($request->input('answers') as $question_id => $answer) {
            if (is_array($answer)) {
                foreach ($answer as $key => $option_id) {
                    $answerModel = new Answer();
                    $answerModel->test_id = $test->id;
                    $answerModel->question_id = $question_id;
                    if (ctype_digit($option_id)) {
                        if (str_contains($key, "!")) {
                            $key = str_replace("!", "", $key);
                            $answerModel->option_id = $key;
                            $answerModel->free_answer = $option_id;
                        } else {
                            $answerModel->option_id = $option_id;
                        }
                    } else {
                        $answerModel->free_answer = $option_id;
                    }
                    $answerModel->save();
                }
            } else {
                $answerModel = new Answer();
                $answerModel->test_id = $test->id;
                $answerModel->question_id = $question_id;
                if (ctype_digit($answer)) {
                    $answerModel->option_id = $answer;
                } else {
                    $answerModel->free_answer = $answer;
                }

                $answerModel->save();
            }
        }
        return redirect('/success');
    }

    public function success()
    {
        return view('tests.success');
    }
}
