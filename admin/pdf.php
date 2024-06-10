<?php

// Check if form was submitted and data exists
if (isset($_POST['table_data'])) {

  // Include a PDF generation library (e.g., FPDF)
  require('fpdf/fpdf.php');

  // Extract table data from the form
  $tableData = $_POST['table_data'];

  // Create a new PDF document (adjust parameters as needed)
  $pdf = new FPDF('P', 'mm', 'A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 12);

  // Parse the HTML table data (assuming basic structure)
  $dom = new DOMDocument();
  $dom->loadHTML($tableData, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
  $table = $dom->getElementsByTagName('table')->item(0);

  // Extract table headers
  $headers = array();
  $rows = $table->getElementsByTagName('tr');
  $headerRow = $rows->item(0);
  foreach ($headerRow->getElementsByTagName('th') as $th) {
    $headers[] = $th->textContent;
  }

  // Extract table data and generate PDF content
  $pdf->Cell(0, 6, 'Off Entry Data', 0, 1, 'C');
  $pdf->Ln(10);

  foreach ($rows as $i => $row) {
    if ($i === 0) continue; // Skip header row
    $data = array();
    foreach ($row->getElementsByTagName('td') as $td) {
      $data[] = $td->textContent;
    }
    $pdf->Cell(40, 6, implode(' | ', $data), 0, 1);
  }

  // Output the PDF (adjust filename as needed)
  $pdf->Output('off_entry_data.pdf');

} else {
  echo "Error: No data received";
}

?>
