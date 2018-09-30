var userWrong = 0;
var passWrong = 0;
function checkInputOnKeUpUser(x)
{
    if (x.length < 3)
    {
        setTimeout(function()
            {
                document.querySelector('#error-user').style.display = "block";
                document.querySelector('#error-user').innerHTML = "Uporabniško ime rabi več<br />kot dva znaka."; 
                document.querySelector('#input-nastavitve-username').style.background = '#ad2424';
                document.querySelector('#input-nastavitve-username-submit').disabled = true;
                userWrong = 1;
            }, 200);
    }
    else if (x == "admin")
    {
        setTimeout(function()
            {
                document.querySelector('#error-user').style.display = "block";
                document.querySelector('#error-user').innerHTML = "Nedovoljeno ime."; 
                document.querySelector('#input-nastavitve-username').style.background = '#ad2424';
                document.querySelector('#input-nastavitve-username-submit').disabled = true;
                userWrong = 1;
            }, 200);
    }
    else
    {
        document.querySelector('#error-user').innerHTML = ""; 
        document.querySelector('#input-nastavitve-username').style.background = '#6faf48';
        document.querySelector('#error-user').style.display = "none";
        userWrong = 0;
        if (userWrong == 0 && passWrong == 0)
        {
            document.querySelector('#input-nastavitve-username-submit').disabled = false;
        }
    }
}

function checkInputOnKeUpPass(x)
{
    if (x.length < 8)
    {
        if (document.querySelector('#error-pass').innerHTML == "")
        {
            setTimeout(function()
            {
                document.querySelector('#error-pass').style.display = "block";
                document.querySelector('#error-pass').innerHTML = "Geslo je prekratko.";
                document.querySelector('#input-nastavitve-pass').style.background = '#ad2424';
                document.querySelector('#input-nastavitve-pass-submit').disabled = true;
                passWrong = 1;
            }, 200);
        }
    }
    else
    {
        document.querySelector('#error-pass').innerHTML = "";
        document.querySelector('#input-nastavitve-pass').style.background = '#6faf48';
        document.querySelector('#error-pass').style.display = "none";
        passWrong = 0;
        if (passWrong == 0 && userWrong == 0)
        {
            document.querySelector('#input-nastavitve-pass-submit').disabled = false;
        }
    }
}