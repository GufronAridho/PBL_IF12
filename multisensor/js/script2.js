//------------------------------------------------------------
var current_page = 1;
var records_per_page = 10;
var l = document.getElementById("table_id").rows.length;
//------------------------------------------------------------

//------------------------------------------------------------
function apply_Number_of_Rows() {
  var x = document.getElementById("number_of_rows").value;
  records_per_page = x;
  changePage(current_page);
}
//------------------------------------------------------------

//------------------------------------------------------------
function prevPage() {
  if (current_page > 1) {
    current_page--;
    changePage(current_page);
  }
}
//------------------------------------------------------------

//------------------------------------------------------------
function nextPage() {
  if (current_page < numPages()) {
    current_page++;
    changePage(current_page);
  }
}
//------------------------------------------------------------

//------------------------------------------------------------
function changePage(page) {
  var btn_next = document.getElementById("btn_next");
  var btn_prev = document.getElementById("btn_prev");
  var listing_table = document.getElementById("table_id");
  var page_span = document.getElementById("page");

  // Validate page
  if (page < 1) page = 1;
  if (page > numPages()) page = numPages();

  [...listing_table.getElementsByTagName("tr")].forEach((tr) => {
    tr.style.display = "none"; // reset all to not display
  });
  listing_table.rows[0].style.display = ""; // display the title row

  for (
    var i = (page - 1) * records_per_page + 1;
    i < page * records_per_page + 1;
    i++
  ) {
    if (listing_table.rows[i]) {
      listing_table.rows[i].style.display = "";
    } else {
      continue;
    }
  }

  page_span.innerHTML =
    page +
    "/" +
    numPages() +
    " (Total Number of Rows = " +
    (l - 1) +
    ") | Number of Rows : ";

  if (page == 0 && numPages() == 0) {
    btn_prev.disabled = true;
    btn_next.disabled = true;
    return;
  }

  if (page == 1) {
    btn_prev.disabled = true;
  } else {
    btn_prev.disabled = false;
  }

  if (page == numPages()) {
    btn_next.disabled = true;
  } else {
    btn_next.disabled = false;
  }
}
//------------------------------------------------------------

//------------------------------------------------------------
function numPages() {
  return Math.ceil((l - 1) / records_per_page);
}
//------------------------------------------------------------

//------------------------------------------------------------
window.onload = function () {
  var x = document.getElementById("number_of_rows").value;
  records_per_page = x;
  changePage(current_page);
};
//------------------------------------------------------------
// Fungsi untuk mencetak tabel
function printTable() {
  window.print();
}

// Fungsi untuk kembali ke halaman utama
function goBack() {
  window.history.back();
}

