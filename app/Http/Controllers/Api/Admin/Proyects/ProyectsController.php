<?php

namespace App\Http\Controllers\Api\Admin\Proyects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Proyects\ProyectsCreateRequest;
use App\Models\Proyect\Proyect;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Chart;

class ProyectsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.proyects.index', only: ['index']),
            new Middleware('permission:admin.proyects.edit', only: ['edit','update']),
            new Middleware('permission:admin.proyects.create', only: ['create','store']),
            new Middleware('permission:admin.proyects.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $proyects = Proyect::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de los proyectos',
                'data' => $proyects,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(ProyectsCreateRequest $request)
    {
        try{
            $proyects = Proyect::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El proyecto se creo correctamente',
                'data' => $proyects,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Proyect $proyect)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Detalle del proyecto',
                'data' => $proyect,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function edit(Proyect $proyect)
    {
        //
    }

    public function update(ProyectsCreateRequest $request, Proyect $proyect)
    {
        try{
            $proyect->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El proyecto se edito correctamente',
                'data' => $proyect,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function destroy(Proyect $proyect)
    {
        try{
            $proyect->delete();

            return response()->json([
                'status' => true,
                'message' =>'El proyecto se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar datos a la hoja de cálculo
        $sheet->setCellValue('A1', 'Mes');
        $sheet->setCellValue('B1', 'Ventas');
        $sheet->fromArray(
            [
                ['Enero', 100],
                ['Febrero', 120],
                ['Marzo', 140],
                ['Abril', 130],
                ['Mayo', 150],
            ],
            null,
            'A2'
        );

        // Crear el gráfico
        $dataSeriesLabels = [
            new DataSeriesValues('String', 'Worksheet!$B$1', null, 1), // Etiqueta de la serie
        ];

        $xAxisTickValues = [
            new DataSeriesValues('String', 'Worksheet!$A$2:$A$6', null, 5), // Categorías de X
        ];

        $dataSeriesValues = [
            new DataSeriesValues('Number', 'Worksheet!$B$2:$B$6', null, 5), // Datos de Y
        ];

        $series = new DataSeries(
            DataSeries::TYPE_LINECHART, // Tipo de gráfico
            DataSeries::GROUPING_STANDARD, // Agrupamiento
            range(0, count($dataSeriesValues) - 1), // Indexación de serie
            $dataSeriesLabels, // Etiquetas de la serie
            $xAxisTickValues, // Valores de X
            $dataSeriesValues // Valores de Y
        );

        $plotArea = new PlotArea(null, [$series]);
        $chart = new Chart(
            'Ventas', // Nombre del gráfico
            null, // Título del gráfico
            null, // Leyenda del gráfico
            $plotArea // Área del gráfico
        );

        // Posicionar el gráfico
        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('K15');

        $sheet->addChart($chart);

        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true); // Incluir gráficos al escribir

        // Preparar archivo para descarga
        $fileName = 'ventas.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

}
