
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));


let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};




///////////////////////////////////////////////////////////////////////////////////////////////////////




document.querySelectorAll(".tabled tbody tr").forEach(function(row) {
  row.addEventListener("click", function() {
    document.querySelectorAll(".tabled tbody tr").forEach(function(otherRow) {
      otherRow.classList.remove("selected");
    });
    row.classList.add("selected");
  });
});




///////////////////////////////////////////////////////////////////////////////////////////////////////



document.querySelector(".button-container .button:last-child").addEventListener("click", function() {
  
  const rows = document.querySelectorAll(".tabled tbody tr");
  let selectedRow = null;
  for (const row of rows) {
    if (row.classList.contains("selected")) {
      selectedRow = row;
      break;
    }
  }
  if (selectedRow) {
    
    if (confirm("Are you sure you want to delete this order?")) {
      
      selectedRow.remove();
    }
  }
});








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



document.querySelector(".button-container .button:first-child").addEventListener("click", function() {
  
  document.getElementById("add-form").style.display = "block";
});


document.getElementById("add-form").addEventListener("submit", function(event) {
  
  event.preventDefault();

  
  const name = document.getElementById("name").value;
  const price = document.getElementById("price-add").value;
  const payment = document.getElementById("payment-add").value;

  
  const rows = document.querySelectorAll(".tabled tbody tr");
  for (const row of rows) {
    if (row.querySelector("td:first-child").textContent.trim() === name.trim()) {
      alert("Cannot add this item. Name already exists.");
      return;
    }
  }

  
  const row = document.createElement("tr");
  row.innerHTML = `
    <td>${name}</td>
    <td>${price}</td>
    <td>${payment}</td>
  `;

  
  document.querySelector(".tabled tbody").appendChild(row);

  
  document.getElementById("add-form").style.display = "none";
});



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







document.querySelector(".button-container .button:nth-child(2)").addEventListener("click", function() {
 
  const selectedRow = document.querySelector(".tabled tbody tr.selected");
  if (selectedRow) {
    
    document.querySelector("#edit-form").style.display = "block";
    document.querySelector("#edit-form [name='name']").value = selectedRow.querySelector("td:first-child").textContent;
    document.querySelector("#edit-form [name='price']").value = selectedRow.querySelector("td:nth-child(2)").textContent;
    document.querySelector("#edit-form [name='payment']").value = selectedRow.querySelector("td:nth-child(3)").textContent;
  }
});


document.querySelector("#edit-form form").addEventListener("submit", function(event) {
  
  event.preventDefault();

  
  const selectedRow = document.querySelector(".tabled tbody tr.selected");
  if (selectedRow) {
   
    const name = document.querySelector("#edit-form [name='name']").value;
    const price = document.querySelector("#edit-form [name='price']").value;
    const payment = document.querySelector("#edit-form [name='payment']").value;

    
    selectedRow.querySelector("td:first-child").textContent = name;
    selectedRow.querySelector("td:nth-child(2)").textContent = price;
    selectedRow.querySelector("td:nth-child(3)").textContent = payment;

    
    document.querySelector("#edit-form").style.display = "none";
  }
});


document.querySelectorAll(".tabled tbody tr").forEach(function(row) {
  row.addEventListener("click", function() {
   
    document.querySelectorAll(".tabled tbody tr").forEach(function(otherRow) {
      otherRow.classList.remove("selected");
    });

    
    this.classList.add("selected");
  });
});











function updateTable(data) {
  const tableBody = document.querySelector(".tabled tbody");
  tableBody.innerHTML = "";

  data.forEach(function (rowData) {
    const row = document.createElement("tr");
    row.innerHTML = `<td>${rowData.name || ''}</td><td>${rowData.price || ''}</td><td>${rowData.payment || ''}</td>`;
    tableBody.appendChild(row);
  });

  localStorage.setItem("orders", JSON.stringify(data));
}

