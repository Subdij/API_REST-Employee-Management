<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Employee Management</title>
</head>

<body>

<h1>Employee Management</h1>

<table id="employee-list">
  <tbody id="employee-List">
  </tbody>
</table>

<div class="display">
  <form id="addEmployee-Form">

    <h1>Add Employee</h1>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Name"><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" placeholder="Email"><br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" placeholder="Age"><br>

    <label for="designation">Designation:</label>
    <input type="text" id="designation" name="designation" placeholder="Designation"><br>
    
    <input type="button" id="addEmployee" value="Add Employee">
  </form>

  <div id="editEmployeeForm" style="display: none;">
    <form id="editEmployeeForm">

      <h1>Edit Employee</h1>

      <label for="updated-name">Name:</label>
      <input type="text" id="updated-name" name="updated-name"><br>

      <label for="updated-email">Email:</label>
      <input type="text" id="updated-email" name="updated-email"><br>

      <label for="updated-age">Age:</label>
      <input type="number" id="updated-age" name="updated-age"><br>

      <label for="updated-designation">Designation:</label>
      <input type="text" id="updated-designation" name="updated-designation"><br>

      <input type="hidden" id="employeeId" name="employeeId">
      <input type="submit" id="applyEdit" value="Apply">
      <input type="button" id="cancelEdit" value="Cancel">
    </form>
  </div>

</div>

<script src="script.js"></script>

</body>

</html>