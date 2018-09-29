function checkInputOnKeyUp (x)
{
    //console.log(x);
    var x = '#' + x;
    var field = document.querySelector(x).value;
    console.log(field);
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(field) )
    {
    console.log('Valid!');
    } else
    {
    console.log('Invalid!');
    }
}