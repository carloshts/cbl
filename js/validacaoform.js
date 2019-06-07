$(document).ready(function(){
                $('#formulario').validate({
                    rules:{
                        nome:{
                            minlength: 3
                        },
                        cpf:{
                            cpf: true
                        },
                        cnpj:{
                            cnpj: true
                        }
                    },
                    
                    messages:{
                        nome:{
                            minlength: "Digite pelo menos 3 caracteres."
                        }
                    }
                });
            });


