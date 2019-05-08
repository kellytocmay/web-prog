var d = new Date();
document.getElementsByName('ngayviet')[0].value = d.getFullYear() + "/" + ("0" + (d.getMonth() + 1)).slice(-2) + "/" + ("0" + d.getDate()).slice(-2);
