<?php

namespace App\Http\Controllers\Admin;

use App\Entities\ResponseEntity;
use App\Http\Controllers\Controller;
use App\Usecases\StudentUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    protected $usecase;

    protected $page = [
        "route" => "student",
        "title" => "Data Siswa",
    ];

    public function __construct(StudentUsecase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function index(Request $req): View | Response
    {
        $filter = $req->input();

        $data = $this->usecase->getAll($filter);

        $classList = DB::table('class')->orderBy('class_name')->get();

        return render_view("_admin.students.list", [
            'data' => $data['data']['list'] ?? [],
            'filter' => $filter,
            'page' => $this->page,
            'classList' => $classList,
        ]);
    }

    public function add(): View | Response
    {
        $classList = DB::table('class')->orderBy('class_name')->get();
        return render_view('_admin.students.add', [
            'page' => $this->page,
            'classList' => $classList,
        ]);
    }
    public function doCreate(Request $request): JsonResponse
    {
        $process = $this->usecase->create(
            data: $request,
        );

        if (empty($process['error'])) {
            return response()->json([
                "success" => true,
                "message" => ResponseEntity::SUCCESS_MESSAGE_CREATED,
                "redirect" => $this->page['route']
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => ResponseEntity::DEFAULT_ERROR_MESSAGE,
                "redirect" => $this->page['route']
            ]);
        }
    }

    public function update(int $id): View|RedirectResponse | Response
    {
        $data = $this->usecase->getByID($id);
        $classList = DB::table('class')->orderBy('class_name')->get();
        if (empty($data['data'])) {
            return redirect()
                ->with('error', ResponseEntity::DEFAULT_ERROR_MESSAGE);
        }
        $data = $data['data'] ?? [];

        return render_view("_admin.students.update", [
            'data' => (object) $data,
            'page' => $this->page,
            'classList' => $classList

        ]);
    }

    public function doUpdate(int $id, Request $request): JsonResponse
    {
        $process = $this->usecase->update(
            data: $request,
            id: $id,
        );
        dd($process);

        if (empty($process['error'])) {
            return Response::buildSuccess(
                message: ResponseEntity::SUCCESS_MESSAGE_UPDATED
            ) + ['error' => null];;
        } else {
            return response()->json([
                "success" => false,
                "message" => ResponseEntity::DEFAULT_ERROR_MESSAGE,
                "redirect" => $this->page['route']
            ]);
        }
    }

    public function doDelete(int $id, Request $request): JsonResponse
    {
        $process = $this->usecase->delete(
            id: $id,
        );

        if (empty($process['error'])) {
            return response()->json([
                "success" => true,
                "message" => ResponseEntity::SUCCESS_MESSAGE_DELETED,
                "redirect" => "student"
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => ResponseEntity::DEFAULT_ERROR_MESSAGE,
                "redirect" => "student"
            ]);
        }
    }
}
