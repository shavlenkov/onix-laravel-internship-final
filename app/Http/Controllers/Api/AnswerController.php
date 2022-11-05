<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Http\Requests\StoreUpdateAnswerRequest;
use App\Services\AnswerService;

class AnswerController extends Controller
{

    protected $answerService;

    /**
     * AnswerController constructor.
     */
    public function __construct()
    {
        $this->answerService = new AnswerService();
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

        $this->answerService->createAnswer($data, $id);

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

        $this->answerService->updateAnswer($data, $answer);

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
