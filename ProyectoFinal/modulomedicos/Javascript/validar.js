var frmvalidator  = new Validator("myform");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
  
	frmvalidator.addValidation("cedula","req","*Introduce la cedula");
  frmvalidator.addValidation("nombre","req","*Introduce tu nombre");
  frmvalidator.addValidation("nombre","maxlen=20",	"*Maximo de 20 caracteres");
  frmvalidator.addValidation("nombre","alpha","*Caracteres Alfabeticos");
  
    frmvalidator.addValidation("apellido1_medico","req","*Introduce tu 1er apellido");
  frmvalidator.addValidation("apellido1_medico","maxlen=20","*20 caracteres maximo");
  
    frmvalidator.addValidation("apellido2_medico","req","*Introduce tu 2do apellido");
  frmvalidator.addValidation("apellido2_medico","maxlen=20","*20 caracteres maximo");
  
  frmvalidator.addValidation("especialidad","req","*Introduce tu especialidad");
  frmvalidator.addValidation("especialidad","maxlen=20",	"*Maximo de 20 caracteres");
  frmvalidator.addValidation("especialidad","alpha","*Caracteres Alfabeticos");
  
  frmvalidator.addValidation("usu","req","*Introduce tu usuario");
  frmvalidator.addValidation("usu","maxlen=20","*20 caracteres maximo");
  
  frmvalidator.addValidation("pass","req","*Introduce tu password");
  frmvalidator.addValidation("pass","maxlen=20","*20 caracteres maximo");