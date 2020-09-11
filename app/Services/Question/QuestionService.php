<?php

namespace App\Services\Question;

use App\Repositories\QuestionRepository;
use GuzzleHttp\Psr7\Request;

class QuestionService {

  protected $questionRepository;

  public function __construct(QuestionRepository $questionRepository){

    $this->questionRepository = $questionRepository;

  }

  public function getQuestionList(){

    return $this->questionRepository->getAllQuestion();

  }

  public function getRecentlyAddedQuestion(){

    return $this->questionRepository->getRecentlyAddedQuestion();

  }

  public function getQuestionDetail($id){

    $questionDetail = $this->questionRepository->getQuestionDetail($id);
    return $questionDetail;

  }
  public function storeAnswer(){



 }
}

