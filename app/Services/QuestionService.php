<?php


namespace App\Services;

use App\Http\Resources\QuestionResource;
use App\Models\Question;

class QuestionService
{
    public function getQuestions(?int $product_id)
    {
        return QuestionResource::collection(
            Question::searchByProductId($product_id)
                ->simplePaginate(config('app.paginate'))
        );
    }

    public function createQuestion(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        $question = Question::create($data);
    }

    public function updateQuestion(array $data, Question $question)
    {
        [
            'text' => $text
        ] = $data;

        $question->text = $text;
        $question->save();
    }


}
