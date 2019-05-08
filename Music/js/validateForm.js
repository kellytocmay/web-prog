function validateForm() {
  var tieude = document.forms["insertForm"]["tieude"].value;
  var ten_bhat = document.forms["insertForm"]["ten_bhat"].value;
  var tomtat = document.forms["insertForm"]["tomtat"].value;

  if (tieude == "") {
    alert("Tiêu đề không được rỗng");
    return false;
  }
  if (tomtat == "") {
    alert("Tóm tắt không được rỗng");
    return false;
  }
  if (ten_bhat = "") {
    document.getElementsByName('ten_bhat')[0].value = document.getElementsByName('tieude')[0].value;
  }
}
