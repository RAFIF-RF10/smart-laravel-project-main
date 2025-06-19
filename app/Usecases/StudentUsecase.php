<?php

namespace App\Usecases;

use App\Entities\BookEntity;
use App\Entities\DatabaseEntity;
use App\Entities\ResponseEntity;
use App\Http\Presenter\Response;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentUsecase extends Usecase
{
    public string $className;

    public function __construct()
    {
        $this->className = "StudentUsecase";
    }

    public function getAll(array $filterData = []): array
    {
        $funcName = $this->className . ".getAll";

        $page       = $filterData['page'] ?? 1;
        $limit      = $filterData['limit'] ?? 10;
        $page       = ($page > 0 ? $page : 1);
        $filterName = $filterData['filter_name'] ?? "";

        try {
            $data = DB::connection(DatabaseEntity::SQL_READ)
                ->table(DatabaseEntity::STUDENTS . ' as s')
                ->leftJoin('class as k', 's.class_id', '=', 'k.id');

            if (!empty($filterName)) {
                $data = $data->where('s.name', 'like', '%' . $filterName . '%');
            }

            $fields = ['s.id', 's.name', 's.gender', 'k.class_name'];

            $data = $data->whereNull('s.deleted_at')
                ->orderBy('k.class_name', 'desc')
                ->paginate($limit, $fields)
                ->appends(request()->query());

            return Response::buildSuccess(
                [
                    'list' => $data,
                    'pagination' => [
                        'current_page' => (int) $page,
                        'limit'        => (int) $limit,
                        'payload'      => $filterData
                    ]
                ],
                ResponseEntity::HTTP_SUCCESS
            );
        } catch (\Exception $e) {
            //  dd($e->getMessage());
            Log::error($e->getMessage(), [
                "func_name" => $funcName,
                'user' => Auth::user()
            ]);

            return Response::buildErrorService($e->getMessage());
        }
    }


    public function create(Request $data): array
    {
        $funcName = $this->className . ".create";

        $validator = Validator::make($data->all(), [
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'class_id' => 'required|exists:' . DatabaseEntity::STUDENTS . ',id',
        ]);

        $validator->validate();

        DB::beginTransaction();
        try {
            DB::table(DatabaseEntity::STUDENTS)
                ->insert([
                    'name'        => $data['name'],
                    'gender'        => $data['gender'],
                    'class_id'        => $data['class_id'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

            DB::commit();

            return Response::buildSuccessCreated();
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage(), [
                "func_name" => $funcName,
                'user' => Auth::user()
            ]);
            return Response::buildErrorService($e->getMessage());
        }
    }
public function getByID(int $id): array
    {
        $funcName = $this->className . ".getByID";

        try {
            $data = DB::connection(DatabaseEntity::SQL_READ)
                ->table(DatabaseEntity::STUDENTS)
                ->whereNull("deleted_at")
                ->where('id', $id)
                ->first();

            return Response::buildSuccess(
                data: collect($data)->toArray()
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                "func_name" => $funcName,
                'user' => Auth::user()
            ]);

            return Response::buildErrorService($e->getMessage());
        }
    }

   public function update(Request $data, int $id): array
{
    $return = [];
    $funcName = $this->className . ".update";

    $validator = Validator::make($data->all(), [
        'name' => 'required',
        'gender' => 'required|in:L,P',
        'class_id' => 'required|exists:class,id',
    ]);

    $validator->validate();

    $update = [
        'name'       => $data['name'],
        'gender'     => $data['gender'],
        'class_id'   => $data['class_id'],
        'updated_at' => now(),
    ];

    DB::beginTransaction();

    try {
        DB::table(DatabaseEntity::STUDENTS)
            ->where("id", $id)
            ->update($update);

        DB::commit();
        $return = Response::buildSuccess(
            message: ResponseEntity::SUCCESS_MESSAGE_UPDATED
        );
    } catch (\Exception $e) {
        DB::rollback();

        Log::error($e->getMessage(), [
            "func_name" => $funcName,
            'user' => Auth::user()
        ]);

        return Response::buildErrorService($e->getMessage());
    }

    return $return;
}


    public function delete(int $id): array
    {
        $return = [];
        $funcName = $this->className . ".delete";

        DB::beginTransaction();

        try {
            $delete = DB::table(DatabaseEntity::STUDENTS)
                ->where('id', $id)
                ->update([
                    'deleted_by' => Auth::user()->id,
                    'deleted_at' => datetime_now(),
                ]);

            if (!$delete) {
                DB::rollback();

                throw new Exception("FAILED DELETE DATA");
            }

            DB::commit();

            $return = Response::buildSuccess();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage(), [
                "func_name" => $funcName,
                'user' => Auth::user()
            ]);

            return Response::buildErrorService($e->getMessage());
        }

        return $return;
    }
}
