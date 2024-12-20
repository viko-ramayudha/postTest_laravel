<?php 
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class JurusanController extends Controller {

    /**
    * @OA\Get (
    *     path="/jurusan",
    *     tags={"Jurusan"},
    *     operationId="listjurusan",
    *     summary="Jurusan - Get All",
    *     description="Mengambil Data Jurusan",
    *     security={ { "bearerAuth": {} } },
    *     @OA\Response(
    *         response="200",
    *         description="OK",
    *         @OA\JsonContent(
    *             example={
    *                 "success": true,
    *                 "message": "Berhasil mengambil Data Jurusan",
    *                 "data": {
    *                     {
    *                         "id": "1",
    *                         "nama": "Mukhamad Viko Ramayudha",
    *                         "email": "ramaydha@dummy.com",
    *                         "password": "******",
    *                         "no_hp": "62813320200",
    *                         "status": "1",
    *                     }
    *                 }
    *             }
    *         )
    *     )
    * )
    */
    public function listJurusan() {
        $success = true;
        $message = 'Berhasil mengambil Data Jurusan';
        $data = Jurusan::all();

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'    => $data
        ], 200);
    }

    /**
    * @OA\Get(
    *     path="/jurusan/{id}",
    *     tags={"Jurusan"},
    *     operationId="listJurusanById",
    *     summary="Jurusan - Get By Id",
    *     description="Mengambil Data Jurusan Berdasarkan ID",
    *     security={ { "bearerAuth": {} } },
    *     @OA\Parameter(
    *         @OA\Schema(
    *             type="string",
    *         ),
    *         description="Masukkan ID Jurusan",
    *         example="1",
    *         in="path",
    *         name="id",
    *         required=true,
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="OK",
    *         @OA\JsonContent(
    *             example={
    *                 "success": true,
    *                 "message": "Berhasil mengambil Data Jurusan",
    *                 "data": {
    *                     "kd_jurusan": "1",
*                         "jurusan": "Rekayasa Perangkat Lunak",
*                         "kakomli": "Trie Gunanto Hadi",
    *                 }
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="Data Jurusan tidak ditemukan",
    *         @OA\JsonContent(
    *             example={
    *                 "success": false,
    *                 "message": "Data Jurusan tidak ditemukan",
    *             }
    *         )
    *     )
    * )
    */
    public function listJurusanById($id) {
        try {
            $success = true;
            $message = 'Berhasil mengambil Data Jurusan';
            $data = Jurusan::where('id', $id)->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Jurusan tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data,
            ], 200);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
    * @OA\Post(
    *     path="/jurusan/create",
    *     tags={"Jurusan"},
    *     operationId="insertJurusan",
    *     summary="Jurusan - Insert",
    *     description="Menambahkan Data Jurusan",
    *     security={ { "bearerAuth": {} } },
    *     @OA\RequestBody(
    *         required=true,
    *         description="Data Jurusan",
    *         @OA\JsonContent(
    *             example={
    *                 "jurusan": "Rekayasa Perangkat Lunak",
    *                 "kakomli": "Trie Gunanto Hadi",
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response="201",
    *         description="Created",
    *         @OA\JsonContent(
    *             example={
    *                 "success": true,
    *                 "message": "Berhasil menambahkan Data Jurusan",
    *                 "data": {
    *                     "kd_jurusan": "",
    *                     "jurusan": "Rekayasa Perangkat Lunak",
    *                     "kakomli": "Trie Gunanto Hadi",
    *                 
    *                 }
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response="422",
    *         description="Unprocessable Entity",
    *         @OA\JsonContent(
    *             example={
    *                 "kd_jurusan": {"The kd_jurusan field is required."},
    *                 "jurusan": {"The jurusan field is required."},
    *                 "kakomli": {"The kakomli field is required."},
    *             }
    *         )
    *     )
    * )
    */
    public function insertJurusan(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jurusan' => 'required',
            'kakomli' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $success = true;
            $message = "Berhasil menambahkan Data Jurusan";
            $result = Jurusan::create($request->all());
            $data = $result;

            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data,
            ], 201);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     *     path="/jurusan/update/{id}",
     *     tags={"Jurusan"},
     *     operationId="updateJurusan",
     *     summary="Jurusan Update",
     *     description="Update data Jurusan",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         description="ID Jurusan",
     *         example="1",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request Body Description",
     *         @OA\JsonContent(
     *             example={
     *                 "jurusan": "Rekayasa Perangkat Lunak",
    *                  "kakomli": "Trie Gunanto Hadi",
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Data berhasil diubah"
     *             }
     *         )
     *     )
     * )
     */
    public function updateJurusan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jurusan' => 'required',
            'kakomli' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $jurusan = Jurusan::find($id);

            if (!$jurusan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Ekskul tidak ditemukan',
                ], 404);
            }

            // Update fields
            $jurusan->jurusan = $request->input('jurusan');
            $jurusan->kakomli = $request->input('kakomli');
            $jurusan->save();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah',
                'data' => $jurusan,
                'status' => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

  /**
 * @OA\Delete(
 *     path="/jurusan/delete",
 *     tags={"Jurusan"},
 *     operationId="deleteJurusan",
 *     summary="Jurusan Delete",
 *     description="Hapus data Jurusan",
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="ID Jurusan yang ingin dihapus",
 *         @OA\JsonContent(
 *             example={
*                 "kd_jurusan": "809875"
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Data berhasil dihapus"
 *             }
 *         )
 *     )
 * )
 */
public function deleteJurusan(Request $request)
{
    $validator = Validator::make($request->all(), [
        'kd_jurusan' =>'',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $id = $request->input('kd_jurusan');
    $result = Jurusan::where('kd_jurusan', $id)->delete();

    if ($result) {
        $success = true;
        $message = 'Berhasil Menghapus Data Jurusan';
    } else {
        $success = false;
        $message = 'Gagal Menghapus Data Jurusan';
    }

    return response()->json([
        'success' => $success,
        'message' => $message
    ], 200);
}

}
?>