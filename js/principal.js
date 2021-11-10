function validar_form_contato() {
    var nome = form_contato.nome.value;
    var cpf = form_contato.cpf.value;
    var fone = form_contato.fone.value;
    var email = form_contato.email.value;


    if (nome == "" || nome.length < 3) {
        text = "Por favor, preencha com seu nome!";
        document.getElementById("msg-name").innerHTML = text;
        document.getElementById("msg-name").style.display = 'block';
        form_contato.nome.focus();
        return false;
    }

    if (cpf == "" || cpf.length < 14 || cpf == "000.000.000-00" || cpf == "111.111.111-11" || cpf == "222.222.222-22" || cpf == "333.333.333-33" || cpf == "444.444.444-44" || cpf == "555.555.555-55" || cpf == "666.666.666-66" || cpf == "777.777.777-77" || cpf == "888.888.888-88" || cpf == "999.999.999-99") {
        text = "Por favor, preencha com seu CPF!";
        text1 = "CPF já cadastrado.";
        document.getElementById("msg-cpf").innerHTML = text;
        document.getElementById("msg-cpf").style.display = 'block';
        form_contato.cpf.value = "";
        form_contato.cpf.focus();
        return false;
    } else {
        var str = cpf.replace(/[^\d]+/g, '');
        // Valida 1o digito	
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(str.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(str.charAt(9))) {
            text = "Por favor, preencha com um CPF válido!";
            document.getElementById("msg-cpf").innerHTML = text;
            document.getElementById("msg-cpf").style.display = 'block';
            form_contato.cpf.value = "";
            form_contato.cpf.focus();
            return false;
        }
        // Valida 2o digito	
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(str.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(str.charAt(10))) {
            text = "Por favor, preencha com um CPF válido!";
            document.getElementById("msg-cpf").innerHTML = text;
            document.getElementById("msg-cpf").style.display = 'block';
            form_contato.cpf.value = "";
            form_contato.cpf.focus();
            return false;
        }
        //return true;
    }

    if (document.form_contato.congregacao.value == "") {
        text = "Por favor, escolha uma congregação!";
        document.getElementById("msg-congregacao").innerHTML = text;
        document.getElementById("msg-congregacao").style.display = 'block';
        form_contato.congregacao.focus();
        return false;
    }
}

// Remoção de números e caracteres especiais do campo Nome
function Onlychars(e) {
    var tecla = parseInt(e.keyCode)

    if ((tecla >= 33 && tecla <= 64) || (tecla >= 91 && tecla <= 94) || (tecla == 96) || (tecla == 123) || (tecla == 125) || (tecla == 126) || (tecla == 162) || (tecla == 163) || (tecla == 167) || (tecla == 172) || (tecla == 176) || (tecla == 178) || (tecla == 179) || (tecla == 180) || (tecla == 185) || (tecla == 8354)) {
        return false;
    }
}
// /.Remoção de números e caracteres especiais do campo Nome

function clearAlert() {
    if (document.getElementById('msg-name').style.display == "block") {
        document.getElementById('msg-name').style.display = "none";
    }

    if (document.getElementById('msg-cpf').style.display == "block") {
        document.getElementById('msg-cpf').style.display = "none";
    }
    
    if (document.getElementById('msg-congregacao').style.display == "block") {
        document.getElementById('msg-congregacao').style.display = "none";
    }
}
