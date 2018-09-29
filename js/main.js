function checkInputOnKeyUp (x)
{
    console.log(x);
    var value = x.value;
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
    console.log('Valid!');
    } else
    {
    console.log('Invalid!');
    }
}