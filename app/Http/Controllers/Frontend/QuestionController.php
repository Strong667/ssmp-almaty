<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Показать страницу с вопросами и ответами и формой отправки вопроса
     */
    public function index()
    {
        $questions = Question::query()
            ->where('published', true)
            ->whereNotNull('answer')
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.questions.index', compact('questions'));
    }

    /**
     * Сохранить новый вопрос от пользователя
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'question' => ['required', 'string', 'min:10'],
        ], [
            'name.required' => 'Пожалуйста, укажите ваше имя',
            'email.required' => 'Пожалуйста, укажите ваш email',
            'email.email' => 'Пожалуйста, укажите корректный email',
            'question.required' => 'Пожалуйста, введите ваш вопрос',
            'question.min' => 'Вопрос должен содержать минимум 10 символов',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('questions.index')
                ->withErrors($validator)
                ->withInput();
        }

        Question::create([
            'name' => $request->name,
            'email' => $request->email,
            'question' => $request->question,
            'published' => false,
            'notify_email' => $request->has('notify_email'),
        ]);

        return redirect()
            ->route('questions.index')
            ->with('success', 'Ваш вопрос успешно отправлен! Мы ответим вам в ближайшее время.');
    }
}
