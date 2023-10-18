function showPassword(element = "", bool = "F") {
  let input_type = document.getElementById("password").type;

  input_type = input_type == "text" ? "password" : "text";
  document.getElementById("password").type = input_type;
  if (bool) document.getElementById(element).type = input_type;
}

function check_password_validity() {
  let pass = document.getElementById("password").value;
  let repass = document.getElementById("re-password").value;

  if (pass === repass) {
    document.getElementById("submit").disabled = false;
    document.getElementById("password").style.border = "";
    document.getElementById("re-password").style.border = "";
    document.getElementById("invalid-password").hidden = true;
  } else {
    document.getElementById("submit").disabled = true;
    document.getElementById("password").style.border = "2px solid red";
    document.getElementById("re-password").style.border = "2px solid red";
    document.getElementById("invalid-password").hidden = false;
  }
}

function calculate_cart_receipt() {
  let subtotal = 0,
    total = 0,
    taxes = 2,
    items = 0;

  let prices = document.getElementsByName("input-prices[]");
  let amounts = document.getElementsByName("input-amounts[]");

  for (let index = 0; index < amounts.length; index++) {
    subtotal +=
      parseFloat(amounts[index].value) * parseFloat(prices[index].value);
    items += parseInt(amounts[index].value);
  }

  total += subtotal + taxes;
  document.getElementsByName("show-data[]")[0].innerHTML = subtotal + "$";
  document.getElementsByName("show-data[]")[1].innerHTML = taxes + "$";
  document.getElementsByName("show-data[]")[2].innerHTML = total + "$";
  document.getElementsByName("show-data[]")[3].innerHTML = items;
}
