<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Presenter\Response;
use App\Usecases\StudentUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $usecase;
    protected $StudentUsecase;
     protected $page = [
        "route" => "student",
        "title" => "Student",
    ];
        protected $baseRedirect;
        public function __construct(
        StudentUsecase $usecase,
        //   StudentUsecase $StudentUsecase,
    ){
        $this->usecase = $usecase;
        // $this->StudentUsecase = $StudentUsecase;
    }
     public function index(Request $req): View | Response
    {
        $usecase = new StudentUsecase();

        $data = $this->usecase->getAll($req->input());

        $memberCategories = $this->StudentUsecase->getAll();
        $memberCategories = $memberCategories['data']['list'] ?? [];

        return render_view("_admin.member.list", [
            'data' => $data['data']['list'] ?? [],
            'memberCategories' => $memberCategories,
            'page' => $this->page,
            'filter' => $req->input(),
        ]);
    }
}
