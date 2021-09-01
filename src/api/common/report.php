<?php

    namespace PensionFund;

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    require_once __DIR__ . '/../../../vendor/autoload.php';

    $mpdf = new \Mpdf\mPDF();

    // Write some HTML code:

    $html = '<table border="1" style="border-collapse: collapse; width: 100%;">';

    // Header
    $html .= '<thead>';
        $html .= '<tr>';

    foreach ($data->fields as $item) {
            $html .= '<th>' . $item->caption . '</th>';
    }

        $html .= '</tr>';
    $html .= '</thead>';


    foreach ($data->reportData as $row) {
        $html .= '<tr>';

        foreach ($row as $item) {
            $html .= '<td>' . $item . '</td>';
        }

        $html .= '</tr>';
    }

    $html .= '</table>';
    $mpdf->WriteHTML($html);

    $path = 'pdf/' . $data->methodName . '.pdf';

    // Output a PDF file directly to the browser
    $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

    $returnData = [
        'path' => 'src/api/common/' . $path,
        'status' => 1,
        'data' => $data->reportData
    ];

    echo json_encode($returnData);
