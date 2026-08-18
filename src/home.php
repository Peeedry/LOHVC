<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Projeto/css/homsty.css">
  <title>LOHVC</title>
</head>
<body>

<div class="content">
  
  <div class="a">
  
   <h2>LOHVC</h2>
   
  </div>
  
  <div class="circulo">
  </div>

<div class="btn">
    <button id="redcad" class="bot">Cadastro</button><br>
    <button id="redlog" class="bot">Entrar</button>
</div>

</div>


<div class="footer">
  <p>Footer</p>
</div>

</body>


  <script>
    function redirectTo(page) {
      window.location.href = `../Projeto/${page}.php`;
    }

    const cadastroButton = document.getElementById("redcad");
    if (cadastroButton) {
      cadastroButton.addEventListener("click", function() {
        redirectTo("cadastr");
      });
    }

    const loginButton = document.getElementById("redlog");
    if (loginButton) {
      loginButton.addEventListener("click", function() {
        redirectTo("login");
      });
    }

    // Botões específicos para professores
    const cadastroProfButton = document.getElementById("redcadprof");
    if (cadastroProfButton) {
      cadastroProfButton.addEventListener("click", function() {
        redirectTo("cadastr_professor");
      });
    }

    const loginProfButton = document.getElementById("redlogprof");
    if (loginProfButton) {
      loginProfButton.addEventListener("click", function() {
        redirectTo("login_professor");
      });
    }
  </script>
</body>
</html>