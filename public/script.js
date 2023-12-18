function loadEmployees() {
  fetch("http://localhost/dev_back_API_REST/api/read.php")
    .then((response) => response.json())
    .then((data) => {
      const employeeList = document.getElementById("employee-list");
      employeeList.innerHTML = "";

      const table = document.createElement("table");
      const thead = document.createElement("thead");
      const headerRow = document.createElement("tr");
      headerRow.innerHTML = `
          <th>Name</th>
          <th>Email</th>
          <th>Age</th>
          <th>Designation</th>
          <th>Action</th>
        `;
      thead.appendChild(headerRow);
      table.appendChild(thead);

      data.body.forEach((employee) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${employee.name}</td>
            <td>${employee.email}</td>
            <td>${employee.age}</td>
            <td>${employee.designation}</td>
            <td>
              <button class="edit-btn" onclick="editEmployee(${employee.id})" data-id="${employee.id}">Edit</button>
              <button class="delete-btn" onclick="deleteEmployee(${employee.id})">Delete</button>
            </td>
          `;
        table.appendChild(row);
      });

      employeeList.appendChild(table);
    })
    .catch((error) => console.error("Error fetching data from API:", error));
}

function addEmployee() {
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const age = document.getElementById("age").value;
  const designation = document.getElementById("designation").value;

  const employeeData = {
    name: name,
    email: email,
    age: age,
    designation: designation,
  };

  fetch("http://localhost/dev_back_API_REST/api/create.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(employeeData),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Employee added:", data);
      loadEmployees();
    })
    .catch((error) => console.error("Error adding employee:", error));
}

function editEmployee(employeeId) {
  document.getElementById("editEmployeeForm").style.display = "none";
  document.getElementById("editEmployeeForm").style.display = "block";
  document.getElementById("employeeId").value = employeeId;

  fetch(`http://localhost/dev_back_API_REST/api/read.php?id=${employeeId}`)
    .then((response) => response.json())
    .then((data) => {
      console.log("Employee data:", data);
      if (data && data.body && data.body.length > 0) {
        const employeeData = data.body.find(
          (employee) => employee.id === employeeId
        );

        if (employeeData) {
          document.getElementById("updated-name").value =
            employeeData.name || "";
          document.getElementById("updated-email").value =
            employeeData.email || "";
          document.getElementById("updated-age").value = employeeData.age || "";
          document.getElementById("updated-designation").value =
            employeeData.designation || "";
        } else {
          console.error("Employee data not found for editing");
        }
      } else {
        console.error("No employee data found for editing");
      }
    })
    .catch((error) =>
      console.error("Error fetching employee details for editing:", error)
    );
}

function applyEdit() {
  const employeeId = document.getElementById("employeeId").value;
  const updatedName = document.getElementById("updated-name").value;
  const updatedEmail = document.getElementById("updated-email").value;
  const updatedAge = document.getElementById("updated-age").value;
  const updatedDesignation = document.getElementById(
    "updated-designation"
  ).value;

  const employeeData = {
    name: updatedName,
    email: updatedEmail,
    age: updatedAge,
    designation: updatedDesignation,
  };

  employeeData.id = employeeId;

  fetch(`http://localhost/dev_back_API_REST/api/update.php?id=${employeeId}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(employeeData),
  })
    .then((response) => {
      console.log("Response status:", response.status);
      if (response.ok) {
        return response.json();
      } else {
        throw new Error("Erreur lors de la mise à jour de l'employé");
      }
    })
    .then((data) => {
      console.log("Employee updated:", data);
      document.getElementById("editEmployeeForm").style.display = "none";
      loadEmployees();
    })
    .catch((error) => {
      console.error("Error updating employee:", error);
      alert("Erreur lors de la mise à jour de l'employé.");
    });
}

function deleteEmployee(employeeId) {
  fetch(`http://localhost/dev_back_API_REST/api/delete.php?id=${employeeId}`, {
    method: "DELETE",
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Employee deleted:", data);
      loadEmployees();
    })
    .catch((error) => console.error("Error deleting employee:", error));
}

document.addEventListener("DOMContentLoaded", function () {
  loadEmployees();

  document.getElementById("addEmployee").addEventListener("click", function () {
    addEmployee();
  });

  document.getElementById("applyEdit").addEventListener("click", function () {
    applyEdit();
  });

  document.getElementById("cancelEdit").addEventListener("click", function () {
    document.getElementById("editEmployeeForm").style.display = "none";
  });

  const editButtons = document.querySelectorAll(".edit-btn");
  editButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      const employeeId = event.target.dataset.id;
      editEmployee(employeeId);
    });
  });
});