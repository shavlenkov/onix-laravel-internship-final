<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Http\Requests\StoreUpdateAnswerRequest;

class AnswerController extends Controller
{
    /**
     * AnswerController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Answer::class, 'answer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateAnswerRequest $request
     * @param $id
     * @return mixed
     */
    public function store(StoreUpdateAnswerRequest $request, $id)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['question_id'] = $id;

        $answer = Answer::create($data);

        return response()
            ->json(['success' => true]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateAnswerRequest $request
     * @param Answer $answer
     * @return mixed
     */
    public function update(StoreUpdateAnswerRequest $request, Answer $answer)
    {
        $data = $request->validated();

        $answer->text = $data['text'];
        $answer->save();

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return mixed
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return response()
            ->json(['success' => true]);
    }
}
