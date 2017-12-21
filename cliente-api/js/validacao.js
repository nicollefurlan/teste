
JSON.parse = JSON.parse || function(str){
  if (str === "")
      str = '""';
    eval("var p="+ str +";");
    return p;
};

$(document).ready(function(){
   function getCadastro(){
       $.ajax({
         url: "http://localhost/neppo/slim/api.php/cadastro",
         type: "get",
         success: function(response) {
          var dados = JSON.parse(response);
           for (var i = 0; i < dados.length; i++) {
             if (dados.length){
               $(".table > tbody").append("<tr><td>"+ dados[i].id +"</td>"+
                                  "<td>"+ dados[i].nome +"</td>"+
                                  "<td>"+ dados[i].data +"</td>"+
                                  "<td>"+ dados[i].cpf +"</td>"+
                                  "<td>"+ dados[i].sexo +"</td>"+
                                  "<td>"+ dados[i].endereco+"</td>"+
                                  
                                 
                                  "</tr>");                              
                            }

                        
                     }   
                 
           
                     $(".delete").unbind("click").click(function  (){
                      $.ajax({
                       url: "http://localhost/neppo/slim/api.php/cadastro"+$(this).data("cadastro"),
                       type: "DELETE",
                       success: function (response){
                         $(".table ").html ("<tr><td>ID</td><td>NOME</td><td>DATA</td><td>CPF</td><td>SEXO</td><td>ENDEREÇO</td><td>ELIMINAR</td><td>EDITAR</td></tr>");
                         getCadastro();
                         $("#form").attr("data-cadastro");
                         $("#form") [0].reset();
                       }
                      });
                    });
              }
       });
         

   }
        
 getCadastro();

     if ($("#form").data("cadastro") ===0) {
          $("#form").submit(function (e) {
            $.ajax({
              url: "http://localhost/neppo/slim/api.php/cadastro",
              type: "post",
              success: function(response) {
                    $(".table > tbody").html ("<tr><td>ID</td><td>NOME</td><td>DATA</td><td>CPF</td><td>SEXO</td><td>ENDEREÇO</td><td>ELIMINAR</td><td>EDITAR</td></tr>");
                    getCadastro();
                    $("#form") [0].reset();
                  }                  
               });

            return false;
          });
        }

 });

