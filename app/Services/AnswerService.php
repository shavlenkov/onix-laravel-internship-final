<?php


namespace App\Services;

use App\Models\Answer;

class AnswerService
{
    public function createAnswer(array $data, int $id)
    {
        $data['user_id'] = auth()->user()->id;
        $data['question_id'] = $id;

        $answer = Answer::create($data);
    }

    public function updateAnswer(array $data, Answer $answer)
    {
        [
            'text' => $text,
        ] = $data;

        $answer->text = $text;

        $answer->save();
    }
}
