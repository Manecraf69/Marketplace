function setMarcaModeloOutro() {
    const marcaOutro = document.getElementById('marca_outro').value;
    const modeloOutro = document.getElementById('modelo_outro').value;

    if (marcaOutro !== "") {
        document.getElementById('marca').value = marcaOutro;
    }

    if (modeloOutro !== "") {
        document.getElementById('modelo').value = modeloOutro;
    }
}

// Chamar essa função no momento em que os campos 'Outro' são preenchidos
document.getElementById('marca_outro').addEventListener('input', setMarcaModeloOutro);
document.getElementById('modelo_outro').addEventListener('input', setMarcaModeloOutro);