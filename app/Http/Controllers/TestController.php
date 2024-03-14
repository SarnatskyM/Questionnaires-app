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
                foreach ($answer as $option_id) {
                    $answerModel = new Answer();
                    $answerModel->test_id = $test->id;
                    $answerModel->question_id = $question_id;
                    // if (!is_numeric($option_id)) {

                    //     $id = Option::updateOrCreate([
                    //         'question_id' => $answerModel->question_id,
                    //         'option_text' => $option_id
                    //     ]);
                    //     $answerModel->option_id = $id->id;
                    // } else {
                    $answerModel->option_id = $option_id;
                    // }
                    $answerModel->save();
                }
            } else {
                $answerModel = new Answer();
                $answerModel->test_id = $test->id;
                $answerModel->question_id = $question_id;
                $answerModel->option_id = $answer;
                // if (!is_numeric($answerModel->option_id)) {
                //     $id = Option::updateOrCreate([
                //         'question_id' => $answerModel->question_id,
                //         'option_text' => $answer
                //     ]);
                //     $answerModel->option_id = $id->id;
                // } else {
                // }
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
