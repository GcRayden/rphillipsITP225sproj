<?php
// Sample array of data
$data = array(
  array('Quiz', 'Description', 'Number of Items', 'Edit Quiz')
);

// Start the table
echo "<table>";

// Output the header row
echo "<tr>";
foreach ($data[0] as $header) {
  echo "<th>$header</th>";
}
echo "</tr>";

// Output the data rows
for ($i = 1; $i < count($data); $i++) {
  echo "<tr>";
  foreach ($data[$i] as $value) {
    echo "<td>$value</td>";
  }
  echo "</tr>";
}

// End the table
echo "</table>";
?>