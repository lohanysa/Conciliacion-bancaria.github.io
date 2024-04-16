
    var crear = document.getElementById('crear');
    crear.addEventListener('submit', function(e){
        e.defaultPrevented();
        nuevo = new FormData(crear)
        fetch('../php/grabarCheque.php',{
            
                method: 'POST',
                body: nuevo,
            })
            .then(res=> res.json())

            .then(datos =>{
                if (datos ==""){
                    alert("no existe");
                }else{
                    document.getElementById('fecha').value= datos.fecha
                    document.getElementById('beneficiario').value= datos.paguese
                    document.getElementById('cantidad').value= datos.suma
                    document.getElementById('descripcion').value= datos.descripcion
                   }
        })
    })