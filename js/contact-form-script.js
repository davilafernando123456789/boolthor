$("#contactForm").validator().on("submit", function (event) {
  if (event.isDefaultPrevented()) {
    //formError();
    showToast(false, "Por favor rellene el formulario correctamente.");
  } else {
    event.preventDefault(); // Prevenir el envío normal del formulario
    submitForm();
  }
});

//Enviamos el formulario
function submitForm() {
  var name = $("#name").val();
  var email = $("#email").val();
  var phone = $("#phone").val();
  var subject = $("#subject").val();
  var message = $("#message").val();

  //Ocultamos el botón de enviar y mostramos la animación de carga
  $(".btn-common").hide();
  $(".loading-icon-button").show();
  $.ajax({
    type: "POST",
    url: "php/form-process.php?v=1",
    data: {
      name: name,
      email: email,
      phone: phone,
      subject: subject,
      message: message
    },
    success: function (text) {
      if (text === "success") {
        formSuccess();
      } else {
        formError(text);
        //showToast(false, text);
      }
    },
    error: function (xhr, status, error) {
      formError("Error en la solicitud AJAX: " + error);
    },
    complete: function() {
      // Mostramos el botón de enviar y ocultamos la animación de carga
      $(".btn-common").show();
      $(".loading-icon-button").hide();
    }
  });
}  

//Mostramos el mensaje de envio correcto y reseteamos el formulario
function formSuccess() {
  showToast(true, "!Mensaje enviado correctamente!");
}

//Mostramos el mensaje de error y reseteamos el formulario
function formError(errorMessage) {
  showToast(false, "Ocurrió un error. Por favor, inténtelo de nuevo más tarde.");

  // Imprimimos el error específico en la consola
  console.log("Error en la solicitud AJAX:", errorMessage);
}

//Mostramos los toast de acuerdo al mensaje
function showToast(valid, msg) {
  const msgClasses = valid ? "h3 text-center msg-success" : "h3 text-center msg-error";
  $("#msgSubmit").removeClass().addClass(msgClasses).text(msg).css("opacity", 1);

  // Eliminamos los mensajes después de 5 segundos
  setTimeout(function () {
    $("#msgSubmit").css("opacity", 0).text("");
  }, 5000);
}