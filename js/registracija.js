function checkInputOnKeyUpMail(x)
{
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
        document.querySelector('#error-email').innerHTML = "";
        document.querySelector('#input-register-email').style.background = '#6faf48';
        document.querySelector('#error-email').style.display = "none";
        document.querySelector('#input-register-submit').disabled = false;
    } 
    else
    {
        if (document.querySelector('#error-email').innerHTML == "")
        {
            setTimeout(function()
            {
                document.querySelector('#error-email').style.display = "block";
                document.querySelector('#error-email').innerHTML = "Napačna e-pošta."; 
                document.querySelector('#input-register-email').style.background = '#ad2424';
                document.querySelector('#input-register-submit').disabled = true;
            }, 500);
        }
    }
}

function checkInputOnKeyUpUser(x)
{
    if (x.length < 3)
    {
        setTimeout(function()
            {
                document.querySelector('#error-user').style.display = "block";
                document.querySelector('#error-user').innerHTML = "Uporabniško ime rabi več<br />kot dva znaka."; 
                document.querySelector('#input-register-user').style.background = '#ad2424';
                document.querySelector('#input-register-submit').disabled = true;
            }, 500);
    }
    else if (x == "admin")
    {
        setTimeout(function()
            {
                document.querySelector('#error-user').style.display = "block";
                document.querySelector('#error-user').innerHTML = "Nedovoljeno ime."; 
                document.querySelector('#input-register-user').style.background = '#ad2424';
                document.querySelector('#input-register-submit').disabled = true;
            }, 500);
    }
    else
    {
        document.querySelector('#error-user').innerHTML = ""; 
        document.querySelector('#input-register-user').style.background = '#6faf48';
        document.querySelector('#error-user').style.display = "none";
        document.querySelector('#input-register-submit').disabled = false;
    }
}

function checkInputOnKeyUpPass(x)
{
    if (x.length < 8)
    {
        if (document.querySelector('#error-pass').innerHTML == "")
        {
            setTimeout(function()
            {
                document.querySelector('#error-pass').style.display = "block";
                document.querySelector('#error-pass').innerHTML = "Geslo je prekratko.";
                document.querySelector('#input-register-pass').style.background = '#ad2424';
                document.querySelector('#input-register-submit').disabled = true;
            }, 500);
        }
    }
    else
    {
        document.querySelector('#error-pass').innerHTML = "";
        document.querySelector('#input-register-pass').style.background = '#6faf48';
        document.querySelector('#error-pass').style.display = "none";
        document.querySelector('#input-register-submit').disabled = false;
    }
}

function checkInputOnKeyUpPassCheck(x)
{
    var pass = document.querySelector('#input-register-pass').value;
    console.log(pass);
    if (pass === x)
    {
        document.querySelector('#error-passcheck').innerHTML = "";
        document.querySelector('#input-register-passcheck').style.background = '#6faf48';
        document.querySelector('#error-passcheck').style.display = "none";
        document.querySelector('#input-register-submit').disabled = false;
    }
    else
    {
        if (document.querySelector('#error-passcheck').innerHTML == "")
        {
            setTimeout(function()
            {
                document.querySelector('#error-passcheck').style.display = "block";
                document.querySelector('#error-passcheck').innerHTML = "Gesli se ne ujemata.";
                document.querySelector('#input-register-passcheck').style.background = '#ad2424';
                document.querySelector('#input-register-submit').disabled = true;
            }, 500);
        }
    }
}