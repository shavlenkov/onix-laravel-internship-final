<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Question::class, 'question');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return QuestionResource::collection(Question::searchByProductId($request->query('product_id'))->simplePaginate(config('app.paginate')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreQuestionRequest $request
     * @return mixed
     */
    public function store(StoreQuestionRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $question = Question::create($data);

        return response()
            ->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateQuestionRequest $request
     * @param Question $question
     * @return mixed
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $data = $request->validated();

        $question->text = $data['text'];
        $question->save();

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return mixed
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response()
            ->json(['success' => true]);
    }
}
